<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ForwardChainingModel extends MainModel
{
    public function Perbaikan()
    {
        $sql = "select a.*, b.nama_pegawai as nama_teknisi, x.nama_pegawai as nama_cs from perbaikan a left join pegawai b on a.id_teknisi = b.id left join pegawai x on a.id_customer_service = x.id";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function storePerbaikan($kerusakan = [], $gejala = [])
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('nama_teknisi', 'Nama Teknisi', 'required');

        if ($this->form_validation->run()) {

            $data_perbaikan = [
                'nama_customer' => ucwords($post['nama_customer']),
                'alamat_customer' => $post['alamat_customer'],
                'id_teknisi' => $post['nama_teknisi'],
                'tanggal_konsultasi' => date('Y-m-d'),
                'tanggal_mulai_perbaikan' => NULL,
                'tanggal_selesai_perbaikan' => NULL,
                'id_customer_service' => $this->session->userdata('id_pegawai'),
                'status_perbaikan' => 0
            ];

            $this->db->trans_start();

            $this->db->insert('perbaikan', $data_perbaikan);

            if ($this->db->trans_status() === false) {

                $this->db->trans_rollback();

                throw new Exception('Data Perbaikan Gagal Di Input');

            } else {

                $this->db->trans_commit();

                $check_perbaikan_id = $this->db->select('id')->from('perbaikan')->order_by('id', 'DESC')->limit(1)->get()->result_array();

                $id = $check_perbaikan_id[0]['id'];

                $record = [];

                foreach ($kerusakan as $value) {
                    $row = [];
                    $row['id_perbaikan'] = $id;
                    $row['id_kerusakan'] = $value;
                    $record[] = $row;
                }

                $this->db->trans_start();

                $this->db->insert_batch('proses_perbaikan', $record);

                if ($this->db->trans_status() === false) {
                    
                    $this->db->trans_rollback();

                    throw new Exception('Data Proses Perbaikan Gagal Di Input');

                } else {
                    $this->db->trans_commit();

                    $record_gejala = [];

                    foreach ($gejala as $value) {
                        $row_gejala = [];
                        $row_gejala['id_perbaikan'] = $id;
                        $row_gejala['id_gejala'] = $value;
                        $record_gejala[] = $row_gejala;
                    }

                    $this->db->trans_start();

                    $this->db->insert_batch('gejala_perbaikan', $record_gejala);

                    if ($this->db->trans_status() === false) {

                        $this->db->trans_rollback();

                        throw new Exception('Data Proses Gejala Gagal Di Input');

                    } else {

                        $this->db->trans_commit();

                    }
                }
            }

            $response = [
                'status' => 'success'
            ];

            $status = 0;

        } else {

            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
            ];

            $status = 1;
        }

        $log_data = [
            'perbaikan' => $post,
            'kerusakan' => $kerusakan
        ];

        $this->insertLog($this->session->userdata('name'), 'insert-perbaikan', $log_data, $status);
        return $response;
    }

    public function getRule($where = [], $option = null)
    {
        $rule = $this->db->select('*')->from('aturan')->where($where)->get();
        if ($option == 'gejala') {
            return $rule->row_array();
        } else if ($option == 'kerusakan') {
            return $rule->result_array();
        }
    }

    public function detailPerbaikan($id)
    {
        $perbaikan = $this->db->select('*')->from('perbaikan')->where(['id' => $id])->get()->row_array();
        $sql_proses_perbaikan = "select a.*, b.nama_kerusakan, c.penyebab_kerusakan, d.solusi_kerusakan from proses_perbaikan a left join kerusakan b on a.id_kerusakan = b.id left join penyebab_kerusakan c on a.id_kerusakan = c.kode_kerusakan left join solusi_kerusakan d on a.id_kerusakan = d.kode_kerusakan where a.id_perbaikan = ".$id;
        $query_proses_perbaikan = $this->db->query($sql_proses_perbaikan)->result_array();
        $gejala_perbaikan = $this->db->select('*')->from('gejala_perbaikan')->join('gejala', 'gejala_perbaikan.id_gejala = gejala.id', 'left')->where(['id_perbaikan' => $id])->get()->result_array();
        $teknisi = $this->db->select('*')->from('pegawai')->where(['id' => $perbaikan['id_teknisi']])->get()->row_array();
        $cs = $this->db->select('*')->from('pegawai')->where(['id' => $perbaikan['id_customer_service']])->get()->row_array();

        $detail_perbaikan = [
            'perbaikan' => $perbaikan,
            'customer_service' => [
                'kode_pegawai' => $cs['kode_pegawai'],
                'nama_cs' => $cs['nama_pegawai']
            ],
            'teknisi' => [
                'kode_pegawai' => $teknisi['kode_pegawai'],
                'nama_teknisi' => $teknisi['nama_pegawai']
            ],
            'gejala_kerusakan' => $gejala_perbaikan,
            'proses_perbaikan' => $query_proses_perbaikan
        ];

        return $detail_perbaikan;
    }
}
