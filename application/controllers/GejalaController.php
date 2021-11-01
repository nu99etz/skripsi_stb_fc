<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class GejalaController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GejalaModel');

        if($this->session->userdata('role') > 2) {
            redirect('/');
        }
    }

    public function ajax()
    {
        $data = $this->GejalaModel->GejalaDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $value['kode_gejala'];
            $row[] = $value['nama_gejala'];
            $button ='<button type="button" name="update" url="' . base_url().'gejala/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'gejala/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->GejalaModel->GejalaTotal(),
            'recordsFiltered' => $this->GejalaModel->GejalaFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'gejala/index'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'action' => base_url().'gejala/store'
        ];
        $this->load->view('gejala/form', $data);
    }

    public function store()
    {
        $insert = $this->GejalaModel->storeGejala();
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
            'action' => base_url().'gejala/update/'. $id,
            'gejala' => $this->GejalaModel->editGejala($id)
        ];
        $this->load->view('gejala/form', $data);
    }

    public function update($id)
    {
        $update = $this->GejalaModel->updateGejala($id);
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
        $this->GejalaModel->destroyGejala($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }
}