<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class LogActivityController extends MainController
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('LogActivityModel');

        if($this->session->userdata('role') != 1) {
            redirect('/');
        }
    }

    public function ajax()
    {
        $data = $this->LogActivityModel->LogActivityDraw();
        $record = [];
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $value['username'];
            $row[] = $value['ip_address'];
            $row[] = $value['activity_log'];
            $row[] = $value['activity_date'];
            $row[] = $value['parameters'];
            if($value['is_success'] == 0) {
                $row[] = 'Sukses';
            } else if($value['is_success'] == 1) {
                $row[] = 'Gagal';
            }
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->LogActivityModel->LogActivityTotal(),
            'recordsFiltered' => $this->LogActivityModel->LogActivityFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = array(
            'log/index'
        );
        $this->getLayout($layout);
    }
}
