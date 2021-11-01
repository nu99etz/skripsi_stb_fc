<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RuleModel extends MainModel
{
    public function Rule()
    {
        // $sql = $this->db->select('aturan.*, gejala.kode_gejala, gejala.nama_gejala, kerusakan.kode_kerusakan, kerusakan.nama_kerusakan')->from('aturan')->join('gejala', 'aturan.kode_gejala = gejala.id', 'left')->join('kerusakan', 'aturan.kode_kerusakan = kerusakan.id', 'left')->get();
        $sql = "select*from kerusakan where id in (select kode_kerusakan from aturan)";
        $query = $this->db->query($sql);
        // return $sql->result_array();
        return $query->result_array();
    }

    public function storeRule()
    {
        $post = $this->input->post();
        
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');

        if ($this->form_validation->run()) {
            
            // $this->maintence->Debug($record);

            $this->db->trans_start();

            $row = [];
            $record = [];
            
            for($i = 0; $i < count($post['kode_gejala']); $i ++) {
                $row['kode_gejala'] = $post['kode_gejala'][$i];
                $row['kode_kerusakan'] = $post['kode_kerusakan'];
                $record[] = $row;
            }

            $this->db->insert_batch('aturan', $record);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

            $response = [
                'status' => 'success',
            ];
            $status = 0;
        } else {
            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
            ];
            $status = 1;
        }
        $this->insertLog($this->session->userdata('name'), 'insert-aturan', $post, $status);
        return $response;
    }

    public function editRule($id)
    {
        $rule = $this->db->select('*')->from('aturan')->where(['kode_kerusakan' => $id])->get();
        return $rule->row_array();
    }

    public function updateRule()
    {
        $post = $this->input->post();
        
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $this->db->trans_start();

            $this->UnpairRule($post['kode_kerusakan']);

            $row = [];
            $record = [];
            
            for($i = 0; $i < count($post['kode_gejala']); $i ++) {
                $row['kode_gejala'] = $post['kode_gejala'][$i];
                $row['kode_kerusakan'] = $post['kode_kerusakan'];
                $record[] = $row;
            }

            $this->db->insert_batch('aturan', $record);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

            $response = [
                'status' => 'success',
            ];
            $status = 0;
        } else {
            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
            ];
            $status = 1;
        }
        $this->insertLog($this->session->userdata('name'), 'update-aturan', $post, $status);
        return $response;
    }

    public function destroyRule($id)
    {
        $rule = $this->db->select('*')->from('aturan')->where(['kode_kerusakan' => $id])->get()->result_array();

        $post = [
            'aturan' => $rule,
        ];

        $this->db->where(['kode_kerusakan' => $id])->delete('aturan');
        $this->insertLog($this->session->userdata('name'), 'hapus-aturan', $post, 0);
    }

    public function getAllRule()
    {
        $rule = $this->db->select('*')->from('aturan')->get();
        return $rule->result_array();
    }

    public function getRule($kode_kerusakan)
    {
        $rule = $this->db->select('*')->from('aturan')->where(['kode_kerusakan' => $kode_kerusakan])->get();
        return $rule->result_array();
    }

    private function UnpairRule($kode_kerusakan)
    {
        $where_clause = [
            'kode_kerusakan' => $kode_kerusakan,
        ];
        $this->db->where($where_clause)->delete('aturan');
    }
}
