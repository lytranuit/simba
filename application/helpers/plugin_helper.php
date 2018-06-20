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



if (!function_exists('load_editor')) {

    function load_editor(&$data) {
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/froala_editor.min.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/froala_style.min.css");
        /////////// Plugin
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/char_counter.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/code_view.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/colors.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/emoticons.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/file.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/fullscreen.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/image.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/image_manager.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/line_breaker.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/quick_insert.css");
        array_push($data['stylesheet_tag'], base_url() . "public/admin/css/plugins/table.css");

        array_push($data['javascript_tag'], base_url() . "public/admin/js/froala_editor.min.js");
        /////////// Plugin
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/align.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/char_counter.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/colors.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/emoticons.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/entities.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/font_size.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/fullscreen.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/image.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/image_manager.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/link.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/lists.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/paragraph_format.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/paragraph_style.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/quick_insert.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/save.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/url.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/plugins/video.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/js/languages/en_gb.js");
    }

}