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
        $aturan = $this->db->select('*')->from('aturan')->where(['kode_gejala' => $id]);
        if ($aturan->count_all_results() > 0) {
            $aturan_record = $this->db->select('*')->from('aturan')->where(['kode_gejala' => $id])->get()->result_array();
            $this->db->where(['kode_gejala' => $id])->delete('aturan');
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
}
