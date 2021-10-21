<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GejalaModel extends MainModel
{
    private function Gejala()
    {
        $gejala['table'] = 'gejala';
        $gejala['column_search'] = [
            'kode_gejala',
            'nama_gejala',
        ];
        $gejala['column_order'] = [
            null,
            'kode_gejala',
            'nama_gejala',
            null
        ];
        $gejala['order'] = [
            'id' => 'ASC'
        ];
        return $gejala;
    }

    public function GejalaDraw()
    {
        $gejala = $this->Gejala();
        return $this->getDataTables($gejala['table'], $gejala['column_search'], $gejala['column_order'], $gejala['order']);
    }

    public function GejalaTotal()
    {
        $gejala = $this->Gejala();
        return $this->getDataTablesCountAll($gejala['table'], $gejala['column_search'], $gejala['column_order'], $gejala['order']);
    }

    public function GejalaFilter()
    {
        $gejala = $this->Gejala();
        return $this->getDataTablesCountFiltered($gejala['table'], $gejala['column_search'], $gejala['column_order'], $gejala['order']);
    }

    public function storeGejala()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('kode_gejala', 'Kode Gejala', 'required');
        $this->form_validation->set_rules('nama_gejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run()) {

            $check_gejala_id = $this->db->select('kode_gejala')->from('gejala')->where(['kode_gejala' => strtoupper($post['kode_gejala'])]);

            if ($check_gejala_id->count_all_results() > 0) {
                $response = [
                    'status' => 'notvalid',
                    'messages' => 'Kode Gejala Sudah Digunakan'
                ];
                $status = 1;
            } else {
                $data_gejala = [
                    'kode_gejala' => strtoupper($post['kode_gejala']),
                    'nama_gejala' => ucwords($post['nama_gejala']),
                ];

                $this->db->trans_start();

                $this->db->insert('gejala', $data_gejala);

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
        $this->insertLog($this->session->userdata('name'), 'insert-gejala', $post, $status);
        return $response;
    }

    public function editGejala($id)
    {
        $gejala = $this->db->select('*')->from('gejala')->where(['id' => $id])->get();
        return $gejala->row_array();
    }

    public function updateGejala($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('nama_gejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run()) {

            $data_gejala = [
                'nama_gejala' => ucwords($post['nama_gejala']),
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $id])->update('gejala', $data_gejala);

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
        $this->insertLog($this->session->userdata('name'), 'update-gejala', $post, $status);
        return $response;
    }

    public function destroyGejala($id)
    {
        $aturan = $this->db->select('*')->from('aturan')->where(['parent_kode_gejala' => $id]);
        if ($aturan->count_all_results() > 0) {
            $aturan_record = $this->db->select('*')->from('aturan')->where(['parent_kode_gejala' => $id])->get()->result_array();
            $this->db->where(['parent_kode_gejala' => $id])->delete('aturan');
        } else {
            $aturan_record = [];
        }

        $gejala = $this->db->select('*')->from('gejala')->where(['id' => $id])->get()->result_array();

        $post = [
            'aturan' => $aturan_record,
            'gejala' => $gejala
        ];

        $this->db->where(['id' => $id])->delete('gejala');
        $this->insertLog($this->session->userdata('name'), 'hapus-gejala', $post, 0);
    }

    public function getAllGejala()
    {
        $gejala = $this->db->select('*')->from('gejala')->get();
        return $gejala->result_array();
    }

    public function getGejala($id)
    {
        $gejala = $this->db->select('*')->from('gejala')->where(['id' => $id])->get();
        return $gejala->row_array();
    }

    public function GejalaIFExist($rule_id)
    {
        $gejala = $this->getAllGejala();
        $rule = $this->db->select('*')->from('aturan');
        if($rule_id != null) {
            $sql_rule = $rule->where('id != ', $rule_id)->get();
        } else {
            $sql_rule = $rule->get();
        }
        $rule_array = $sql_rule->result_array();
        $record_gejala = [];
        foreach($gejala as $value) {
            $row = [];
            $found = 0;
            for($i = 0; $i < count($rule_array); $i++) {
                $explode_gejala = explode(',', $rule_array[$i]['child_kode_gejala']);
                if($value['id'] == $rule_array[$i]['parent_kode_gejala']) {
                    $found ++;
                } else if(in_array($value['id'], $explode_gejala)) {
                    $found ++;
                }
            }
            if($found == 0) {
                $row['id'] = $value['id'];
                $row['kode_gejala'] = $value['kode_gejala'];
                $row['nama_gejala'] = $value['nama_gejala'];
                $record_gejala[] = $row;
            }
        }
        return $record_gejala;
    }

    public function getChildGejalaKode($child)
    {
        $explode_gejala = explode(',', $child);
        for ($i = 0; $i < count($explode_gejala); $i++) {
            $kode_gejala = $this->getGejala($explode_gejala[$i]);
            $row[$i] = $kode_gejala['kode_gejala'];
        }
        return implode(",", $row);
    }
}
