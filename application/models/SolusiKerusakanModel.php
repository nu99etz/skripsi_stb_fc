<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SolusiKerusakanModel extends MainModel
{
    private function SolusiKerusakan()
    {
        $solusi['table'] = 'solusi_kerusakan';
        $solusi['column_search'] = [
            'kode_kerusakan',
            'solusi_kerusakan'
        ];
        $solusi['column_order'] = [
            null,
            'kode_kerusakan',
            'solusi_kerusakan',
            null
        ];
        $solusi['order'] = [
            'id' => 'ASC'
        ];
        return $solusi;
    }

    public function SolusiKerusakanDraw()
    {
        $solusi = $this->SolusiKerusakan();
        return $this->getDataTables($solusi['table'], $solusi['column_search'], $solusi['column_order'], $solusi['order']);
    }

    public function SolusiKerusakanTotal()
    {
        $solusi = $this->SolusiKerusakan();
        return $this->getDataTablesCountAll($solusi['table'], $solusi['column_search'], $solusi['column_order'], $solusi['order']);
    }

    public function SolusiKerusakanFilter()
    {
        $solusi = $this->SolusiKerusakan();
        return $this->getDataTablesCountFiltered($solusi['table'], $solusi['column_search'], $solusi['column_order'], $solusi['order']);
    }

    public function storeSolusiKerusakan()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');
        $this->form_validation->set_rules('solusi_kerusakan', 'Solusi Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $data_solusi_kerusakan = [
                'kode_kerusakan' => $post['kode_kerusakan'],
                'solusi_kerusakan' => $post['solusi_kerusakan'],
            ];

            $this->db->trans_start();

            $this->db->insert('solusi_kerusakan', $data_solusi_kerusakan);

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
        $this->insertLog($this->session->userdata('name'), 'insert-solusi-kerusakan', $post, $status);
        return $response;
    }

    public function editSolusiKerusakan($id)
    {
        $solusi = $this->db->select('*')->from('solusi_kerusakan')->where(['id' => $id])->get();
        return $solusi->row_array();
    }

    public function updateSolusiKerusakan($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');
        $this->form_validation->set_rules('solusi_kerusakan', 'Solusi Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $data_solusi_kerusakan = [
                'kode_kerusakan' => $post['kode_kerusakan'],
                'solusi_kerusakan' => $post['solusi_kerusakan'],
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $id])->update('solusi_kerusakan', $data_solusi_kerusakan);

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
        $this->insertLog($this->session->userdata('name'), 'update-solusi-kerusakan', $post, $status);
        return $response;
    }

    public function destroySolusiKerusakan($id)
    {
        $solusi_kerusakan = $this->db->select('*')->from('solusi_kerusakan')->where(['id' => $id])->get()->result_array();

        $post = [
            'solusi_kerusakan' => $solusi_kerusakan
        ];

        $this->db->where(['id' => $id])->delete('solusi_kerusakan');
        $this->insertLog($this->session->userdata('name'), 'hapus-solusi-kerusakan', $post, 0);
    }

    public function getSolusiKerusakan($id)
    {
        $solusi = $this->db->select('*')->from('solusi_kerusakan')->where(['kode_kerusakan' => $id])->get();
        return $solusi->row_array();
    }
}
