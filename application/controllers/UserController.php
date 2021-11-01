<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class UserController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');

        if($this->session->userdata('role') > 2) {
            redirect('/');
        }
    }

    public function ajax()
    {
        $data = $this->UserModel->PegawaiDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $value['kode_pegawai'];
            $row[] = $value['nama_pegawai'];
            $roles = $this->UserModel->getRoles($value['role_id']);
            $row[] = $roles['nama_role'];
            $row[] = $value['alamat_pegawai'];
            $row[] = $value['nomor_telepon_pegawai'];
            $button ='<button type="button" name="update" url="' . base_url().'pegawai/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'pegawai/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->UserModel->PegawaiTotal(),
            'recordsFiltered' => $this->UserModel->PegawaiFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'pegawai/index'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'roles' => $this->UserModel->getAllRoles(),
            'action' => base_url().'pegawai/store'
        ];
        $this->load->view('pegawai/form', $data);
    }

    public function store()
    {
        $insert = $this->UserModel->storePegawai();
        if($insert['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
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
            'roles' => $this->UserModel->getAllRoles(),
            'action' => base_url().'pegawai/update/'. $id,
            'pegawai' => $this->UserModel->editPegawai($id)
        ];
        $this->load->view('pegawai/form', $data);
    }

    public function update($id)
    {
        $update = $this->UserModel->updatePegawai($id);
        if($update['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
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
        $this->UserModel->destroyPegawai($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }

    public function ajaxUser()
    {
        $data = $this->UserModel->UserDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $nama_user = $this->UserModel->getPegawai($value['id_user']);
            $row[] = $nama_user['nama_pegawai'];
            $row[] = $value['username'];
            $row[] = $value['is_login'];
            $row[] = $value['last_login'];
            $button ='<button type="button" name="update" url="' . base_url().'user/edit/'.$value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" url="' . base_url().'user/destroy/'.$value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->UserModel->UserTotal(),
            'recordsFiltered' => $this->UserModel->UserFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function indexUser()
    {
        $layout = [
            'user/index'
        ];
        $this->getLayout($layout);
    }

    public function editUser($id)
    {
        $data = [
            'action' => base_url().'user/update/'. $id,
            'user' => $this->UserModel->editUser($id)
        ];
        $this->load->view('user/form', $data);
    }

    public function updateUser($id)
    {
        $update = $this->UserModel->updateUser($id);
        if($update['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
            ];
        } else if($update['status'] == 'success') {
            $response = [
                'status' => 'success',
                'messages' => 'Password Sukses Diubah'
            ];
        } else {
            $response = [
                'status' => 'failed',
                'messages' => 'Password Gagal Diubah'
            ];
        }
        echo json_encode($response);
    }

    public function destroyUser($id)
    {
        $this->UserModel->destroyUser($id);
        $response = [
            'status' => 'success',
            'messages' => 'Data Sukses Dihapus'
        ];
        echo json_encode($response);
    }
}
