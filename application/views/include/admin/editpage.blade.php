<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Sửa page</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sửa Page</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <b class="form-label">Tiêu đề (*):</b>
                                <div class="form-line">
                                    <input type="text" name='post_titles' class="form-control" required="" aria-required="true" value="{{$tin['title']}}">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <b class="form-label">Nội dung (*):</b>
                                <div class="form-line">
                                    <textarea name="post_contents" id="edit" required="" class="form-control">
                                            {{$tin['content']}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-12" style="padding-left:0;">
                                <button type="submit" name="dangtin" class="btn btn-primary">Sửa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $('#edit').froalaEditor({
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