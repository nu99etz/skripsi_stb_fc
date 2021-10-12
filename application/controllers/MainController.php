<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once(__DIR__ . '/../../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class MainController extends CI_Controller
{

  public function __construct()
  {

    parent::__construct();

    if (!$this->session->userdata('logged')) {
      redirect('gate/');
    }
  }

  public function getLayout($layout, $data = null)
  {
    $data['sidebar'] = [
      'Dashboard' => [
        'name' => 'Dashboard',
        'icon' => 'fa fa-dashboard',
        'url' => base_url()
      ],

      'Master User' => [
        'name' => 'Master User',
        'icon' => 'fa fa-user',
        'child' => [
          'Master-1' => [
            'name' => 'Data Pegawai',
            'icon' => 'fa fa-user',
            'url' => base_url() . 'pegawai'
          ],
          'Master-2' => [
            'name' => 'Data User',
            'icon' => 'fa fa-user',
            'url' => base_url() . 'user'
          ],
        ]
      ],

      'Log' => [
        'name' => 'Activity Log',
        'icon' => 'fa fa-database',
        'url' => base_url(). 'log'
      ],

      // 'Data Uji' => [
      //   'name' => 'Data Uji',
      //   'icon' => 'fa fa-database',
      //   'child' => [
      //     'Master-1' => [
      //       'name' => 'Data Uji',
      //       'icon' => 'fa fa-database',
      //       'url' => base_url() . 'data_uji'
      //     ],
      //     'Master-2' => [
      //       'name' => 'Data Uji NaiveBayes',
      //       'icon' => 'fa fa-database',
      //       'url' => base_url() . 'data_uji_nb'
      //     ],
      //   ]
      // ],
      // 'User' => [
      //   'name' => 'User',
      //   'icon' => 'fa fa-user',
      //   'url' => '#'
      // ],
    ];
    $this->load->view('_partial/header', $data);
    $this->load->view('_partial/navbar', $data);
    $this->load->view('_partial/sidebar', $data);
    if (is_array($layout)) {
      foreach ($layout as $layouts) {
        $this->load->view($layouts, $data);
      }
    } else {
      $this->load->view($layout, $data);
    }
    $this->load->view('_partial/footer', $data);
  }

  public function import_excel($files, $type = 'csv')
  {
    $file_mimes = array(
      'application/octet-stream',
      'application/vnd.ms-excel',
      'application/x-csv',
      'text/x-csv',
      'text/csv',
      'application/csv',
      'application/excel',
      'application/vnd.msexcel',
      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );

    if (empty($files['name'])) {
      $response = array(
        'status' => 'file not found'
      );
    } else if (!empty($files)) {
      if (isset($files['name']) && in_array($files['type'], $file_mimes)) {
        $arr_file = explode(".", $files['name']);
        $extension = end($arr_file);

        if ($extension == 'csv') {
          $reader = new Csv();
        } else if ($extension == 'xlsx') {
          $reader = new Xlsx();
        }

        $spreadsheet = $reader->load($files['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $response = array(
          'status' => 'success',
          'data' => $sheetData
        );
      }
    }
    return $response;
  }

  public function error404()
  {
    $this->getLayout('error404');
  }
}
