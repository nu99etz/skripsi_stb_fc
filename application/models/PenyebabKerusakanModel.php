<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PenyebabKerusakanModel extends MainModel
{
    private function PenyebabKerusakan()
    {
        $kerusakan['table'] = 'penyebab_kerusakan';
        $kerusakan['column_search'] = [
            'kode_kerusakan',
            'penyebab_kerusakan'
        ];
        $kerusakan['column_order'] = [
            null,
            'kode_kerusakan',
            'penyebab_kerusakan',
            null
        ];
        $kerusakan['order'] = [
            'id' => 'ASC'
        ];
        return $kerusakan;
    }

    public function PenyebabKerusakanDraw()
    {
        $kerusakan = $this->PenyebabKerusakan();
        return $this->getDataTables($kerusakan['table'], $kerusakan['column_search'], $kerusakan['column_order'], $kerusakan['order']);
    }

    public function PenyebabKerusakanTotal()
    {
        $kerusakan = $this->PenyebabKerusakan();
        return $this->getDataTablesCountAll($kerusakan['table'], $kerusakan['column_search'], $kerusakan['column_order'], $kerusakan['order']);
    }

    public function PenyebabKerusakanFilter()
    {
        $kerusakan = $this->PenyebabKerusakan();
        return $this->getDataTablesCountFiltered($kerusakan['table'], $kerusakan['column_search'], $kerusakan['column_order'], $kerusakan['order']);
    }

    public function storePenyebabKerusakan()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');
        $this->form_validation->set_rules('penyebab_kerusakan', 'Penyebab Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $data_penyebab_kerusakan = [
                'kode_kerusakan' => $post['kode_kerusakan'],
                'penyebab_kerusakan' => $post['penyebab_kerusakan'],
            ];

            $this->db->trans_start();

            $this->db->insert('penyebab_kerusakan', $data_penyebab_kerusakan);

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
        $this->insertLog($this->session->userdata('name'), 'insert-penyebab-kerusakan', $post, $status);
        return $response;
    }

    public function editPenyebabKerusakan($id)
    {
        $kerusakan = $this->db->select('*')->from('penyebab_kerusakan')->where(['id' => $id])->get();
        return $kerusakan->row_array();
    }

    public function updatePenyebabKerusakan($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');
        $this->form_validation->set_rules('penyebab_kerusakan', 'Penyebab Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $data_penyebab_kerusakan = [
                'kode_kerusakan' => $post['kode_kerusakan'],
                'penyebab_kerusakan' => $post['penyebab_kerusakan'],
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $id])->update('penyebab_kerusakan', $data_penyebab_kerusakan);

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
        $this->insertLog($this->session->userdata('name'), 'update-penyebab-kerusakan', $post, $status);
        return $response;
    }

    public function destroyPenyebabKerusakan($id)
    {
        $penyebab_kerusakan = $this->db->select('*')->from('penyebab_kerusakan')->where(['id' => $id])->get()->result_array();

        $post = [
            'penyebab_kerusakan' => $penyebab_kerusakan
        ];

        $this->db->where(['id' => $id])->delete('penyebab_kerusakan');
        $this->insertLog($this->session->userdata('name'), 'hapus-penyebab-kerusakan', $post, 0);
    }

    public function getPenyebabKerusakan($id)
    {
        $penyebab = $this->db->select('*')->from('penyebab_kerusakan')->where(['kode_kerusakan' => $id])->get();
        return $penyebab->row_array();
    }
}
