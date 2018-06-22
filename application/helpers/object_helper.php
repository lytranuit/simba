<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('object_tintuc')) {

    function object_tintuc($data) {
        $title = isset($data['title']) ? $data['title'] : '';
        $content = isset($data['content']) ? $data['content'] : '';
        $title_en = isset($data['title_en']) ? $data['title_en'] : '';
        $content_en = isset($data['content_en']) ? $data['content_en'] : '';
        $title_jp = isset($data['title_jp']) ? $data['title_jp'] : '';
        $content_jp = isset($data['content_jp']) ? $data['content_jp'] : '';
        $date = isset($data['date']) ? $data['date'] : time();
        $type = isset($data['type']) ? $data['type'] : null;
        $id_hinhanh = isset($data['id_hinhanh']) ? $data['id_hinhanh'] : null;
        $id_user = isset($data['id_user']) ? $data['id_user'] : null;
        $active = isset($data['active']) ? $data['active'] : 0;
        $obj = array(
            'title' => $title,
            'content' => $content,
            'title_en' => $title_en,
            'content_en' => $content_en,
            'title_jp' => $title_jp,
            'content_jp' => $content_jp,
            'date' => $date,
            'type' => $type,
            'id_hinhanh' => $id_hinhanh,
            'id_user' => $id_user,
            'active' => $active
        );
        return $obj;
    }

}
