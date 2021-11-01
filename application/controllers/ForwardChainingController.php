<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class ForwardChainingController extends MainController
{

    protected $kerusakan = []; // Untuk menampung data kerusakan

    public function __construct()
    {
        parent::__construct();
        $this->load->model('GejalaModel');
        $this->load->model('RuleModel');
        $this->load->model('KerusakanModel');
        $this->load->model('SolusiKerusakanModel');
        $this->load->model('PenyebabKerusakanModel');
        $this->load->model('ForwardChainingModel');
        $this->load->model('UserModel');
    }

    public function ajax()
    {
        $data = $this->ForwardChainingModel->Perbaikan();
        $no = 1;
        $record = [];
        foreach($data as $key => $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['nama_customer'];
            $row[] = $value['alamat_customer'];
            $row[] = $value['nama_teknisi'];
            $row[] = $value['tanggal_konsultasi'];
            $row[] = $value['tanggal_mulai_perbaikan'];
            $row[] = $value['tanggal_selesai_perbaikan'];
            $row[] = $value['nama_cs'];
            $row[] = $value['status_perbaikan'];
            $button = '<button type="button" name="update" url="' . base_url() . 'konsultasi/edit/' . $value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            // $button .= '<button type="button" name="delete" url="' . base_url() . 'konsultasi/destroy/' . $value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $no ++;
            $record[] = $row;
        }

        $response = [
            'data' => $record
        ];

        echo json_encode($response);
    }

    /**
     * 
     * Fungsi Mencari Best First Search
     * @param $gejala
     * 
     */
    public function bestFirstSearch($gejala)
    {

        $sql = $this->db->select('*')->from('aturan');

        if (count($gejala) > 1) {
            $batas = 1;
            foreach ($gejala as $values) {

                if ($batas == 1) {
                    $query = $sql->where(['kode_gejala' => $values]);
                }

                $get_sql = $query->or_where(['kode_gejala' => $values]);

                $batas++;
            }
        } else {
            $get_sql = $sql->where(['kode_gejala' => $gejala[0]]);
        }

        $kerusakan = $get_sql->get()->result_array();

        // $this->maintence->Debug($kerusakan);

        $kerusakan_sama = [];


        foreach ($kerusakan as $key => $value) {
            $kerusakan_sama[] = $value['kode_kerusakan'];
        }

        $total_kerusakan = array_count_values($kerusakan_sama);

        foreach ($total_kerusakan as $key => $values) {

            $kode_kerusakan = $key;

            $sql_cek_total_kerusakan = $this->db->select('kode_kerusakan')->from('aturan')->where(['kode_kerusakan' => $kode_kerusakan]);

            $total_aturan = $sql_cek_total_kerusakan->count_all_results();

            $selisih = $total_aturan - $values;

            // Cek Selisih Jika Total Aturan dalam Tabel
            if ($total_aturan < 3) {
                if ($selisih == 0) {
                    $this->kerusakan[] = $key;
                }
            } else if ($total_aturan >= 3) {
                if ($selisih <= 1) {
                    $this->kerusakan[] = $key;
                }
            }
        }
    }

    public function index()
    {
        // $data = [
        //     'gejala' => $this->GejalaModel->getAllGejala(),
        //     'action' => base_url() . 'perbaikan/store',
        // ];
        return $this->getLayout('fc/index');
    }

    public function form()
    {
        $data = [
            'gejala' => $this->GejalaModel->getAllGejala(),
            'teknisi' => $this->UserModel->getAllTeknisi(),
            'action' => base_url() . 'konsultasi/store'
        ];

        return $this->load->view('fc/form', $data);
    }

    public function getAnswer()
    {
        $answer = [];

        $post = $this->input->post();

        if (!empty($post['question'])) {

            $this->bestFirstSearch($post['question']);

            if (!empty($this->kerusakan)) {

                try {

                    $store_perbaikan = $this->ForwardChainingModel->storePerbaikan($this->kerusakan, $post['question']);

                    if ($store_perbaikan['status'] == 'notvalid') {

                        $response = [
                            'status' => 'notvalid',
                            'messages' => $store_perbaikan['messages']
                        ];
                    } else {

                        $total_kerusakan = count($this->kerusakan);

                        $diagnosa = [];

                        foreach ($this->kerusakan as $value) {

                            $kerusakan = $this->KerusakanModel->getKerusakan($value);

                            $penyebab_kerusakan = $this->PenyebabKerusakanModel->getPenyebabKerusakan($value);

                            $solusi_kerusakan = $this->SolusiKerusakanModel->getSolusiKerusakan($value);

                            $diagnosa[] = [
                                'kerusakan' => $kerusakan['nama_kerusakan'],
                                'penyebab_kerusakan' => $penyebab_kerusakan['penyebab_kerusakan'],
                                'solusi_kerusakan' => $solusi_kerusakan['solusi_kerusakan']
                            ];
                        }

                        $html = "";

                        if ($total_kerusakan > 1) {
                            $html .= "Ditemukan Lebih Dari 1 Kerusakan Kemungkinan disebabkan oleh : <br/>";
                        } else if ($total_kerusakan != 0) {
                            $html .= "Ditemukan kerusakan disebabkan oleh : <br/>";
                        } else {
                            $html .= "Tidak ditemukan kerusakan <br/>";
                        }

                        $no = 1;

                        foreach ($diagnosa as $key => $value) {

                            $html .= "<center><h4>Kerusakan ke - " . $no . "</h4></center>";

                            $html .= $value['kerusakan'] . " dengan penyebab kerusakan : <br/>";

                            $html .= $value['penyebab_kerusakan'] . "<br/>";

                            $html .= "Dengan Solusi sebagai berikut : <br/>";

                            $html .= $value['solusi_kerusakan'] . "<br/>";

                            $no++;
                        }

                        $response = [
                            'status' => 'success',
                            'kerusakan' => $html,
                            'messages' => 'Data Sukses Ditambah'
                        ];
                    }
                } catch (Exception $e) {

                    $response = [
                        'status' => 'failed',
                        'messages' => $e->getMessage()
                    ];
                }
            } else {

                $response = [
                    'status' => 'failed',
                    'messages' => 'Kerusakan Tidak Ditemukan'
                ];

            }
        } else {

            $response = [
                'status' => 'failed',
                'messages' => 'Inputan Tidak Boleh Kosong'
            ];
        }

        echo json_encode($response);
    }

    public function view($id)
    {
        $view = $this->ForwardChainingModel->detailPerbaikan($id);

        $data = [
            'view' => $view
        ];

        // $this->maintence->Debug($data);

        return $this->load->view('fc/detail', $data);
    }
}
