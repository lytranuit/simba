<form method="POST" action="" id="form-dang-tin" style="margin: 20px 0px;">
    <h2 class='text-center text-success'>
        Trang chủ (Tổng quan)
    </h2>
    <div class="col-md-12">
        <div class="form-group col-md-12 tieude parent">
            <label for="post_titles">
                Tiêu đề:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="text" name="post_titles" class="form-control" placeholder="Tiêu đề" value="{{$tieu_de or ''}}" required=""/>
        </div>

        <div class="form-group col-md-12 noidung parent">
            <label for="post_contents">
                Nội dung
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <textarea name="post_contents" class="form-control" id="edit"required="">{{$noi_dung or ''}}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-sm-12" style="padding-left:0;">
            <button type="submit" name="muc1" class="btn btn-primary">Sửa</button>
        </div>
    </div>
</form>
<script type='text/javascript'>
    $(document).ready(function () {
        /* dang tin */
        $('#edit').froalaEditor({
            heightMin: 200,
            heightMax: 500,
            // Set the image upload URL.
            imageUploadURL: '<?= base_url() ?>member/uploadimage',
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
            errorPlacement: function (error, element) {
                element.parents(".parent").find(".error-place").addClass("text-danger");
                error.appendTo(element.parents(".parent").find(".error-place"));
            },
            submitHandler: function (form) {

                form.submit();
                return false;

            }
        });

        /* ENd dang tin */
    });
</script>