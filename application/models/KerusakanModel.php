<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KerusakanModel extends MainModel
{
    private function Kerusakan()
    {
        $kerusakan['table'] = 'kerusakan';
        $kerusakan['column_search'] = [
            'kode_kerusakan',
            'nama_kerusakan'
        ];
        $kerusakan['column_order'] = [
            null,
            'kode_kerusakan',
            'nama_kerusakan',
            null
        ];
        $kerusakan['order'] = [
            'id' => 'ASC'
        ];
        return $kerusakan;
    }

    public function KerusakanDraw()
    {
        $kerusakan = $this->Kerusakan();
        return $this->getDataTables($kerusakan['table'], $kerusakan['column_search'], $kerusakan['column_order'], $kerusakan['order']);
    }

    public function KerusakanTotal()
    {
        $kerusakan = $this->Kerusakan();
        return $this->getDataTablesCountAll($kerusakan['table'], $kerusakan['column_search'], $kerusakan['column_order'], $kerusakan['order']);
    }

    public function KerusakanFilter()
    {
        $kerusakan = $this->Kerusakan();
        return $this->getDataTablesCountFiltered($kerusakan['table'], $kerusakan['column_search'], $kerusakan['column_order'], $kerusakan['order']);
    }

    public function storeKerusakan()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('kode_kerusakan', 'Kode Kerusakan', 'required');
        $this->form_validation->set_rules('nama_kerusakan', 'Nama Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $check_kerusakan_id = $this->db->select('kode_kerusakan')->from('kerusakan')->where(['kode_kerusakan' => strtoupper($post['kode_kerusakan'])]);

            if ($check_kerusakan_id->count_all_results() > 0) {
                $response = [
                    'status' => 'notvalid',
                    'messages' => 'Kode Kerusakan Sudah Digunakan'
                ];
                $status = 1;
            } else {
                $data_kerusakan = [
                    'kode_kerusakan' => strtoupper($post['kode_kerusakan']),
                    'nama_kerusakan' => ucwords($post['nama_kerusakan']),
                ];

                $this->db->trans_start();

                $this->db->insert('kerusakan', $data_kerusakan);

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
        $this->insertLog($this->session->userdata('name'), 'insert-kerusakan', $post, $status);
        return $response;
    }

    public function editKerusakan($id)
    {
        $kerusakan = $this->db->select('*')->from('kerusakan')->where(['id' => $id])->get();
        return $kerusakan->row_array();
    }

    public function updateKerusakan($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('nama_kerusakan', 'Nama Kerusakan', 'required');

        if ($this->form_validation->run()) {

            $data_kerusakan = [
                'nama_kerusakan' => ucwords($post['nama_kerusakan']),
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $id])->update('kerusakan', $data_kerusakan);

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
        $this->insertLog($this->session->userdata('name'), 'update-kerusakan', $post, $status);
        return $response;
    }

    public function destroyKerusakan($id)
    {
        // Hapus Foreign Key Dari tabel aturan
        $aturan = $this->db->select('*')->from('aturan')->where(['kode_kerusakan' => $id]);

        if($aturan->count_all_results() > 0) {
            $aturan_record = $this->db->select('*')->from('aturan')->where(['kode_kerusakan' => $id])->get()->result_array();
            $this->db->where(['kode_kerusakan' => $id])->delete('aturan');
        } else {
            $aturan_record = [];
        }

        // Hapus Foreign Key Dari tabel penyebab_kerusakan
        $penyebab_kerusakan = $this->db->select('*')->from('penyebab_kerusakan')->where(['kode_kerusakan' => $id]);

        if($penyebab_kerusakan->count_all_results() > 0) {
            $penyebab_kerusakan_record = $this->db->select('*')->from('penyebab_kerusakan')->where(['kode_kerusakan' => $id])->get()->result_array();
            $this->db->where(['kode_kerusakan' => $id])->delete('penyebab_kerusakan');
        } else {
            $penyebab_kerusakan_record = [];
        }

        // Hapus Foreign Key Dari tabel solusi_kerusakan
        $solusi_kerusakan = $this->db->select('*')->from('solusi_kerusakan')->where(['kode_kerusakan' => $id]);

        if($solusi_kerusakan->count_all_results() > 0) {
            $solusi_kerusakan_record = $this->db->select('*')->from('solusi_kerusakan')->where(['kode_kerusakan' => $id])->get()->result_array();
            $this->db->where(['kode_kerusakan' => $id])->delete('solusi_kerusakan');
        } else {
            $solusi_kerusakan_record = [];
        }

        $kerusakan = $this->db->select('*')->from('kerusakan')->where(['id' => $id])->get()->result_array();

        $post = [
            'aturan_record' => $aturan_record,
            'penyebab_kerusakan_record' => $penyebab_kerusakan_record,
            'solusi_kerusakan_record' => $solusi_kerusakan_record,
            'kerusakan_record' => $kerusakan
        ];

        $this->db->where(['id' => $id])->delete('kerusakan');
        $this->insertLog($this->session->userdata('name'), 'hapus-kerusakan', $post, 0);
    }

    public function getAllKerusakan()
    {
        $kerusakan = $this->db->select('*')->from('kerusakan')->get();
        return $kerusakan->result_array();
    }

    public function getKerusakan($id)
    {
        $kerusakan = $this->db->select('*')->from('kerusakan')->where(['id' => $id])->get();
        return $kerusakan->row_array();
    }

    public function getLatestKerusakan($table)
    {
        $query = "select*from kerusakan where id not in (select kode_kerusakan from ".$table.")";
        // $kerusakan = $this->db->select('*')->from('kerusakan')->where_not_in('id', "(select kode_kerusakan from ".$table.")")->get();
        $kerusakan = $this->db->query($query);
        return $kerusakan->result_array();
    }
}
