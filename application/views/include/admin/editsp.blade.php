
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Sản phẩm chào hàng</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sản phẩm chào hàng</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
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
                                @if(isset($tin->files))
                                @foreach($tin->files as $key=>$row)
                                <input type='hidden' name='id_files[]' value='{{$key}}' class='id_files'/>
                                @endforeach
                                @endif
                                <input id="kv-file" type="file" name="file_up[]" multiple />
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("ncc_info")}}:</b>
                            <div class="col-md-9">
                                <select class="form-control" name="supplier_id">
                                    
                                    <option value="0">Chọn nhà sản xuất</option>
                                    @foreach($supplier as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name="dangtin" class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        var tin = <?= json_encode($tin) ?>;
        $.AdminBSB.function.fillForm($("#form-dang-tin"), tin);
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#kv-file").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': path + 'ajax/uploadfilev2',
            maxFileCount: 10,
            browseLabel: "",
            showRemove: false,
            showUpload: false,
            showCancel: false,
            overwriteInitial: false,
            initialPreviewConfig: <?= json_encode($htmlconf); ?>,
            initialPreview: <?= json_encode($html); ?>,
        }).on("filebatchselected", function (event, files) {
//            $("#form-dang-tin .id_files").remove();
            $(this).fileinput("upload");
        }).on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var append = "<input type='hidden' name='id_files[]' value='" + id + "' class='id_files'/>";
            $("#form-dang-tin").append(append);
        }).on('filedeleted', function (event, key) {
            $(".id_files[value='" + key + "'").remove();
        });
        $("#form-dang-tin").validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                form.submit();
                return false;
            }
        });
    });
</script>