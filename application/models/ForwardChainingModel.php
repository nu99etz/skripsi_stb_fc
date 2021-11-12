<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ForwardChainingModel extends MainModel
{
    public function Perbaikan()
    {
        $id_cs = $this->session->userdata('id_pegawai');
        $sql = "select a.*, b.nama_pegawai as nama_cs, c.nama_pegawai as nama_teknisi from perbaikan a left join pegawai b on a.id_customer_service = b.id left join pegawai c on a.id_teknisi = c.id";
        if($id_cs > 1) {
            $sql .= " where a.id_customer_service = ".$id_cs;
        }
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

    public function detailPerbaikan($id)
    {
        $perbaikan = $this->db->select('*')->from('perbaikan')->where(['id' => $id])->get()->row_array();
        $sql_kerusakan = "select a.*, b.penyebab_kerusakan, c.solusi_kerusakan from kerusakan a left join penyebab_kerusakan b on a.id = b.kode_kerusakan left join solusi_kerusakan c on a.id = c.kode_kerusakan where a.id = ".$perbaikan['id_kerusakan'];
        $kerusakan = $this->db->query($sql_kerusakan)->result_array();
        $gejala_perbaikan = $this->db->select('*')->from('perbaikan_gejala')->where(['id_perbaikan' => $perbaikan['id']])->get()->result_array();
        foreach($gejala_perbaikan as $key => $value) {
            $gejala_query = $this->db->select('*')->from('gejala')->where(['id' => $value['id_gejala']])->get()->row_array();
            $gejala[] = $gejala_query['nama_gejala'];
        }
        $cs = $this->db->select('*')->from('pegawai')->where(['id' => $perbaikan['id_customer_service']])->get()->row_array();
        $teknisi = $this->db->select('*')->from('pegawai')->where(['id' => $perbaikan['id_teknisi']])->get()->row_array();

        $detail_perbaikan = [
            'perbaikan' => $perbaikan,
            'pegawai' => [
                'cs' => $cs,
                'teknisi' => $teknisi
            ],
            'gejala' => $gejala,
            'kerusakan' => $kerusakan
        ];

        return $detail_perbaikan;
    }

    /**
     * Fungsi Untuk Menampilkan Pertanyaan Dan Jawaban Berdasarkan Forward Chainning
     * @param int $id
     * @return array
     */

    public function rootQuestion($id = null)
    {
        // Cek Jika Ada Id Yang Di Parsing
        if (empty($id)) {
            $root = $this->db->select('*')->from('gejala')->limit(3)->order_by('id', 'asc')->get();
            return [
                'gejala' => $root->result_array(),
                'kerusakan' => []
            ];
        } else {

            // Insert Gejala Dan Id CS Ke Temp Konsultasi
            $id_cs = $this->session->userdata('id_pegawai');

            $gjl_ins = [
                'id_customer_service' => $id_cs,
                'id_gejala' => $id
            ];

            $this->db->insert('konsultasi_tmp', $gjl_ins);


            // Cek Parent Kode apakah ada id yang berkaitan
            $sql_rule = $this->db->select('*')->from('rule_breadth')->where(['parent_kode_gejala' => $id])->group_by('child_kode_gejala')->get();

            $count_gjl = $sql_rule->num_rows();

            $gejala_ = [];
            $kerusakan = [];

            // Jika Gejala Lebih Dari 0 Tampilkan Pertanyaan Lagi
            if ($count_gjl > 0) {

                // Ambil Pertanyaan Dengan Kriteria dari Child Kode Gejala
                foreach ($sql_rule->result_array() as $key => $value) {
                    $row = [];
                    $gejala = $this->db->select('*')->from('gejala')->where(['id' => $value['child_kode_gejala']])->get()->row_array();

                    $row['id'] = $gejala['id'];
                    $row['kode_gejala'] = $gejala['kode_gejala'];
                    $row['nama_gejala'] = $gejala['nama_gejala'];

                    $gejala_[] = $row;
                }

                $sql_rule = $this->db->select('*')->from('rule_breadth')->where(['parent_kode_gejala' => $id])->or_where(['child_kode_gejala' => $id])->get();

                foreach ($sql_rule->result_array() as $key => $value) {
                    $row = [];

                    if ($value['parent_kode_gejala'] > 4) {
                        $kerusakan_ = $this->db->select('*')->from('kerusakan')->where(['id' => $value['kode_kerusakan']])->get()->row_array();

                        if (!empty($kerusakan_)) {
                            $row['id'] = $kerusakan_['id'];
                            $row['kode_kerusakan'] = $kerusakan_['kode_kerusakan'];
                            $row['nama_kerusakan'] = $kerusakan_['nama_kerusakan'];

                            $kerusakan[] = $row;
                        }
                    }
                }
            } else {

                $sql_rule = $this->db->select('*')->from('rule_breadth')->where(['parent_kode_gejala' => $id])->or_where(['child_kode_gejala' => $id])->get();

                foreach ($sql_rule->result_array() as $key => $value) {
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

    public function getDeleteKonsul()
    {
        $id_cs = $this->session->userdata('id_pegawai');
        $this->db->where(['id_customer_service' => $id_cs])->delete('konsultasi_tmp');
    }

    public function storePerbaikan()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('no_telepon_customer', 'Nomor Telepon Customer', 'required');
        $this->form_validation->set_rules('id_teknisi', 'Nama Teknisi', 'required');

        $id_cs = $this->session->userdata('id_pegawai');

        if ($this->form_validation->run()) {

            $data_perbaikan = [
                'id_customer_service' => $id_cs,
                'id_kerusakan' => $post['id_kerusakan'],
                'id_teknisi' => $post['id_teknisi'],
                'nama_customer' => $post['nama_customer'],
                'alamat_customer' => $post['alamat_customer'],
                'no_telepon_customer' => $post['no_telepon_customer'],
                'tanggal_konsultasi' => date('Y-m-d'),
                'tanggal_mulai_perbaikan' => date('Y-m-d'),
                'tanggal_selesai_perbaikan' => NULL,
                'status_perbaikan' => 0
            ];

            $this->db->trans_start();

            $this->db->insert('perbaikan', $data_perbaikan);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {

                $this->db->trans_commit();

                $perbaikan = $this->db->select('id')->from('perbaikan')->where(['id_customer_service' => $id_cs])->order_by('id', 'DESC')->limit(1)->get()->row_array();

                $konsul_tmp = $this->db->select('*')->from('konsultasi_tmp')->where(['id_customer_service' => $id_cs])->get();
    
                $record_gjl_per = [];
    
                foreach($konsul_tmp->result_array() as $key => $value) {
                    $row = [];
                    $row['id_perbaikan'] = $perbaikan['id'];
                    $row['id_gejala'] = $value['id_gejala'];
                    $record_gjl_per[] = $row; 
                }
    
                $this->db->trans_start();
    
                $this->db->insert_batch('perbaikan_gejala', $record_gjl_per);
    
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();

                    $this->getDeleteKonsul();

                    $response = [
                        'status' => 'success',
                    ];
                    $status = 0;
                }
            }
        } else {

            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
            ];
            $status = 1;
        }
        $this->insertLog($this->session->userdata('name'), 'insert-perbaikan', $post, $status);
        return $response;
    }

    public function selesaiPerbaikan($id)
    {
        $data_perbaikan = [
            'tanggal_selesai_perbaikan' => date('Y-m-d'),
            'status_perbaikan' => 1
        ];

        $this->db->where(['id' => $id])->update('perbaikan', $data_perbaikan);

        $response = [
            'status' => 'success',
        ];
        $status = 0;
        $this->insertLog($this->session->userdata('name'), 'update-perbaikan', $data_perbaikan, $status);
        return $response;
    }
}
