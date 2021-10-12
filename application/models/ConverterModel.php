<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConverterModel extends MainModel
{
    public function getWeight($id_attribute, $value)
    {
        switch ($id_attribute) {
            case 1:
                if ($value < 20 || $value > 35) {
                    $weight = 0;
                } else {
                    $weight = 1;
                }
                break;
            case 2:
                if ($value < 37 || $value > 42) {
                    $weight = 0;
                } else {
                    $weight = 1;
                }
                break;
            case 3:
                if ($value <= 145) {
                    $weight = 0;
                } else if ($value > 145) {
                    $weight = 1;
                }
                break;
            case 4:
                if ($value == "ada") {
                    $weight = 0;
                } else if ($value == "tidak ada") {
                    $weight = 1;
                }
                break;
            case 5:
                if ($value == "ya") {
                    $weight = 0;
                } else if ($value == "tidak") {
                    $weight = 1;
                }
                break;
            case 6:
                if ($value == "multipara") {
                    $weight = 1;
                } else if ($value == "primipara") {
                    $weight = 1;
                } else if ($value == "grandemultipara") {
                    $weight = 0;
                }
                break;
            case 7:
                if ($value == "rendah") {
                    $weight = 0;
                } else if ($value == "normal") {
                    $weight = 1;
                } else if ($value == "tinggi") {
                    $weight = 0;
                }
                break;
            case 8:
                if ($value == "ya") {
                    $weight = 0;
                } else if ($value == "tidak") {
                    $weight = 1;
                }
                break;
            case 9:
                if ($value == "ya") {
                    $weight = 0;
                } else if ($value == "tidak") {
                    $weight = 1;
                }
                break;
            case 10:
                if ($value == "ya") {
                    $weight = 0;
                } else if ($value == "tidak") {
                    $weight = 1;
                }
                break;
            case 11:
                if ($value == "tidak ada") {
                    $weight = 1;
                } else if ($value == "rendah") {
                    $weight = 0.5;
                } else if ($value == "berat") {
                    $weight = 0;
                }
                break;
            case 12:
                if ($value == "ya") {
                    $weight = 0;
                } else if ($value == "tidak") {
                    $weight = 1;
                }
                break;
            case 13:
                if ($value < 2) {
                    $weight = 0;
                } else if ($value >= 2) {
                    $weight = 1;
                }
                break;
            case 14:
                if ($value == "normal") {
                    $weight = 1;
                } else if ($value == "lemah") {
                    $weight = 0;
                }
                break;
            case 15:
                if($value == "SC") {
                    $weight = 0;
                } else if($value == "Normal") {
                    $weight = 1;
                }
                break;   
            default:
                $weight = "Tidak Ada Dalam List";
        }
        return $weight;
    }

    public function getNumberConvert($id_attribute, $value)
    {
        switch ($id_attribute) {
            case 1:
                if ($value < 20 || $value > 35) {
                    $weight = "berisiko";
                } else {
                    $weight = "tidak berisiko";
                }
                break;
            case 2:
                if ($value < 37) {
                    $weight = "preterm";
                } else if($value > 42) {
                    $weight = "postterm";
                } else {
                    $weight = "aterm";
                }
                break;   
            case 3:
                if ($value <= 145) {
                    $weight = "<=145 Cm";
                } else if ($value > 145) {
                    $weight = "> 145 Cm";
                }
                break;
            case 13:
                if ($value < 2) {
                    $weight = "< 2 Tahun";
                } else if ($value >= 2) {
                    $weight = ">= 2 Tahun";
                }
                break;
            default:
                $weight = "Tidak Ada Dalam List";       
        }

        return $weight;
    }
}