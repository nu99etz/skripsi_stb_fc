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

        $layout = array(
            'dashboard/dashboard'
        );
        $this->getLayout($layout, $data);
    }
}
