<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class ForwardChainingController extends MainController
{

    protected $kerusakan = []; // Untuk menampung data kerusakan

    public function __construct()
    {
        parent::__construct();
        $this->load->model('GejalaModel');
        $this->load->model('RuleModel');
        $this->load->model('KerusakanModel');
        $this->load->model('SolusiKerusakanModel');
        $this->load->model('PenyebabKerusakanModel');
        $this->load->model('ForwardChainingModel');
        $this->load->model('UserModel');
    }

    /**
     * 
     * Fungsi Mencari Best First Search
     * @param $gejala
     * 
     */
    public function bestFirstSearch($gejala)
    {

        $sql = $this->db->select('*')->from('aturan');

        if (count($gejala) > 1) {
            $batas = 1;
            foreach ($gejala as $values) {

                if ($batas == 1) {
                    $query = $sql->where(['kode_gejala' => $values]);
                }

                $get_sql = $query->or_where(['kode_gejala' => $values]);

                $batas++;
            }
        } else {
            $get_sql = $sql->where(['kode_gejala' => $gejala[0]]);
        }

        $kerusakan = $get_sql->get()->result_array();

        $kerusakan_sama = [];
        $gejala_exist = [];


        foreach ($kerusakan as $key => $value) {
            $kerusakan_sama[] = $value['kode_kerusakan'];
        }

        $total_kerusakan = array_count_values($kerusakan_sama);

        $this->maintence->Debug($total_kerusakan);

        foreach ($total_kerusakan as $key => $values) {

            if ($values > 1) {

                $kode_kerusakan = $key;

                $sql_cek_total_kerusakan = $this->db->select('kode_kerusakan')->from('aturan')->where(['kode_kerusakan' => $kode_kerusakan]);

                $total_aturan = $sql_cek_total_kerusakan->count_all_results();

                $selisih = $total_aturan - $values;

                if($total_aturan == 2) {
                    if($selisih == 0) {
                        $this->kerusakan[] = $key;
                    }
                } else if($total_aturan == 3) {
                    if($selisih <= 1) {
                        $this->kerusakan[] = $key;
                    }
                } else if($total_aturan == 4) {
                    if($selisih <= 2) {
                        $this->kerusakan[] = $key;
                    }
                }
            }

        }

        $this->maintence->Debug($this->kerusakan);
    }
    
}
