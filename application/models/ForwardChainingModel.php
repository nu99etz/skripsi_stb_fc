<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ForwardChainingModel extends MainModel
{
    public function getRule($where = [])
    {
        $rule = $this->db->select('*')->from('aturan')->where($where)->get();
        return $rule->result_array();
    }

}