<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('load_inputfile')) {

    function load_inputfile(&$data) {
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/fileinput.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/theme_fileinput.css");

        array_push($data['javascript_tag'], base_url() . "public/admin/js/fileinput.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/sortable.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/theme_fileinput.js");
    }

}


if (!function_exists('load_datatable')) {

    function load_datatable(&$data) {
        array_push($data['stylesheet_tag'], base_url() . "public/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css");

        array_push($data['javascript_tag'], base_url() . "public/admin/plugins/jquery-datatable/jquery.dataTables.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js");
    }

}