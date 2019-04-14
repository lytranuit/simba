<div class="page-loader-wrapper" style="display: none;">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-12">
            <b>{{lang("ngon_ngu")}}</b>
        </div>
        <div class="col-12">
            <select class="form-control-sm" id="select_language"style="width: 150px; display: inline-block">
                <option value="vietnamese">{{lang("ngon_ngu")}}</option>
                <option value="vietnamese">Tiếng Việt</option>
                <option value="english">English</option>
                <option value="japanese">日本語</option>
            </select>
        </div>
    </div>
    <div class="row">
        <form id="ncc_form" method="post" action="#" class="col-md-6 py-1">
            <input hidden="" name="content" />
            <fieldset>   	
                <legend>Thông tin Nhà sản xuất</legend>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ma_ncc")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ma_ncc")}}" name="code"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_ncc")}}:<span class="text-danger">*</span></b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_ncc")}}" required name="name"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("diachi_ncc")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("diachi_ncc")}}" name="address"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("dienthoai_ncc")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("dienthoai_ncc")}}" name="phone"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("fax_ncc")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("fax_ncc")}}" name="fax"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("email_ncc")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("email_ncc")}}" name="email" type="email"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("nlh_ncc")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("nlh_ncc")}}" name="note"/>
                    </div>
                </div>
            </fieldset>		

        </form>
        <form id="product_form" method="post" action="#" class="col-md-6 py-1">
            <fieldset>   	
                <legend>Thông tin Sản phẩm</legend>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ma_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ma_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_vi_sp")}}:<span class="text-danger">*</span></b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_vi_sp")}}" required=""/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_en_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_en_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_jp_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_jp_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("des_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("des_sp")}}" rows="5"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("detail_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("detail_sp")}}" rows="5"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("special_unit_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("special_unit_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("des_unit_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("des_unit_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("special_order_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("special_order_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("volume_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("volume_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("concentration_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("concentration_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("element_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("element_sp")}}" rows="5"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("guide_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("guide_sp")}}" rows="5"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("preservation_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("preservation_sp")}}" rows="5"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("material_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("material_sp")}}" rows="5"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("origin_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("origin_sp")}}"/>
                    </div>
                </div>

                <div class="row py-1">
                    <b class="col-md-3">{{lang("begin_date_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("begin_date_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("expiry_date_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("expiry_date_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("number_publish_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("number_publish_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("price_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("price_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("import_company_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("import_company_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_nsx_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_nsx_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("diachi_nsx_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("diachi_nsx_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("video_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("video_sp")}}"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-12">{{lang("file_sp")}}:</b>
                    <div class="col-md-12">
                        <input id="kv-file" type="file" name="file_up[]" multiple>
                    </div>
                </div>
            </fieldset>	
        </form>
        <div class="col-md-12 py-5 text-center">
            <button class="btn btn-success" id="save">
                Hoàn tất
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#select_language").change(function () {
            var language = $(this).val();
            $.ajax({
                url: path + 'ajax/setlanguage',
                data: {language: language},
                type: "POST",
                success: function () {
                    location.reload();
                }
            });
        })
        $("#kv-file").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': path + 'ajax/uploadfilev2',
            maxFileCount: 5,
            validateInitialCount: true,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            browseLabel: "",
            overwriteInitial: false,
        }).on("filebatchselected", function (event, files) {
//            $("#form-dang-tin .id_files").remove();
            $(this).fileinput("upload");
        }).on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var append = "<input type='hidden' name='id_files[]' value='" + id + "' class='id_files'/>";
            $("#product_form").append(append);
        }).on('filedeleted', function (event, key) {
            $(".id_files[value='" + key + "'").remove();
        });
//        var datepicker = $('#date').pickadate({
//            format: 'yyyy-mm-dd',
//            // editable: true,
//            closeOnSelect: true,
//            closeOnClear: false,
//            // Formats
//            onSet: function (item) {
//                if ('select' in item)
//                    setTimeout(timepicker.open, 0);
//            }
//        }).pickadate('picker');
//        var timepicker = $('#time').pickatime({
//            format: 'H:i:00',
//            interval: 60,
//            onSet: function (item) {
//                if ('select' in item)
//                    setTimeout(function () {
//                        $('#pickadatetime').val(datepicker.get() + ' ' + timepicker.get());
//                    }, 0)
//            }
//        }).pickatime('picker');
//        $('#pickadatetime').on('focus', datepicker.open).on('click', function (event) {
//            event.stopPropagation();
//            datepicker.open();
//        });
//        var datepicker1 = $('#date1').pickadate({
//            format: 'yyyy-mm-dd',
//            // editable: true,
//            closeOnSelect: true,
//            closeOnClear: false,
//            // Formats
//            onSet: function (item) {
//                if ('select' in item)
//                    setTimeout(timepicker1.open, 0);
//            }
//        }).pickadate('picker');
//        var timepicker1 = $('#time1').pickatime({
//            format: 'H:i:00',
//            interval: 60,
//            onSet: function (item) {
//                if ('select' in item)
//                    setTimeout(function () {
//                        $('#pickadatetime1').val(datepicker1.get() + ' ' + timepicker1.get());
//                    }, 0)
//            }
//        }).pickatime('picker');
//        $('#pickadatetime1').on('focus', datepicker1.open).on('click', function (event) {
//            event.stopPropagation();
//            datepicker1.open();
//        });
        $('#save').click(function () {
            if (!$("#product_form").valid() || !$("#ncc_form").valid())
                return false;
            var ncc = $.ajax({
                url: path + 'ajax/supplier',
                data: $("#ncc_form").serialize(),
                dataType: "JSON",
                type: "POST",
                beforeSend: function () {
                    $("#ncc_form").data("requestRunning", true);
                },
                success: function (data) {
                    $("#ncc_form").data("requestRunning", false);
                    var code = data.code;
                    var msg = data.msg;
                    alert(msg);
                    if (code == 400) {
//                        location.reload();
                    }
                }
            });
        });
        $("#product_form").validate({
            highlight: function (input) {
                $(input).addClass('border-danger');
            },
            unhighlight: function (input) {
                $(input).removeClass('border-danger');
            },
            errorPlacement: function (error, element) {
                $(element).parent().append(error);
            },
        });
        $("#ncc_form").validate({
            highlight: function (input) {
                $(input).addClass('border-danger');
            },
            unhighlight: function (input) {
                $(input).removeClass('border-danger');
            },
            errorPlacement: function (error, element) {
                $(element).parent().append(error);
            },
//            submitHandler: function (form) {
//
//                if ($("#logbook_form").data("requestRunning"))
//                    return false;
//                $(".page-loader-wrapper").show();
//                $.ajax({
//                    url: path + 'ajax/logbook',
//                    data: $("#logbook_form").serialize(),
//                    dataType: "JSON",
//                    type: "POST",
//                    beforeSend: function () {
//                        $("#logbook_form").data("requestRunning", true);
//                    },
//                    success: function (data) {
//                        $("#logbook_form").data("requestRunning", false);
//                        var code = data.code;
//                        var msg = data.msg;
//                        alert(msg);
//                        if (code == 400) {
//                            location.reload();
//                        }
//                    }
//                });
//                return false;
//            }
        });
    })
</script>
<style>
    h6{
        margin: 5px;
    }
    #date,#time,#date1,#time1{display:none;}
    textarea.form-control,input.form-control{font-size: 13px;}
    fieldset 
    {
        border: 1px solid #ddd !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;       
        position: relative;
        border-radius:4px;
        background-color:#f5f5f5;
        padding-left:10px!important;
    }	

    legend
    {
        color: red;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0px;
        width: initial;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px 10px;
        display: inline-block;
        background-color: #ffffff;
        text-transform: uppercase;
    }
</style>