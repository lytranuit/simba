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
            <input hidden="" name="content" />
            <fieldset>   	
                <legend>Thông tin Sản phẩm</legend>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ma_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ma_sp")}}" name="code"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_vi_sp")}}:<span class="text-danger">*</span></b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_vi_sp")}}" required="" name="name_vi"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_en_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_en_sp")}}" name="name_en"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_jp_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_jp_sp")}}" name="name_jp"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("des_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("des_sp")}}" rows="5" name="description"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("detail_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("detail_sp")}}" rows="5" name="detail"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("special_unit_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("special_unit_sp")}}" name="special_unit"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("des_unit_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("des_unit_sp")}}" name="description_unit"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("special_order_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("special_order_sp")}}" name="special_order"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("volume_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("volume_sp")}}" name="volume"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("concentration_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("concentration_sp")}}" name="concentration"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("element_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("element_sp")}}" rows="5" name="element"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("guide_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("guide_sp")}}" rows="5" name="guide"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("preservation_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("preservation_sp")}}" rows="5" name="preservation"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("material_sp")}}:</b>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="{{lang("material_sp")}}" rows="5"  name="material"></textarea>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("origin_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("origin_sp")}}"  name="origin"/>
                    </div>
                </div>

                <div class="row py-1">
                    <b class="col-md-3">{{lang("begin_date_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("begin_date_sp")}}" name="begin_date" type="date"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("expiry_date_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("expiry_date_sp")}}"  name="expiry_date" type="date"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("number_publish_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("number_publish_sp")}}" name="number_publish"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("price_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("price_sp")}}" name="price"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("import_company_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("import_company_sp")}}" name="import_company"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("ten_nsx_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("ten_nsx_sp")}}" name="name_nsx"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("diachi_nsx_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("diachi_nsx_sp")}}" name="address_nsx"/>
                    </div>
                </div>
                <div class="row py-1">
                    <b class="col-md-3">{{lang("video_sp")}}:</b>
                    <div class="col-md-9">
                        <input class="form-control" placeholder="{{lang("video_sp")}}" name="video"/>
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

        <form id="auth" class="col-md-12 py-5 text-center">
            <button class="btn btn-success" id="save" name="content">
                Hoàn tất
            </button>
            <?= $scriptCap ?>
            <?= $captcha ?>
        </form>
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
//                    $('#pickadatetime').val(datepicker.get());
//            }
//        }).pickadate('picker');
//        $('#pickadatetime').on('focus', datepicker.open).on('click', function (event) {
//            event.stopPropagation();
//            datepicker.open();
//        });
        $('#save').click(function (e) {
            e.preventDefault();
            if (!$("#product_form").valid() || !$("#ncc_form").valid())
                return false;

            $(".page-loader-wrapper").show();
            $.ajax({
                url: path + 'ajax/supplier',
                data: $("#ncc_form").serialize() + '&' + $("#auth").serialize(),
                dataType: "JSON",
                type: "POST",
                beforeSend: function () {
                    $("#ncc_form").data("requestRunning", true);
                },
                success: function (data) {
                    $("#ncc_form").data("requestRunning", false);
                    var code = data.code;
                    if (code == 400) {
                        $.ajax({
                            url: path + 'ajax/supplierproduct',
                            data: $("#product_form").serialize() + '&supplier_id=' + data.msg,
                            dataType: "JSON",
                            type: "POST",
                            beforeSend: function () {
                                $("#product_form").data("requestRunning", true);
                            },
                            success: function (data) {
                                $("#product_form").data("requestRunning", false);
                                var code = data.code;
                                if (code == 400) {
                                    alert(data.msg);
                                    location.reload();
                                } else {
                                    alert(data.msg);
                                }
                            }
                        });
                    } else {
                        alert(data.msg);
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