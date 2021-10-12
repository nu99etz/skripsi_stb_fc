<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class PenyebabKerusakanController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PenyebabKerusakanModel');
        $this->load->model('KerusakanModel');
    }

    public function ajax()
    {
        $data = $this->PenyebabKerusakanModel->PenyebabKerusakanDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $kode_kerusakan = $this->KerusakanModel->getKerusakan($value['kode_kerusakan']);
            $row[] = $kode_kerusakan['kode_kerusakan'];
            $row[] = $value['penyebab_kerusakan'];
            $button ='<button type="button" name="update" url="' . base_url().'penyebab_kerusakan/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'penyebab_kerusakan/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->PenyebabKerusakanModel->PenyebabKerusakanTotal(),
            'recordsFiltered' => $this->PenyebabKerusakanModel->PenyebabKerusakanFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'penyebab_kerusakan/index'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'kerusakan' => $this->KerusakanModel->getLatestKerusakan('penyebab_kerusakan'),
            'action' => base_url().'penyebab_kerusakan/store'
        ];
        $this->load->view('penyebab_kerusakan/form', $data);
    }

    public function store()
    {
        $insert = $this->PenyebabKerusakanModel->storePenyebabKerusakan();
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
            'action' => base_url().'penyebab_kerusakan/update/'. $id,
            'kerusakan' => $this->KerusakanModel->getAllKerusakan(),
            'penyebab_kerusakan' => $this->PenyebabKerusakanModel->editPenyebabKerusakan($id)
        ];
        $this->load->view('penyebab_kerusakan/form', $data);
    }

    public function update($id)
    {
        $update = $this->PenyebabKerusakanModel->updatePenyebabKerusakan($id);
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
        $this->PenyebabKerusakanModel->destroyPenyebabKerusakan($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }
}