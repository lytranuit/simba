<html>
    <head>
        <style>

        </style>
    </head>
    <body>
        @if(isset($row->supplier->name))
        <div style='color:red;text-transform: uppercase;font-weight: bold;'>
            {{lang("ncc_info")}}
        </div>
        <ul>
            <li>
                <strong>{{lang("ma_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->code ?></span>
            </li>
            <li>
                <strong>{{lang("ten_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->name ?></span>
            </li>
            <li>
                <strong>{{lang("diachi_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->address ?></span>
            </li>
            <li>
                <strong>{{lang("dienthoai_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->phone ?></span>
            </li>
            <li>
                <strong>{{lang("fax_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->fax ?></span>
            </li>
            <li>
                <strong>{{lang("email_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->email ?></span>
            </li>
            <li>
                <strong>{{lang("nlh_ncc")}}: </strong>
                <span style="white-space: pre"><?= $row->supplier->note ?></span>
            </li>
        </ul>
        @endif
        <div style='color:red;text-transform: uppercase;font-weight: bold;'>
            {{lang("product_info")}}
        </div>
        <ul>
            <li>
                <strong>{{lang("ma_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->code ?></span>
            </li>
            <li>
                <strong>{{lang("ten_vi_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->name_vi ?></span>
            </li>
            <li>
                <strong>{{lang("ten_en_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->name_vi ?></span>
            </li>
            <li>
                <strong>{{lang("des_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->description ?></span>
            </li>

            <li>
                <strong>{{lang("detail_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->detail ?></span>
            </li>
            <li>
                <strong>{{lang("special_unit_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->special_unit ?></span>
            </li>
            <li>
                <strong>{{lang("des_unit_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->description_unit ?></span>
            </li>
            <li>
                <strong>{{lang("special_order_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->special_order ?></span>
            </li>
            <li>
                <strong>{{lang("volume_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->volume ?></span>
            </li>
            <li>
                <strong>{{lang("concentration_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->concentration ?></span>
            </li>
            <li>
                <strong>{{lang("element_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->element ?></span>
            </li>
            <li>
                <strong>{{lang("guide_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->guide ?></span>
            </li>
            <li>
                <strong>{{lang("preservation_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->preservation ?></span>
            </li>
            <li>
                <strong>{{lang("material_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->material ?></span>
            </li>
            <li>
                <strong>{{lang("origin_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->origin ?></span>
            </li>
            <li>
                <strong>{{lang("begin_date_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->begin_date ?></span>
            </li>
            <li>
                <strong>{{lang("expiry_date_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->expiry_date ?></span>
            </li>
            <li>
                <strong>{{lang("number_publish_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->number_publish ?></span>
            </li>
            <li>
                <strong>{{lang("price_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->price ?></span>
            </li>
            <li>
                <strong>{{lang("import_company_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->import_company ?></span>
            </li>
            <li>
                <strong>{{lang("ten_nsx_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->name_nsx ?></span>
            </li>
            <li>
                <strong>{{lang("diachi_nsx_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->address_nsx ?></span>
            </li>
            <li>
                <strong>{{lang("video_sp")}}: </strong>
                <span style="white-space: pre"><?= $row->video ?></span>
            </li>
        </ul>
    </body>
</html>