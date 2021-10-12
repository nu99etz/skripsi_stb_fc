<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{

    public function insertLog($username, $action, $data, $status)
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = array(
            'username' => $username,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'activity_log' => $action,
            'activity_date' => date("D M j G:i:s T Y"),
            'parameters' => json_encode($data),
            'is_success' => $status,
        );
        $this->db->trans_begin();
        $insert = $this->db->insert('activity_log', $data);
        if (!$insert) {
            $this->db->trans_rollback();
        } else if ($insert) {
            $this->db->trans_commit();
        }
    }


    private function getDataTablesQuery($table, $search_column, $order_column, $order, $where = null)
    {
        $this->db->from($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $i = 0;
        foreach ($search_column as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($search_column) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getDataTables($table, $search_column, $order_column, $order, $where = null)
    {
        $this->getDataTablesQuery($table, $search_column, $order_column, $order, $where);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getDataTablesCountFiltered($table, $search_column, $order_column, $order, $where = null)
    {
        $this->getDataTablesQuery($table, $search_column, $order_column, $order);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function getDataTablesCountAll($table, $search_column, $order_column, $order, $where = null)
    {
        $this->db->from($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all_results();
    }
}
