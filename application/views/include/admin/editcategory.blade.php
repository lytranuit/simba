<?php
$hinh_preview = isset($tin->hinhanh->thumb_src) ? $tin->hinhanh->thumb_src : "public/img/preview.png";
$role_show = explode(",", $tin->role_show);
?>
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Nhóm hàng</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sửa nhóm hàng</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <input type="hidden" name='id_hinhanh' value='{{$tin->id_hinhanh}}' class='id_hinhanh'/>
                        <div class="col-md-2">
                            <b class="form-label">Hình ảnh đại diện:</b>
                            <img src="<?= base_url() . $hinh_preview ?>" id='hinh_preview' style="display:block;cursor: pointer;width: 125px;"/>
                            <input id="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                        </div>
                        <div class="col-md-4">
                            <b class="form-label">Category (*):</b>
                            <select class="form-control" name="id_category" id="id_category">
                                @foreach($arr_category as $row)
                                <option value="{{$row->id}}">{{$row->name_vi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <b class="form-label">Role:</b>
                            <select class="form-control" name="role_show[]" id="role_show" multiple="">
                                @foreach($role as $row)
                                @if(in_array($row['id'],$role_show))
                                <option value="{{$row['id']}}" selected="">{{$row['name']}}</option>
                                @else 
                                <option value="{{$row['id']}}">{{$row['name']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng Việt</a></li>
                                <li role="presentation" class=""><a href="#en" data-toggle="tab" aria-expanded="false">Tiếng Anh</a></li>
                                <li role="presentation" class=""><a href="#jp" data-toggle="tab" aria-expanded="false">Tiếng Nhật</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="vi">
                                    <div class="form-group form-float">
                                        <b class="form-label">Nhóm hàng (*):</b>
                                        <div class="form-line">
                                            <input type="text" name='name_vi' class="form-control" required="" aria-required="true">
                                            <label class="form-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <b class="form-label">Mô tả (*):</b>
                                        <div class="form-line">
                                            <textarea name="content_vi" required="" class="form-control edit">
                                        
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="en">
                                    <div class="form-group form-float">
                                        <b class="form-label">Nhóm hàng:</b>
                                        <div class="form-line">
                                            <input type="text" name='name_en' class="form-control" aria-required="true">
                                            <label class="form-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <b class="form-label">Mô tả:</b>
                                        <div class="form-line">
                                            <textarea name="content_en" class="form-control edit">
                                        
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="jp">
                                    <div class="form-group form-float">
                                        <b class="form-label">Nhóm hàng:</b>
                                        <div class="form-line">
                                            <input type="text" name='name_jp' class="form-control" aria-required="true">
                                            <label class="form-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <b class="form-label">Mô tả:</b>
                                        <div class="form-line">
                                            <textarea name="content_jp" class="form-control edit">
                                        
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name="dangtin" class="btn btn-primary">Sửa nhóm hàng</button>
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
        $("#role_show").chosen();
        $("#id_category").chosen();
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
            initialPreviewConfig: [
                {caption: "Business 1.jpg", size: 762980, url: "$urlD", key: 11},
            ]
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
        $('.edit').froalaEditor({
            heightMin: 200,
            heightMax: 500, // Set the image upload URL.
            imageUploadURL: '<?= base_url() ?>admin/uploadimage',
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
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