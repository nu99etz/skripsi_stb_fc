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

        if($this->session->userdata('role') > 2) {
            redirect('/');
        }
    }

    // public function ajax()
    // {
    //     $data = $this->RuleModel->Rule();
    //     $no = 1;
    //     $record = [];
    //     foreach ($data as $key => $value) {
    //         $row = [];
    //         $row[] = $no;
    //         $row[] = $value['kode_kerusakan'];
    //         $rule = $this->RuleModel->getRule($value['id']);
    //         $rule_ = [];
    //         foreach($rule as $value) {
    //             $gejala = $this->GejalaModel->getGejala($value['kode_gejala']);
    //             $rule_[] = $gejala['kode_gejala'];
    //         }
    //         $row[] = implode('->', $rule_);
    //         $button = '<button type="button" name="update" url="' . base_url() . 'rule/edit/' . $value['kode_kerusakan'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
    //         $button .= '<button type="button" name="delete" url="' . base_url() . 'rule/destroy/' . $value['kode_kerusakan'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
    //         $row[] = $button;
    //         $no++;
    //         $record[] = $row;
    //     }

    //     $response = [
    //         'data' => $record
    //     ];

    //     echo json_encode($response);
    // }

    public function ajax()
    {
        $data = $this->RuleModel->Rule();
        $no = 1;
        $record = [];
        foreach ($data as $key => $value) {
            $row = [];
            $row[] = $no;
            if(empty($value['kode_kerusakan'])) {
                $row[] = "-";
            } else {
                $kode_kerusakan = $this->KerusakanModel->getKerusakan($value['kode_kerusakan']);
                $row[] = $kode_kerusakan['kode_kerusakan'];
            }    
            $parent_kode_gejala = $this->GejalaModel->getGejala($value['parent_kode_gejala']);
            $child_kode_gejala = $this->GejalaModel->getGejala($value['child_kode_gejala']);
            $row[] = $parent_kode_gejala['kode_gejala'];
            $row[] = $child_kode_gejala['kode_gejala'];
            // $rule = $this->RuleModel->getRule($value['id']);
            // $rule_ = [];
            // foreach($rule as $value) {
            //     $gejala = $this->GejalaModel->getGejala($value['kode_gejala']);
            //     $rule_[] = $gejala['kode_gejala'];
            // }
            // $row[] = implode('->', $rule_);
            // $button = '<button type="button" name="update" url="' . base_url() . 'rule/edit/' . $value['id'] . '" class="edit btn btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button = '<button type="button" name="delete" url="' . base_url() . 'rule/destroy/' . $value['id'] . '" class="delete btn btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $no++;
            $record[] = $row;
        }

        $response = [
            'data' => $record
        ];

        echo json_encode($response);
    }

    public function index()
    {
        $layout = [
            'rule/index1'
        ];
        $this->getLayout($layout);
    }

    public function form()
    {
        $data = [
            'action' => base_url() . 'rule/store',
            'gejala' => $this->RulePair(),
            'kerusakan' => $this->KerusakanModel->getAllKerusakan(),
            'kode_gejala' => $this->GejalaModel->getAllGejala()
        ];
        $this->load->view('rule/form', $data);
    }

    // /**
    //  * 
    //  * Fungsi Untuk Mengambil Aturan Yang Berkaitan
    //  * 
    //  */
    // public function RulePair($kode_kerusakan = null)
    // {

    //     $gejala = $this->GejalaModel->getAllGejala();

    //     if (!empty($kode_kerusakan)) {
    //         $pair_rule = $this->RuleModel->getRule($kode_kerusakan);

    //         $rule_gejala = [];
    //         foreach ($pair_rule as $rule) {
    //             $rule_gejala[] = $rule['kode_gejala'];
    //         }
    //     }

    //     $html = '';

    //     foreach ($gejala as $value) {
    //         $html .= "<div class='checkbox'>";
    //         $html .= "<label>";
    //         if (!empty($rule_gejala)) {
    //             if (in_array($value['id'], $rule_gejala)) {
    //                 $html .= "<input type='checkbox' name='kode_gejala[]' id='" . $value['id'] . "'value='" . $value['id'] . "' checked>";
    //                 $html .= $value['kode_gejala'] . "-" . $value['nama_gejala'];
    //             } else {
    //                 $html .= "<input type='checkbox' name='kode_gejala[]' id='" . $value['id'] . "'value='" . $value['id'] . "'>";
    //                 $html .= $value['kode_gejala'] . "-" . $value['nama_gejala'];
    //             }
    //         } else {
    //             $html .= "<input type='checkbox' name='kode_gejala[]' id='" . $value['id'] . "'value='" . $value['id'] . "'>";
    //             $html .= $value['kode_gejala'] . "-" . $value['nama_gejala'];
    //         }
    //         $html .= "</label>";
    //         $html .= "</div>";
    //     }

    //     return $html;
    // }


    /**
     * 
     * Fungsi Untuk Mengambil Aturan Yang Berkaitan
     * 
     */
    public function RulePair($id = null)
    {

        $gejala = $this->GejalaModel->getAllGejala();

        if (!empty($id)) {
            $pair_rule = $this->RuleModel->getRule($id);

            $rule_gejala = [];
            foreach ($pair_rule as $rule) {
                $rule_gejala[0] = $rule['parent_kode_gejala'];
                $rule_gejala[1] = $rule['child_kode_gejala'];
            }
        }

        $html = '';

        foreach ($gejala as $value) {
            $html .= "<div class='checkbox'>";
            $html .= "<label>";
            if (!empty($rule_gejala)) {
                if (in_array($value['id'], $rule_gejala)) {
                    $html .= "<input type='checkbox' name='kode_gejala[]' id='" . $value['id'] . "'value='" . $value['id'] . "' checked>";
                    $html .= $value['kode_gejala'] . "-" . $value['nama_gejala'];
                } else {
                    $html .= "<input type='checkbox' name='kode_gejala[]' id='" . $value['id'] . "'value='" . $value['id'] . "'>";
                    $html .= $value['kode_gejala'] . "-" . $value['nama_gejala'];
                }
            } else {
                $html .= "<input type='checkbox' name='kode_gejala[]' id='" . $value['id'] . "'value='" . $value['id'] . "'>";
                $html .= $value['kode_gejala'] . "-" . $value['nama_gejala'];
            }
            $html .= "</label>";
            $html .= "</div>";
        }

        return $html;
    }

    public function store()
    {
        $insert = $this->RuleModel->storeRule();
        if ($insert['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => $insert['messages']
            ];
        } else if ($insert['status'] == 'success') {
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
        $rule = $this->RuleModel->editRule($id);
        $gejala = $this->RulePair($rule['id']);
        $kerusakan = $this->KerusakanModel->getAllKerusakan();

        $data = [
            'action' => base_url() . 'rule/update',
            'rule' => $rule,
            'gejala' => $gejala,
            'kerusakan' => $kerusakan,
        ];
        $this->load->view('rule/form', $data);
    }

    public function update()
    {
        $update = $this->RuleModel->updateRule();
        if ($update['status'] == 'notvalid') {
            $response = [
                'status' => 'notvalid',
                'messages' => $update['messages']
            ];
        } else if ($update['status'] == 'success') {
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
