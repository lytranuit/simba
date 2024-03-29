<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Thêm tin tức</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Thêm tin tức</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="col-md-2">
                            <b class="form-label">Hình ảnh đại diện:</b>
                            <img src="<?= base_url() . "public/img/preview.png" ?>" id='hinh_preview' style="display:block;cursor: pointer;width: 125px;"/>
                            <input id="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                        </div>
                        <div class="col-md-4">
                            <b class="form-label">Type (*):</b>
                            <select class="form-control" name="type">
                                @foreach($arr_type as $row)
                                <option value="{{$row['id']}}">{{$row['name_vi']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <b class="form-label">File:</b>
                            <input id="kv-file" type="file" name="file_up[]" multiple data-show-preview="false">
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
                                        <b class="form-label">Tiêu đề (*):</b>
                                        <div class="form-line">
                                            <input type="text" name='title_vi' class="form-control" required="" aria-required="true">
                                            <label class="form-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <b class="form-label">Nội dung (*):</b>
                                        <div class="form-line">
                                            <textarea name="content_vi" required="" class="form-control edit">
                                        
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="en">
                                    <div class="form-group form-float">
                                        <b class="form-label">Tiêu đề:</b>
                                        <div class="form-line">
                                            <input type="text" name='title_en' class="form-control" aria-required="true">
                                            <label class="form-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <b class="form-label">Nội dung:</b>
                                        <div class="form-line">
                                            <textarea name="content_en" class="form-control edit">
                                        
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="jp">
                                    <div class="form-group form-float">
                                        <b class="form-label">Tiêu đề:</b>
                                        <div class="form-line">
                                            <input type="text" name='title_jp' class="form-control" aria-required="true">
                                            <label class="form-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <b class="form-label">Nội dung:</b>
                                        <div class="form-line">
                                            <textarea name="content_jp" class="form-control edit">
                                        
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name="dangtin" class="btn btn-primary">Thêm Tin tức</button>
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
        $("#kv-file").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': path + 'admin/uploadfile',
            maxFileCount: 3,
            showPreview: false,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            browseLabel: "",
            initialPreviewConfig: []
        }).on("filebatchselected", function (event, files) {
            $("#form-dang-tin .id_files").remove();
            $(this).fileinput("upload");
        }).on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var append = "<input type='hidden' name='id_files[]' value='" + id + "' class='id_files'/>";
            $("#form-dang-tin").append(append);
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