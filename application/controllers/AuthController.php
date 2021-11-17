<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('UserModel');
    }

    public function index()
    {

        if ($this->session->userdata('logged')) {
            redirect('/');
        }
        $this->load->view('_partial/header');
        $this->load->view('auth/login');
    }

    public function login_ajax()
    {

        if ($this->session->userdata('logged')) {
            redirect('/');
        }

        $post = $this->input->post();
        $action = $this->AuthModel->authValidation();
        if ($action['status'] == 'failed') {
            $response = array(
                'status' => 'notvalid',
                'messages' => validation_errors()
            );
            $status = 1;
        } else if ($action['status'] == 'success') {
            $check = $this->AuthModel->authCheck($post['username']);
            if ($check) {
                if (md5($post['password']) == $check['password']) {
                    $this->AuthModel->updateLogin($check['id'], 1, date("D M j G:i:s T Y"));

                    $pegawai = $this->UserModel->getPegawai($check['id_user']);

                    if ($pegawai['role_id'] == 4) {
                        $response = array(
                            'status' => 'failed',
                            'messages' => 'Teknisi Tidak Bisa Login'
                        );
                        $pegawai  = $pegawai['nama_pegawai'];
                        $status = 1;
                    } else {

                        if ($post['username'] != $check['username']) {
                            $response = array(
                                'status' => 'failed',
                                'messages' => 'Username tidak cocok dengan yang anda inputkan'
                            );
                            $status = 1;
                        } else {
                            $session = array(
                                'logged' => TRUE,
                                'username' => $check['id'],
                                'id_pegawai' => $pegawai['id'],
                                'role' => $pegawai['role_id'],
                                'kode_pegawai' => $pegawai['kode_pegawai'],
                                'name' => $pegawai['nama_pegawai'],
                                'last_login' => $check['last_login']
                            );

                            $this->session->set_userdata($session);

                            $response = array(
                                'status' => 'success',
                                'messages' => 'Login Sukses Anda Akan Diarahkan Dalam 5 Detik'
                            );

                            $pegawai  = $session['name'];
                            $status = 0;
                        }
                    }
                } else if (md5($post['password']) != $check['password']) {
                    $response = array(
                        'status' => 'failed',
                        'messages' => 'Login Gagal Password Tidak Cocok'
                    );
                    $pegawai = $post['username'];
                    $status = 1;
                }
            } else {
                $response = array(
                    'status' => 'failed',
                    'messages' => 'Login Gagal Username Tidak Ada'
                );
                $pegawai = $post['username'];
                $status = 1;
            }
        }
        $action_data = [
            'username' => $post['username']
        ];
        $this->AuthModel->insertLog($post['username'], 'login', $action_data, $status);
        echo json_encode($response);
    }

    public function logout()
    {
        $id = $this->session->userdata('username');
        $update = $this->AuthModel->updateLogin($id, "0", date("D M j G:i:s T Y"));
        if ($update['status'] == 'success') {
            $this->session->set_userdata(array());
            $this->session->sess_destroy();
            $response = array(
                'status' => 'success',
                'messages' => 'Anda Sudah Keluar '
            );
            $status = 0;
        } else if ($update['status'] == 'failed') {
            $response = array(
                'status' => 'failed',
                'messages' => 'Gagal Keluar  '
            );
            $status = 1;
        }
        $action_data = [
            'username' => $this->session->userdata('name')
        ];
        $this->AuthModel->insertLog($this->session->userdata('name'), 'logout', $action_data, $status);
        echo json_encode($response);
    }

    public function store()
    {
        $action = $this->AuthModel->storeAction();
        if ($action['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'messages' => 'Data Sukses Tersimpan'
            );
        } else if ($action['status'] == 'failed') {
            $response = array(
                'status' => 'failed',
                'messages' => 'Data Gagal Tersimpan'
            );
        } else if ($action['status'] == 'notvalid') {
            $response = array(
                'status' => 'notvalid',
                'messages' => validation_errors()
            );
        }
        echo json_encode($response);
    }
}
