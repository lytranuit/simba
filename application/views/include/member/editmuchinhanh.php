<form  method="POST" action="" id="form-banner" style="margin: 20px 0px;">
    <div class="col-md-12 alert edibanner">
        <h3 class="col-md-12 text-center">
            Trang chủ (Hình ảnh)
        </h3>
        <div class="col-md-12">
            <div class="form-group">
                <input id="hinh-anh-banner" name="hinhanh[]" type="file" multiple class="file">
            </div>
        </div>
        <?= $htmlinput ?>
    </div>
    <div class="col-md-12 text-center">
        <button type="submit" name="muchinhanh" class="btn btn-primary">Sửa</button>
    </div>
</form>
<script type="text/javascript">
    $("#hinh-anh-banner").fileinput({
        uploadUrl: '<?php echo base_url() . "member/uploadhinhanh"; ?>', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
        maxFileSize: 10000,
        maxFileCount: 30,
        validateInitialCount: true,
        overwriteInitial: false,
<?php if ($html != ""): ?>
            'initialPreview': [
    <?= $html ?>
            ],
            initialPreviewConfig: [
    <?= $htmlcon ?>
            ],
<?php endif; ?>
    }).on("filebatchselected", function (event, files) {
        $(this).fileinput("upload");
    });
    $("#hinh-anh-banner").on('fileuploaded', function (event, data, previewId, index) {
        var id = data.response.key;
        var add = "<input type='hidden' name='id_hinhanh[]' value='" + id + "' class='hinhanh'>";
        $("#form-banner .edibanner").append(add);
    });
    $("#hinh-anh-banner").on('filedeleted', function (event, key) {
        $(".hinhanh[value='" + key + "'").remove();
    });
    $(document).ready(function () {
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#form-banner").validate({
            errorPlacement: function (error, element) {
                element.parents(".parent").find(".error-place").addClass("text-danger");
                error.appendTo(element.parents(".parent").find(".error-place"));
            },
            submitHandler: function (form) {
                form.submit();
                return false;
            }
        });
    });
</script>