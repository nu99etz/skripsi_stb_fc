<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('ForwardChainingController.php');

class KonsultasiController extends ForwardChainingController
{

    public function ajax_perbaikan()
    {
        $data = $this->ForwardChainingModel->Perbaikan();
        $no = 1;
        $record = [];
        foreach ($data as $key => $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['nama_customer'];
            $row[] = $value['alamat_customer'];
            $row[] = $value['no_telepon_customer'];
            $row[] = $value['tanggal_konsultasi'];
            $row[] = $value['tanggal_mulai_perbaikan'];
            $row[] = $value['tanggal_selesai_perbaikan'];
            $button = '<button type="button" name="update" url="' . base_url() . 'perbaikan/detailPerbaikan/' . $value['id'] . '" class="edit btn btn-primary btn-sm"><i class = "fa fa-eye"></i></button> ';
            if($value['status_perbaikan'] == 0) {
                $sp = 'Belum Selesai';
                $button .= '<button type="button" name="selesai" url="' . base_url() . 'perbaikan/selesai/' . $value['id'] . '" class="selesai btn btn-danger btn-sm"><i class = "fa fa-cog"></i></button> ';
            } else if($value['status_perbaikan'] == 1) {
                $sp = 'Selesai';
            }
            $row[] = $sp;
            $row[] = $value['nama_teknisi'];
            $row[] = $value['nama_cs'];
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
        $this->ForwardChainingModel->getDeleteKonsul('all');
        return $this->getLayout('konsultasi/index');
    }

    private function renderHTML($id, $param)
    {
        if (empty($id)) {
            $gejala = $this->ForwardChainingModel->rootQuestion();
        } else {
            $gejala = $this->ForwardChainingModel->rootQuestion($id);
        }

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
                    $html .= '<button type="button" action = "' . base_url() . "konsultasi/stopquestion/" . $gejala['gejala'][$cnt - 1]['id'] . '/stop" id="stop" class="next btn btn-success"><i class="fa fa-search"></i> Cek Kerusakan</button>';
                    // $html .= '&nbsp; <button type="reset" action = "' . base_url() . "konsultasi/rootquestion" . '" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi</button>';
                    $html .= '</div>';
                } else {
                    $html .= '<b><h3>Ditemukan Kerusakan</h3></b>';
                    $html .= '<p>'.$gejala['kerusakan'][0]['kode_kerusakan'] . ' - ' . $gejala['kerusakan'][0]['nama_kerusakan'].'</p>';
                    $html .= '<input type = "hidden" name = "id_kerusakan" id ="id_kerusakan" value = "'. $gejala['kerusakan'][0]['id'] . '">';
                    $html .= '<div class="form-group">';
                    $html .= '<button type="button" id="simpan" class="next btn btn-success"><i class="fa fa-cog"></i> Perbaikan</button>';
                    $html .= '&nbsp; <button type="reset" action = "' . base_url() . "konsultasi/rootquestion" . '" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi</button>';
                    $html .= '</div>';
                }
            } else if ($param == 'stop') {
                $html .= '<b><h3>Kemungkinan Ditemukan Kerusakan</h3></b>';
                $html .= '<p>'.$gejala['kerusakan'][0]['kode_kerusakan'] . ' - ' . $gejala['kerusakan'][0]['nama_kerusakan'].'</p>';
                $html .= '<input type = "hidden" name = "id_kerusakan" id ="id_kerusakan" value = "'. $gejala['kerusakan'][0]['id'] . '">';
                $html .= '<div class="form-group">';
                $html .= '<button type="button" id="simpan" class="next btn btn-success"><i class="fa fa-cog"></i> Perbaikan</button>';
                $html .= '&nbsp; <button type="reset" action = "' . base_url() . "konsultasi/rootquestion" . '" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi</button>';
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

    public function rootQuestion()
    {
        $this->ForwardChainingModel->getDeleteKonsul();

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

    // public function getAnswer()
    // {
    //     $answer = [];

    //     $post = $this->input->post();

    //     if (!empty($post['question'])) {

    //         if (count($post['question']) > 1) {

    //             $this->bestFirstSearch($post['question']);

    //             if (!empty($this->kerusakan)) {

    //                 try {

    //                     $store_perbaikan = $this->ForwardChainingModel->storeKonsultasi($this->kerusakan, $post['question']);

    //                     if ($store_perbaikan['status'] == 'notvalid') {

    //                         $response = [
    //                             'status' => 'notvalid',
    //                             'messages' => $store_perbaikan['messages']
    //                         ];
    //                     } else {

    //                         $total_kerusakan = count($this->kerusakan);

    //                         $diagnosa = [];

    //                         foreach ($this->kerusakan as $value) {

    //                             $kerusakan = $this->KerusakanModel->getKerusakan($value);

    //                             $penyebab_kerusakan = $this->PenyebabKerusakanModel->getPenyebabKerusakan($value);

    //                             $solusi_kerusakan = $this->SolusiKerusakanModel->getSolusiKerusakan($value);

    //                             $diagnosa[] = [
    //                                 'kerusakan' => $kerusakan['nama_kerusakan'],
    //                                 'penyebab_kerusakan' => $penyebab_kerusakan['penyebab_kerusakan'],
    //                                 'solusi_kerusakan' => $solusi_kerusakan['solusi_kerusakan']
    //                             ];
    //                         }

    //                         $html = "";

    //                         if ($total_kerusakan > 1) {
    //                             $html .= "Ditemukan Lebih Dari 1 Kerusakan Kemungkinan disebabkan oleh : <br/>";
    //                         } else if ($total_kerusakan != 0) {
    //                             $html .= "Ditemukan kerusakan disebabkan oleh : <br/>";
    //                         } else {
    //                             $html .= "Tidak ditemukan kerusakan <br/>";
    //                         }

    //                         // Tabel Gejala

    //                         $html .= '<table id="gejala" class="table table-bordered table-striped">';
    //                         $html .= '<thead>';
    //                         $html .= '<tr>';
    //                         $html .= '<th>No</th>';
    //                         $html .= '<th>Nama Gejala</th>';
    //                         $html .= '</tr>';
    //                         $html .= '</thead>';
    //                         $html .= '<tbody>';

    //                         $no = 1;

    //                         foreach ($post['question'] as $value) {

    //                             $gejala_nama = $this->GejalaModel->getGejala($value);

    //                             $html .= '<tr>';
    //                             $html .= '<td>' . $no . '</td>';
    //                             $html .= '<td>' . $gejala_nama['nama_gejala'] . '</td>';

    //                             $no++;
    //                         }

    //                         $html .= '</tbody>';
    //                         $html .= '</table>';

    //                         // Tabel Kerusakan

    //                         $html .= '<table id="kerusakan" class="table table-bordered table-striped">';
    //                         $html .= '<thead>';
    //                         $html .= '<tr>';
    //                         $html .= '<th>No</th>';
    //                         $html .= '<th>Nama Kerusakan</th>';
    //                         $html .= '<th>Penyebab Kerusakan</th>';
    //                         $html .= '<th>Solusi Kerusakan</th>';
    //                         $html .= '</tr>';
    //                         $html .= '</thead>';
    //                         $html .= '<tbody>';

    //                         $no = 1;

    //                         foreach ($diagnosa as $key => $value) {

    //                             $html .= '<tr>';
    //                             $html .= '<td>' . $no . '</td>';
    //                             $html .= '<td>' . $value['kerusakan'] . '</td>';
    //                             $html .= '<td>' . $value['penyebab_kerusakan'] . '</td>';
    //                             $html .= '<td>' . $value['solusi_kerusakan'] . '</td>';

    //                             $no++;
    //                         }

    //                         $html .= '</tbody>';
    //                         $html .= '</table>';

    //                         $response = [
    //                             'status' => 'success',
    //                             'kerusakan' => $html,
    //                             'messages' => 'Data Sukses Ditambah'
    //                         ];
    //                     }
    //                 } catch (Exception $e) {

    //                     $response = [
    //                         'status' => 'failed',
    //                         'messages' => $e->getMessage()
    //                     ];
    //                 }
    //             } else {

    //                 $response = [
    //                     'status' => 'failed',
    //                     'messages' => 'Kerusakan Tidak Ditemukan'
    //                 ];
    //             }
    //         } else {

    //             $response = [
    //                 'status' => 'failed',
    //                 'messages' => 'Gejala Harus Lebih Dari Satu'
    //             ];
    //         }
    //     } else {

    //         $response = [
    //             'status' => 'failed',
    //             'messages' => 'Inputan Tidak Boleh Kosong'
    //         ];
    //     }

    //     echo json_encode($response);
    // }

    public function perbaikanForm($id_kerusakan)
    {
        $data = [
            'action' => base_url() . 'konsultasi/storePerbaikan',
            'teknisi' => $this->UserModel->getAllTeknisi(),
            'kerusakan' => $id_kerusakan
        ];
        return $this->load->view('konsultasi/form_perbaikan', $data);
    }

    public function storePerbaikan()
    {
        $insert = $this->ForwardChainingModel->storePerbaikan();
        if ($insert['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => $insert['messages']
            ];
        } else if ($insert['status'] == 'success') {
            $response = [
                'status' => 'success',
                'url' => base_url().'perbaikan',
            ];
        } else {
            $response = [
                'status' => 'failed',
                'messages' => 'Data Gagal Ditambah'
            ];
        }
        echo json_encode($response);
    }

    public function viewPerbaikan($id)
    {
        $view = $this->ForwardChainingModel->detailPerbaikan($id);

        $data = [
            'view' => $view
        ];

        return $this->load->view('fc/detail', $data);
    }

    public function selesaiPerbaikan($id)
    {
        $upd_perbaikan = $this->ForwardChainingModel->selesaiPerbaikan($id);
        if($upd_perbaikan['status'] == 'success') {
            $response = [
                'status' => 'success',
                'messages' => 'Perbaikan Telah Diselesaikan'
            ];
        } else {
            $response = [
                'status' => 'failed',
                'messages' => 'Perbaikan Gagal Diselesaikan'
            ];
        }
        echo json_encode($response);
    }
}
