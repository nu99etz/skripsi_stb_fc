<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class RuleController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RuleModel');
        $this->load->model('GejalaModel');
        $this->load->model('KerusakanModel');
    }

    public function ajax()
    {
        $data = $this->RuleModel->RuleDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $parent_gejala = $this->GejalaModel->getGejala($value['parent_kode_gejala']);
            $child_gejala = $this->GejalaModel->getGejala($value['child_kode_gejala']);
            if($value['kode_kerusakan'] == NULL) {
                $kode_kerusakan['kode_kerusakan'] = '-';
            } else {
                $kode_kerusakan = $this->KerusakanModel->getKerusakan($value['kode_kerusakan']);
            }
            $row[] = $parent_gejala['kode_gejala'];
            $row[] = $child_gejala['kode_gejala'];
            $row[] = $kode_kerusakan['kode_kerusakan'];
            $button ='<button type="button" name="update" url="' . base_url().'rule/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'rule/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->RuleModel->RuleTotal(),
            'recordsFiltered' => $this->RuleModel->RuleFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'rule/index'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'action' => base_url().'rule/store',
            'gejala' => $this->GejalaModel->getAllGejala(),
            'kerusakan' => $this->KerusakanModel->getAllKerusakan()
        ];
        $this->load->view('rule/form', $data);
    }

    public function store()
    {
        $insert = $this->RuleModel->storeRule();
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
            'action' => base_url().'rule/update/'. $id,
            'rule' => $this->RuleModel->editRule($id),
            'gejala' => $this->GejalaModel->getAllGejala(),
            'kerusakan' => $this->KerusakanModel->getAllKerusakan()
        ];
        $this->load->view('rule/form', $data);
    }

    public function update($id)
    {
        $update = $this->RuleModel->updateRule($id);
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
        $this->RuleModel->destroyRule($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }
}