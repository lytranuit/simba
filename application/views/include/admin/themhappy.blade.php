<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Đánh giá</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Thêm đánh giá</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="col-md-2">
                            <b class="form-label">Hình ảnh đại diện:</b>
                            <img src="<?= base_url() . "public/img/preview.png" ?>" id='hinh_preview' style="display:block;cursor: pointer;width: 125px;"/>
                            <input id="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                        </div>
                        <div class="col-md-10">
                            <div class='col-md-6'>
                                <div class="form-group form-float">
                                    <b class="form-label">Tên</b>
                                    <div class="form-line">
                                        <input type="text" name='name' class="form-control" required="" aria-required="true">
                                        <label class="form-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group form-float">
                                    <b class="form-label">Vị trí:</b>
                                    <div class="form-line">
                                        <input type="text" name='position' class="form-control" aria-required="true">
                                        <label class="form-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <b class="form-label">Lời đánh giá:</b>
                                    <div class="form-line">
                                        <textarea name="comment" required="" class="form-control edit">
                                        
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name="dangtin" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $("#kv-explorer").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': path + 'admin/uploadhinhanh',
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
            maxFileCount: 1,
            showPreview: false,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            browseLabel: "",
        }).on("filebatchselected", function (event, files) {
            $("#form-dang-tin .id_hinhanh").remove();
            $(this).fileinput("upload");
        }).on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var src = data.response.initialPreview[0];
            $("#hinh_preview").attr("src", src);
            var append = "<input type='hidden' name='id_hinhanh' value='" + id + "' class='id_hinhanh'/>";
            $("#form-dang-tin").append(append);
        });
        $("#kv-explorer").parents(".file-input").hide();
        $("#hinh_preview").click(function () {
            $("#kv-explorer").click();
        });
        $.validator.setDefaults({
            debug: true,
            success: "valid"
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