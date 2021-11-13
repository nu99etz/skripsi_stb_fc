<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class DashboardController extends MainController
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        $data['pegawai'] = $this->UserModel->PegawaiTotal();
        $data['user'] = $this->UserModel->UserTotal();

        if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2) {
            $loc = 'dashboard';
        } else {
            $loc = 'customer_service';
        }

        $layout = array(
            $loc.'/dashboard'
        );
        $this->getLayout($layout, $data);
    }
}
