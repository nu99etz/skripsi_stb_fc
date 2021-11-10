<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ForwardChainingModel extends MainModel
{
    public function Konsultasi()
    {
        $sql = "select a.*, b.nama_pegawai as nama_cs from konsultasi a left join pegawai b on a.id_customer_service = b.id";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function storeKonsultasi($kerusakan = [], $gejala = [])
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('no_telepon_customer', 'No Telepon Customer', 'required');

        if ($this->form_validation->run()) {

            $data_konsultasi = [
                'id_customer_service' => $this->session->userdata('id_pegawai'),
                'nama_customer' => ucwords($post['nama_customer']),
                'alamat_customer' => $post['alamat_customer'],
                'no_telepon_customer' => $post['no_telepon_customer'],
                'tanggal_konsultasi' => date('Y-m-d'),
            ];

            $this->db->trans_start();

            $this->db->insert('konsultasi', $data_konsultasi);

            if ($this->db->trans_status() === false) {

                $this->db->trans_rollback();

                throw new Exception('Data Perbaikan Gagal Di Input');
            } else {

                $this->db->trans_commit();

                $check_konsultasi_id = $this->db->select('id')->from('konsultasi')->order_by('id', 'DESC')->limit(1)->get()->result_array();

                $id = $check_konsultasi_id[0]['id'];

                $record = [];

                foreach ($kerusakan as $value) {
                    $row = [];
                    $row['id_konsultasi'] = $id;
                    $row['id_kerusakan'] = $value;
                    $record[] = $row;
                }

                $this->db->trans_start();

                $this->db->insert_batch('konsultasi_kerusakan', $record);

                if ($this->db->trans_status() === false) {

                    $this->db->trans_rollback();

                    throw new Exception('Data Konsultasi Kerusakan Gagal Di Input');
                } else {
                    $this->db->trans_commit();

                    $record_gejala = [];

                    foreach ($gejala as $value) {
                        $row_gejala = [];
                        $row_gejala['id_konsultasi'] = $id;
                        $row_gejala['id_gejala'] = $value;
                        $record_gejala[] = $row_gejala;
                    }

                    $this->db->trans_start();

                    $this->db->insert_batch('gejala_konsultasi', $record_gejala);

                    if ($this->db->trans_status() === false) {

                        $this->db->trans_rollback();

                        throw new Exception('Data Konsultasi Gejala Gagal Di Input');
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
            'konsultasi' => $post,
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

    public function detailKonsultasi($id)
    {
        $konsultasi = $this->db->select('*')->from('konsultasi')->where(['id' => $id])->get()->row_array();
        $sql_proses_konsultasi = "select a.*, b.nama_kerusakan, c.penyebab_kerusakan, d.solusi_kerusakan from konsultasi_kerusakan a left join kerusakan b on a.id_kerusakan = b.id left join penyebab_kerusakan c on a.id_kerusakan = c.kode_kerusakan left join solusi_kerusakan d on a.id_kerusakan = d.kode_kerusakan where a.id_konsultasi = " . $id;
        $query_proses_konsultasi = $this->db->query($sql_proses_konsultasi)->result_array();
        $gejala_perbaikan = $this->db->select('*')->from('gejala_konsultasi')->join('gejala', 'gejala_konsultasi.id_gejala = gejala.id', 'left')->where(['id_konsultasi' => $id])->get()->result_array();
        $cs = $this->db->select('*')->from('pegawai')->where(['id' => $konsultasi['id_customer_service']])->get()->row_array();

        $detail_perbaikan = [
            'konsultasi' => $konsultasi,
            'customer_service' => [
                'kode_pegawai' => $cs['kode_pegawai'],
                'nama_cs' => $cs['nama_pegawai']
            ],
            'gejala_kerusakan' => $gejala_perbaikan,
            'konsultasi_perbaikan' => $query_proses_konsultasi
        ];

        return $detail_perbaikan;
    }

    public function rootQuestion($id = null)
    {
        if (empty($id)) {
            $root = $this->db->select('*')->from('gejala')->limit(3)->order_by('id', 'asc')->get();
            return [
                'gejala' => $root->result_array(),
                'kerusakan' => []
            ];
        } else {

            // Insert Konsul Gejala Ke Tabel Konsultasi Gejala

            $id_cs = $this->session->userdata('id_pegawai');

            $gjl_ins = [
                'id_customer_service' => $id_cs,
                'id_gejala' => $id
            ];

            // $this->db->insert('konsultasi_gejala', $gjl_ins);

            $sql_rule = $this->db->select('*')->from('rule_breadth')->where(['parent_kode_gejala' => $id])->group_by('child_kode_gejala')->get();

            $count_gjl = $sql_rule->num_rows();

            $gejala_ = [];
            $kerusakan = [];

            if ($count_gjl > 0) {

                foreach ($sql_rule->result_array() as $key => $value) {
                    $row = [];
                    $gejala = $this->db->select('*')->from('gejala')->where(['id' => $value['child_kode_gejala']])->get()->row_array();

                    $row['id'] = $gejala['id'];
                    $row['kode_gejala'] = $gejala['kode_gejala'];
                    $row['nama_gejala'] = $gejala['nama_gejala'];

                    $gejala_[] = $row;
                }
                
            } else {

                $sql_rule = $this->db->select('*')->from('rule_breadth')->where(['child_kode_gejala' => $id])->get();

                foreach($sql_rule->result_array() as $key => $value) {
                    $row = [];

                    $kerusakan_ = $this->db->select('*')->from('kerusakan')->where(['id' => $value['kode_kerusakan']])->get()->row_array();

                    $row['id'] = $kerusakan_['id'];
                    $row['kode_kerusakan'] = $kerusakan_['kode_kerusakan'];
                    $row['nama_kerusakan'] = $kerusakan_['nama_kerusakan'];

                    $kerusakan[] = $row;
                }

            }

            return [
                'gejala' => $gejala_,
                'kerusakan' => $kerusakan,
            ];
        }
    }
}
