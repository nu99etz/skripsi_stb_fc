<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class ForwardChainingController extends MainController
{

    protected $parent = [];
    protected $child = [];
    protected $connected = [];
    protected $kerusakan = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('GejalaModel');
        $this->load->model('RuleModel');
        $this->load->model('KerusakanModel');
        $this->load->model('SolusiKerusakanModel');
        $this->load->model('PenyebabKerusakanModel');
        $this->load->model('ForwardChainingModel');
    }

    protected function setConnected($parent, $child)
    {
        $this->connected[][$parent] = $child;
    }

    protected function setKerusakan($parent, $child, $kerusakan)
    {
        $this->kerusakan[$parent][$child] = $kerusakan;
    }

    protected function getConnected()
    {
        return $this->connected;
    }

    protected function getKerusakan()
    {
        return $this->kerusakan;
    }

    protected function getParent()
    {
        return $this->parent;
    }

    protected function getChild()
    {
        return $this->child;
    }

    public function bestFirstSearch($kode_gejala, $gejala)
    {
        // $find = [];
        // $kerusakan = [];
        $check_child = $this->ForwardChainingModel->getRule(['parent_kode_gejala' => $kode_gejala]);
        if (!empty($check_child)) {
            foreach ($check_child as $child) {
                $check_exist = $this->checkGejalaExist($child['child_kode_gejala'], $gejala);
                if ($check_exist) {
                    // $this->setConnected($child['parent_kode_gejala'], $child['child_kode_gejala']);
                    // $this->setKerusakan($child['parent_kode_gejala'], $child['child_kode_gejala'], $child['kode_kerusakan']);
                    if (!empty($child['kode_kerusakan'])) {
                        $this->kerusakan[] = $child['kode_kerusakan'];
                    }
                }
            }
        }
    }

    private function checkGejalaExist($kode_gejala, $gejala)
    {
        $find = 0;
        foreach ($gejala as $values) {
            if ($kode_gejala == $values) {
                $find++;
            }
        }

        if ($find > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        $data = [
            'gejala' => $this->GejalaModel->getAllGejala(),
            'action' => base_url() . 'question/store',
        ];
        return $this->getLayout('fc/question', $data);
    }

    public function getAnswer()
    {
        $answer = [];
        $post = $this->input->post();

        foreach ($post as $value) {
            $this->bestFirstSearch($value, $post);
        }
        // $data = [
        //     // 'connected' => $this->getConnected(),
        //     'kerusakan' => $this->getKerusakan(),
        // ];

        $total_kerusakan = count($this->kerusakan);
        // if($total_kerusakan > 1) {
        //     $string = 'kemungkinan '.implode(' kemungkinan ', $this->kerusakan);
        // } else {
        //     $string = 'kemungkinan '.implode(' kemungkinan ', $this->kerusakan);
        // }

        $diagnosa = [];
        foreach ($this->kerusakan as $value) {
            $kerusakan = $this->KerusakanModel->getKerusakan($value);
            $penyebab_kerusakan = $this->PenyebabKerusakanModel->getPenyebabKerusakan($value);
            $solusi_kerusakan = $this->SolusiKerusakanModel->getSolusiKerusakan($value);
            $diagnosa[] = [
                'kerusakan' => $kerusakan['nama_kerusakan'],
                'penyebab_kerusakan' => $penyebab_kerusakan['penyebab_kerusakan'],
                'solusi_kerusakan' => $solusi_kerusakan['solusi_kerusakan']
            ];
        }

        $html = "";
        if ($total_kerusakan > 1) {
            $html .= "Ditemukan Lebih Dari 1 Kerusakan Kemungkinan disebabkan oleh : <br/>";
        } else if($total_kerusakan != 0){
            $html .= "Ditemukan kerusakan disebabkan oleh : <br/>";
        } else {
            $html .= "Tidak ditemukan kerusakan <br/>";
        }
        $no = 1;
        foreach ($diagnosa as $key => $value) {
            $html .= "<center><h4>Kerusakan ke - ".$no."</h4></center>";
            $html .= $value['kerusakan'] . " dengan penyebab kerusakan : <br/>";
            $html .= $value['penyebab_kerusakan'] . "<br/>";
            $html .= "Dengan Solusi sebagai berikut : <br/>";
            $html .= $value['solusi_kerusakan'] . "<br/>";
            $no++;
        }


        $response = [
            'status' => 'success',
            'total_kerusakan' => count($diagnosa),
            'messages' => $html
        ];

        echo json_encode($response);
    }
}
