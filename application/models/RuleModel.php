<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RuleModel extends MainModel
{
    public function Rule()
    {
        $query = $this->db->select('*')->from('rule')->get();
        return $query->result_array();
    }

    public function storeRule()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $row = [];
            $gejala = [];

            $jumlah_centang = count($post['kode_gejala']);

            $data_rule = [
                'kode_kerusakan' => $post['kode_kerusakan'],
                'gejala' => implode('->', $post['kode_gejala'])
            ];

            $this->db->trans_start();

            $this->db->insert('rule', $data_rule);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();

                $id = $this->db->select('id')->from('rule')->order_by('id', 'DESC')->limit(1)->get()->row_array();

                for ($i = 0; $i < $jumlah_centang; $i++) {
                    if ($i != $jumlah_centang - 1) {
                        $row['parent_kode_gejala'] = $post['kode_gejala'][$i];
                        $row['child_kode_gejala'] = $post['kode_gejala'][$i + 1];
                        $gejala[] = $row;
                    }
                }

                $jumlah_gejala = count($gejala);
                $row = [];
                $rule = [];


                for ($j = 0; $j < $jumlah_gejala; $j++) {
                    if ($j == $jumlah_gejala - 1) {
                        $row['id_rule'] = $id['id'];
                        $row['parent_kode_gejala'] = $gejala[$j]['parent_kode_gejala'];
                        $row['child_kode_gejala'] = $gejala[$j]['child_kode_gejala'];
                        $row['kode_kerusakan'] = $post['kode_kerusakan'];
                    } else {
                        $row['id_rule'] = $id['id'];
                        $row['parent_kode_gejala'] = $gejala[$j]['parent_kode_gejala'];
                        $row['child_kode_gejala'] = $gejala[$j]['child_kode_gejala'];
                        $row['kode_kerusakan'] = NULL;
                    }

                    $record[] = $row;
                }

                $this->db->trans_start();

                $this->db->insert_batch('rule_breadth', $record);

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }

                $response = [
                    'status' => 'success',
                ];
                $status = 0;
            }
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
        $rule = $this->db->select('*')->from('rule')->where(['id' => $id])->get();
        return $rule->row_array();
    }

    public function updateRule()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $row = [];
            $gejala = [];

            $jumlah_centang = count($post['kode_gejala']);

            $data_rule = [
                'kode_kerusakan' => $post['kode_kerusakan'],
                'gejala' => implode('->', $post['kode_gejala'])
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $post['id']])->update('rule', $data_rule);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();

                $this->db->where(['id_rule' => $post['id']])->delete('rule_breadth');

                for ($i = 0; $i < $jumlah_centang; $i++) {
                    if ($i != $jumlah_centang - 1) {
                        $row['parent_kode_gejala'] = $post['kode_gejala'][$i];
                        $row['child_kode_gejala'] = $post['kode_gejala'][$i + 1];
                        $gejala[] = $row;
                    }
                }

                $jumlah_gejala = count($gejala);
                $row = [];
                $rule = [];


                for ($j = 0; $j < $jumlah_gejala; $j++) {
                    if ($j == $jumlah_gejala - 1) {
                        $row['id_rule'] = $post['id'];
                        $row['parent_kode_gejala'] = $gejala[$j]['parent_kode_gejala'];
                        $row['child_kode_gejala'] = $gejala[$j]['child_kode_gejala'];
                        $row['kode_kerusakan'] = $post['kode_kerusakan'];
                    } else {
                        $row['id_rule'] = $post['id'];
                        $row['parent_kode_gejala'] = $gejala[$j]['parent_kode_gejala'];
                        $row['child_kode_gejala'] = $gejala[$j]['child_kode_gejala'];
                        $row['kode_kerusakan'] = NULL;
                    }

                    $record[] = $row;
                }

                $this->db->trans_start();

                $this->db->insert_batch('rule_breadth', $record);

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }

                $response = [
                    'status' => 'success',
                ];
                $status = 0;
            }

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
        $rule_breadth = $this->db->select('*')->from('rule_breadth')->where(['id_rule' => $id])->get()->result_array();
        $rule = $this->db->select('*')->from('rule')->where(['id' => $id])->get()->row_array();


        $post = [
            'rule_breadth' => $rule_breadth,
            'rule' => $rule
        ];

        $this->db->where(['id_rule' => $id])->delete('rule_breadth');
        $this->db->where(['id' => $id])->delete('rule');
        $this->insertLog($this->session->userdata('name'), 'hapus-aturan', $post, 0);
    }

    public function getAllRule()
    {
        $rule = $this->db->select('*')->from('rule_breadth')->get();
        return $rule->result_array();
    }

    public function getRule($id)
    {
        $rule = $this->db->select('*')->from('rule')->where(['id' => $id])->get();
        return $rule->result_array();
    }
}
