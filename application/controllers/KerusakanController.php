<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class KerusakanController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KerusakanModel');

        if($this->session->userdata('role') > 2) {
            redirect('/');
        }
    }

    public function ajax()
    {
        $data = $this->KerusakanModel->KerusakanDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $value['kode_kerusakan'];
            $row[] = $value['nama_kerusakan'];
            $button ='<button type="button" name="update" url="' . base_url().'kerusakan/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'kerusakan/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->KerusakanModel->KerusakanTotal(),
            'recordsFiltered' => $this->KerusakanModel->KerusakanFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'kerusakan/index'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'action' => base_url().'kerusakan/store'
        ];
        $this->load->view('kerusakan/form', $data);
    }

    public function store()
    {
        $insert = $this->KerusakanModel->storeKerusakan();
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
            'action' => base_url().'kerusakan/update/'. $id,
            'kerusakan' => $this->KerusakanModel->editKerusakan($id)
        ];
        $this->load->view('kerusakan/form', $data);
    }

    public function update($id)
    {
        $update = $this->KerusakanModel->updateKerusakan($id);
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
        $this->KerusakanModel->destroyKerusakan($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }
}