<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RuleModel extends MainModel
{
    private function Rule()
    {
        $gejala['table'] = 'aturan';
        $gejala['column_search'] = [
            'parent_kode_gejala',
            'child_kode_gejala',
            'kode_kerusakan'
        ];
        $gejala['column_order'] = [
            null,
            'parent_kode_gejala',
            'child_kode_gejala',
            'kode_kerusakan',
            null
        ];
        $gejala['order'] = [
            'id' => 'ASC'
        ];
        return $gejala;
    }

    public function RuleDraw()
    {
        $rule = $this->Rule();
        return $this->getDataTables($rule['table'], $rule['column_search'], $rule['column_order'], $rule['order']);
    }

    public function RuleTotal()
    {
        $rule = $this->Rule();
        return $this->getDataTablesCountAll($rule['table'], $rule['column_search'], $rule['column_order'], $rule['order']);
    }

    public function RuleFilter()
    {
        $rule = $this->Rule();
        return $this->getDataTablesCountFiltered($rule['table'], $rule['column_search'], $rule['column_order'], $rule['order']);
    }

    public function storeRule()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('parent_kode_gejala', 'Parent Kode Gejala', 'required');
        $this->form_validation->set_rules('child_kode_gejala', 'Child Kode Gejala', 'required');
        // $this->form_validation->set_rules('kode_kerusakan', 'Child Kode Gejala', 'required');

        if ($this->form_validation->run()) {

            if(!empty($post['kode_kerusakan'])) {
                $kode_kerusakan = $post['kode_kerusakan'];
            } else {
                $kode_kerusakan = NULL;
            }

            $data_rule = [
                'parent_kode_gejala' => $post['parent_kode_gejala'],
                'child_kode_gejala' => $post['child_kode_gejala'],
                'kode_kerusakan' => $kode_kerusakan
            ];

            $this->db->trans_start();

            $this->db->insert('aturan', $data_rule);

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
        $rule = $this->db->select('*')->from('aturan')->where(['id' => $id])->get();
        return $rule->row_array();
    }

    public function updateRule($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('parent_kode_gejala', 'Parent Kode Gejala', 'required');
        $this->form_validation->set_rules('child_kode_gejala', 'Child Kode Gejala', 'required');

        if ($this->form_validation->run()) {

            if(!empty($post['kode_kerusakan'])) {
                $kode_kerusakan = $post['kode_kerusakan'];
            } else {
                $kode_kerusakan = NULL;
            }

            $data_rule = [
                'parent_kode_gejala' => $post['parent_kode_gejala'],
                'child_kode_gejala' => $post['child_kode_gejala'],
                'kode_kerusakan' => $kode_kerusakan
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $id])->update('aturan', $data_rule);

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
        $rule = $this->db->select('*')->from('aturan')->where(['id' => $id])->get()->result_array();

        $post = [
            'aturan' => $rule,
        ];

        $this->db->where(['id' => $id])->delete('aturan');
        $this->insertLog($this->session->userdata('name'), 'hapus-aturan', $post, 0);
    }
}
