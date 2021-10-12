<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LogActivityModel extends MainModel
{
    private function LogActivity()
    {
        $log['table'] = 'activity_log';
        $log['column_search'] = [
            'username',
            'ip_address',
            'activity_log',
            'activity_date',
            'parameters',
            'is_success'
        ];
        $log['column_order'] = [
            null,
            'username',
            'ip_address',
            'activity_log',
            'activity_date',
            'parameters',
            'is_success'
        ];
        $log['order'] = [
            'id' => 'DESC'
        ];
        return $log;
    }

    public function LogActivityDraw()
    {
        $log = $this->LogActivity();
        return $this->getDataTables($log['table'], $log['column_search'], $log['column_order'], $log['order']);
    }

    public function LogActivityTotal()
    {
        $log = $this->LogActivity();
        return $this->getDataTablesCountAll($log['table'], $log['column_search'], $log['column_order'], $log['order']);
    }

    public function LogActivityFilter()
    {
        $log = $this->LogActivity();
        return $this->getDataTablesCountFiltered($log['table'], $log['column_search'], $log['column_order'], $log['order']);
    }
}