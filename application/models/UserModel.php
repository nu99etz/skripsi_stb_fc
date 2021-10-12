<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends MainModel
{
    private function Pegawai()
    {
        $pegawai['table'] = 'pegawai';
        $pegawai['column_search'] = [
            'role_id',
            'kode_pegawai',
            'nama_pegawai',
            'alamat_pegawai',
            'nomor_telepon_pegawai'
        ];
        $pegawai['column_order'] = [
            null,
            'role_id',
            'kode_pegawai',
            'nama_pegawai',
            'alamat_pegawai',
            'nomor_telepon_pegawai',
            null
        ];
        $pegawai['order'] = [
            'id' => 'ASC'
        ];
        return $pegawai;
    }

    public function PegawaiDraw()
    {
        $pegawai = $this->Pegawai();
        return $this->getDataTables($pegawai['table'], $pegawai['column_search'], $pegawai['column_order'], $pegawai['order']);
    }

    public function PegawaiTotal()
    {
        $pegawai = $this->Pegawai();
        return $this->getDataTablesCountAll($pegawai['table'], $pegawai['column_search'], $pegawai['column_order'], $pegawai['order']);
    }

    public function PegawaiFilter()
    {
        $pegawai = $this->Pegawai();
        return $this->getDataTablesCountFiltered($pegawai['table'], $pegawai['column_search'], $pegawai['column_order'], $pegawai['order']);
    }

    public function getAllRoles()
    {
        // $this->db->select('*')->from('ms_role')->get();
        $role = $this->db->select('*')->from('ms_role')->get()->result_array();
        return $role;
    }

    public function getRoles($id)
    {
        $role = $this->db->select('*')->from('ms_role')->where(['id_role' => $id])->get()->row_array();
        return $role;
    }

    public function getPegawai($id)
    {
        $pegawai = $this->Pegawai();
        $this->db->select('*')->from($pegawai['table'])->where('id', $id);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function storePegawai()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('role_id', 'Role ID', 'required');
        $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required');
        $this->form_validation->set_rules('nomor_telepon_pegawai', 'No Telp. Pegawai', 'required');

        if ($this->form_validation->run()) {
            $check_pegawai_id = $this->db->select('id')->from('pegawai')->order_by('id', 'DESC')->limit(1)->get()->result_array();

            if ($post['role_id'] == 1) {
                $kode_pegawai = 'AD' . $check_pegawai_id[0]['id'] + 1;
            } else if ($post['role_id'] == 2) {
                $kode_pegawai = 'SA' . $check_pegawai_id[0]['id'] + 1;
            } else if ($post['role_id'] == 3) {
                $kode_pegawai = 'CS' . $check_pegawai_id[0]['id'] + 1;
            } else if ($post['role_id'] == 4) {
                $kode_pegawai = 'TK' . $check_pegawai_id[0]['id'] + 1;
            }

            $data_pegawai = [
                'role_id' => $post['role_id'],
                'kode_pegawai' => $kode_pegawai,
                'nama_pegawai' => ucwords($post['nama_pegawai']),
                'alamat_pegawai' => $post['alamat_pegawai'],
                'nomor_telepon_pegawai' => $post['nomor_telepon_pegawai']
            ];

            $this->db->trans_start();

            $this->db->insert('pegawai', $data_pegawai);

            if ($post['role_id'] != 4) {
                $check_pegawai = $this->db->select('id')->from('pegawai')->where(['kode_pegawai' => $kode_pegawai])->get()->row_array();
                $data_user = [
                    'id_user' => $check_pegawai['id'],
                    'username' => $kode_pegawai,
                    'password' => md5('123'),
                    'is_login' => NULL,
                    'login_date' => NULL,
                    'last_login' => NULL,
                ];

                $this->db->trans_start();

                $this->db->insert('ms_user', $data_user);

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }
            }

            $response = [
                'status' => 'success',
            ];
            $status = 0;
        } else {
            $response = [
                'status' => 'notvalid'
            ];
            $status = 1;
        }

        $this->insertLog($this->session->userdata('name'), 'insert-pegawai', $post, $status);
        return $response;
    }

    public function editPegawai($id)
    {
        $pegawai = $this->db->select('*')->from('pegawai')->where(['id' => $id])->get();
        return $pegawai->row_array();
    }

    public function updatePegawai($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('role_id', 'Role ID', 'required');
        $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required');
        $this->form_validation->set_rules('nomor_telepon_pegawai', 'No Telp. Pegawai', 'required');

        if ($this->form_validation->run()) {
            $check_pegawai_id = $this->db->select('id')->from('pegawai')->where(['id' => $id])->get()->row_array();

            if ($post['role_id'] == 1) {
                $kode_pegawai = 'AD' . $check_pegawai_id['id'];
            } else if ($post['role_id'] == 2) {
                $kode_pegawai = 'SA' . $check_pegawai_id['id'];
            } else if ($post['role_id'] == 3) {
                $kode_pegawai = 'CS' . $check_pegawai_id['id'];
            } else if ($post['role_id'] == 4) {
                $kode_pegawai = 'TK' . $check_pegawai_id['id'];
            }

            $data_pegawai = [
                'role_id' => $post['role_id'],
                'kode_pegawai' => $kode_pegawai,
                'nama_pegawai' => ucwords($post['nama_pegawai']),
                'alamat_pegawai' => $post['alamat_pegawai'],
                'nomor_telepon_pegawai' => $post['nomor_telepon_pegawai']
            ];

            $this->db->trans_start();

            $this->db->where(['id' => $id])->update('pegawai', $data_pegawai);

            $count_user = $this->db->select('*')->from('ms_user')->where(['id' => $id])->count_all_results();

            if ($count_user > 0) {
                if ($post['role_id'] == 4) {
                    $this->db->where(['id' => $id])->delete('ms_user');
                } else if ($post['role_id'] != 4) {
                    $data_user = [
                        'username' => $kode_pegawai,
                    ];

                    $this->db->where(['id_user' => $id])->update('ms_user', $data_user);
                }
            } else {
                if ($post['role_id'] != 4) {
                    $check_pegawai = $this->db->select('id')->from('pegawai')->where(['kode_pegawai' => $kode_pegawai])->get()->row_array();
                    $data_user = [
                        'id_user' => $check_pegawai['id'],
                        'username' => $kode_pegawai,
                        'password' => md5('123'),
                        'is_login' => NULL,
                        'login_date' => NULL,
                        'last_login' => NULL,
                    ];

                    $this->db->insert('ms_user', $data_user);
                }
            }

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
                'status' => 'notvalid'
            ];
            $status = 1;
        }
        $this->insertLog($this->session->userdata('name'), 'update-pegawai', $post, $status);
        return $response;
    }

    public function destroyPegawai($id)
    {
        $count_user = $this->db->select('*')->from('ms_user')->where(['id_user' => $id]);
        if ($count_user->count_all_results() > 0) {
            $user = $this->db->select('*')->from('ms_user')->where(['id_user' => $id])->get()->row_array();
            $this->db->where(['id_user' => $id])->delete('ms_user');
        } else {
            $user = [];
        }
        $count_pegawai = $this->db->select('*')->from('pegawai')->where(['id' => $id]);
        $pegawai = $count_pegawai->get()->row_array();
        $this->db->where(['id' => $id])->delete('pegawai');
        $data_act = [
            'pegawai' => $pegawai,
            'user' => $user
        ];
        $this->insertLog($this->session->userdata('name'), 'hapus-pegawai', $data_act, 0);
    }

    private function User()
    {
        $user['table'] = 'ms_user';
        $user['column_search'] = [
            'id_user',
            'username',
            'is_login',
            'last_login'
        ];
        $user['column_order'] = [
            null,
            'id_user',
            'username',
            'is_login',
            'last_login',
            null
        ];
        $user['order'] = [
            'id' => 'ASC'
        ];
        return $user;
    }

    public function UserDraw()
    {
        $user = $this->User();
        return $this->getDataTables($user['table'], $user['column_search'], $user['column_order'], $user['order']);
    }

    public function UserTotal()
    {
        $user = $this->User();
        return $this->getDataTablesCountAll($user['table'], $user['column_search'], $user['column_order'], $user['order']);
    }

    public function UserFilter()
    {
        $user = $this->User();
        return $this->getDataTablesCountFiltered($user['table'], $user['column_search'], $user['column_order'], $user['order']);
    }

    public function editUser($id)
    {
        $user = $this->db->select('*')->from('ms_user')->where(['id' => $id])->get();
        return $user->row_array();
    }

    public function updateUser($id)
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $user = [
                'password' => md5($post['password'])
            ];
            $this->db->where(['id' => $id])->update('ms_user', $user);
            $response = [
                'status' => 'success',
            ];
            $status = 0;
        } else {
            $user = [];
            $response = [
                'status' => 'notvalid',
            ];
            $status = 1;
        }
        $this->insertLog($this->session->userdata('name'), 'update-user', $user, $status);
        return $response;
    }

    public function destroyUser($id)
    {
        $user = $this->db->select('*')->from('ms_user')->where(['id' => $id])->get()->row_array();
        $this->db->where(['id' => $id])->delete('ms_user');
        $this->insertLog($this->session->userdata('name'), 'update-user', $user, 0);
    }
}
