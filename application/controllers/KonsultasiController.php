<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('ForwardChainingController.php');

class KonsultasiController extends ForwardChainingController
{

    public function ajax_konsultasi()
    {
        $data = $this->ForwardChainingModel->Konsultasi();
        $no = 1;
        $record = [];
        foreach ($data as $key => $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['nama_customer'];
            $row[] = $value['alamat_customer'];
            $row[] = $value['no_telepon_customer'];
            $row[] = $value['tanggal_konsultasi'];
            $row[] = $value['nama_cs'];
            $button = '<button type="button" name="update" url="' . base_url() . 'konsultasi/edit/' . $value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            // $button .= '<button type="button" name="delete" url="' . base_url() . 'konsultasi/destroy/' . $value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $no++;
            $record[] = $row;
        }

        $response = [
            'data' => $record
        ];

        echo json_encode($response);
    }

    public function index()
    {
        return $this->getLayout('konsultasi/index');
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

    private function renderHTML($id, $param)
    {
        if (empty($id)) {
            $gejala = $this->ForwardChainingModel->rootQuestion();
        } else {
            $gejala = $this->ForwardChainingModel->rootQuestion($id);
        }

        // $this->maintence->Debug($gejala);

        $html = '';
        $html .= '<form action="#" id="form" method="post" enctype="multipart/form-data">';
        $html .= '<div class="form-group">';
        if (!empty($gejala['kerusakan'])) {
            if ($param == "next") {
                if (!empty($gejala['gejala'])) {
                    $cnt = count($gejala['gejala']);
                    foreach ($gejala['gejala'] as $key => $value) {
                        $html .= '<div class="radio">';
                        $html .= '<label>';
                        $html .= '<input type = "radio" id = "id_gejala" name = "id_gejala" value = ' . $value['id'] . '>' . $value['kode_gejala'] . ' - ' . $value['nama_gejala'];
                        $html .= '</label>';
                        $html .= '</div>';
                    }
                    $html .= '<div class="form-group">';
                    $html .= '<button type="button" action = "'. base_url()."konsultasi/stopquestion/".$gejala['gejala'][$cnt - 1]['id'].'/stop" id="stop" class="next btn btn-success"><i class="fa fa-search"></i> Cek Kerusakan</button>';
                    $html .= ' &nbsp; <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>';
                    $html .= '</div>';
                } else {
                    $html .= '<b><h3>Ditemukan Kerusakan</h3></b>';
                    $html .= $gejala['kerusakan'][0]['kode_kerusakan'] . ' - ' . $gejala['kerusakan'][0]['nama_kerusakan'];
                    $html .= '<div class="form-group">';
                    $html .= '<button type="button" id="simpan" class="next btn btn-success"><i class="fa fa-save"></i> Simpan Kerusakan</button>';
                    $html .= '&nbsp; <button type="reset" action = "' . base_url() . "konsultasi/form" . '" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi</button>';
                    $html .= '</div>';
                }
            } else if ($param == 'stop') {
                $html .= '<b><h3>Kemungkinan Ditemukan Kerusakan</h3></b>';
                $html .= $gejala['kerusakan'][0]['kode_kerusakan'] . ' - ' . $gejala['kerusakan'][0]['nama_kerusakan'];
                $html .= '<div class="form-group">';
                $html .= '<button type="button" id="simpan" class="next btn btn-success"><i class="fa fa-save"></i> Simpan Kerusakan</button>';
                $html .= '&nbsp; <button type="reset" action = "' . base_url() . "konsultasi/form" . '" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi</button>';
                $html .= '</div>';
            }
        } else {
            foreach ($gejala['gejala'] as $key => $value) {
                $html .= '<div class="radio">';
                $html .= '<label>';
                $html .= '<input type = "radio" id = "id_gejala" name = "id_gejala" value = ' . $value['id'] . '>' . $value['kode_gejala'] . ' - ' . $value['nama_gejala'];
                $html .= '</label>';
                $html .= '</div>';
            }
        }

        return $html;
    }

    public function konsultasiForm()
    {
        $data = [
            'gejala' => $this->renderHTML(null, 'next'),
        ];
        return $this->getLayout('konsultasi/form', $data);
    }

    public function getNextQuestion($id, $next)
    {
        $response = [
            'gejala' => $this->renderHTML($id, $next),
        ];

        echo json_encode($response);
    }

    public function getStopQuestion($id, $stop)
    {
        $response = [
            'gejala' => $this->renderHTML($id, $stop),
        ];

        echo json_encode($response);
    }

    public function getAnswer()
    {
        $answer = [];

        $post = $this->input->post();

        if (!empty($post['question'])) {

            if (count($post['question']) > 1) {

                $this->bestFirstSearch($post['question']);

                if (!empty($this->kerusakan)) {

                    try {

                        $store_perbaikan = $this->ForwardChainingModel->storeKonsultasi($this->kerusakan, $post['question']);

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

                            // Tabel Gejala

                            $html .= '<table id="gejala" class="table table-bordered table-striped">';
                            $html .= '<thead>';
                            $html .= '<tr>';
                            $html .= '<th>No</th>';
                            $html .= '<th>Nama Gejala</th>';
                            $html .= '</tr>';
                            $html .= '</thead>';
                            $html .= '<tbody>';

                            $no = 1;

                            foreach ($post['question'] as $value) {

                                $gejala_nama = $this->GejalaModel->getGejala($value);

                                $html .= '<tr>';
                                $html .= '<td>' . $no . '</td>';
                                $html .= '<td>' . $gejala_nama['nama_gejala'] . '</td>';

                                $no++;
                            }

                            $html .= '</tbody>';
                            $html .= '</table>';

                            // Tabel Kerusakan

                            $html .= '<table id="kerusakan" class="table table-bordered table-striped">';
                            $html .= '<thead>';
                            $html .= '<tr>';
                            $html .= '<th>No</th>';
                            $html .= '<th>Nama Kerusakan</th>';
                            $html .= '<th>Penyebab Kerusakan</th>';
                            $html .= '<th>Solusi Kerusakan</th>';
                            $html .= '</tr>';
                            $html .= '</thead>';
                            $html .= '<tbody>';

                            $no = 1;

                            foreach ($diagnosa as $key => $value) {

                                $html .= '<tr>';
                                $html .= '<td>' . $no . '</td>';
                                $html .= '<td>' . $value['kerusakan'] . '</td>';
                                $html .= '<td>' . $value['penyebab_kerusakan'] . '</td>';
                                $html .= '<td>' . $value['solusi_kerusakan'] . '</td>';

                                $no++;
                            }

                            $html .= '</tbody>';
                            $html .= '</table>';

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
                    'messages' => 'Gejala Harus Lebih Dari Satu'
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

    public function viewKonsultasi($id)
    {
        $view = $this->ForwardChainingModel->detailKonsultasi($id);

        $data = [
            'view' => $view
        ];

        return $this->load->view('fc/detail', $data);
    }
}
