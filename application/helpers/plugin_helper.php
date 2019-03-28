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
        array_push($data['javascript_tag'], base_url() . "public/admin/plugins/jquery-datatable/jquery.highlight.js");
    }

}



if (!function_exists('load_editor')) {

    function load_editor(&$data) {
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/froala_editor.min.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/froala_style.min.css");
        /////////// Plugin
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/char_counter.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/code_view.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/colors.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/file.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/fullscreen.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/image.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/image_manager.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/line_breaker.css");
//        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/quick_insert.css");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/table.css");

        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/froala_editor.min.js");
        /////////// Plugin
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/align.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/char_counter.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/colors.min.js");
        array_push($data['stylesheet_tag'], base_url() . "public/lib/froala_editor/plugins/file.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/entities.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/font_size.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/fullscreen.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/image.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/image_manager.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/link.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/lists.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/paragraph_format.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/paragraph_style.min.js");
//        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/quick_insert.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/save.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/url.min.js");
        array_push($data['javascript_tag'], base_url() . "public/lib/froala_editor/plugins/video.min.js");
    }

}


if (!function_exists('load_sort_nest')) {

    function load_sort_nest(&$data) {
        array_push($data['stylesheet_tag'], base_url() . "public/admin/plugins/shortable-nestable/sort-nest.css");
        /////////// Plugin
//        array_push($data['javascript_tag'], base_url() . "public/admin/vendor/shortable-nestable/Sortable.min.js");
        array_push($data['javascript_tag'], base_url() . "public/admin/plugins/shortable-nestable/jquery.mjs.nestedSortable.js");
//        array_push($data['javascript_tag'], base_url() . "public/admin/vendor/shortable-nestable/jquery.nestable.js");
    }

}