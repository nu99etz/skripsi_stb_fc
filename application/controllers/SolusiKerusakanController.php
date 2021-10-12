<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class SolusiKerusakanController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SolusiKerusakanModel');
        $this->load->model('KerusakanModel');
    }

    public function ajax()
    {
        $data = $this->SolusiKerusakanModel->SolusiKerusakanDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $kode_kerusakan = $this->KerusakanModel->getKerusakan($value['kode_kerusakan']);
            $row[] = $kode_kerusakan['kode_kerusakan'];
            $row[] = $value['solusi_kerusakan'];
            $button ='<button type="button" name="update" url="' . base_url().'solusi_kerusakan/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'solusi_kerusakan/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->SolusiKerusakanModel->SolusiKerusakanTotal(),
            'recordsFiltered' => $this->SolusiKerusakanModel->SolusiKerusakanFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'solusi_kerusakan/index'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'kerusakan' => $this->KerusakanModel->getLatestKerusakan('solusi_kerusakan'),
            'action' => base_url().'solusi_kerusakan/store'
        ];
        $this->load->view('solusi_kerusakan/form', $data);
    }

    public function store()
    {
        $insert = $this->SolusiKerusakanModel->storeSolusiKerusakan();
        if($insert['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => $insert['messages']
            ];
        } else if($insert['status'] == 'success') {
            $response = [
                'status' => 'success',
                'messages' => 'Data Sukses Ditambah'
            ];
        } else {
            $response = [
                'status' => 'failed',
                'messages' => 'Data Gagal Ditambah'
            ];
        }
        echo json_encode($response);
    }

    public function edit($id)
    {
        $data = [
            'action' => base_url().'solusi_kerusakan/update/'. $id,
            'kerusakan' => $this->KerusakanModel->getAllKerusakan(),
            'solusi_kerusakan' => $this->SolusiKerusakanModel->editSolusiKerusakan($id)
        ];
        $this->load->view('solusi_kerusakan/form', $data);
    }

    public function update($id)
    {
        $update = $this->SolusiKerusakanModel->updateSolusiKerusakan($id);
        if($update['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => $update['messages']
            ];
        } else if($update['status'] == 'success') {
            $response = [
                'status' => 'success',
                'messages' => 'Data Sukses Diubah'
            ];
        } else {
            $response = [
                'status' => 'failed',
                'messages' => 'Data Gagal Diubah'
            ];
        }
        echo json_encode($response);
    }

    public function destroy($id)
    {
        $this->SolusiKerusakanModel->destroySolusiKerusakan($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }
}