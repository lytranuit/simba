<form method="POST" action="" id="form-dang-tin" style="margin: 20px 0px;">
    <h2 class='text-center text-success'>
        Sửa tin tức
    </h2>
    <div class="col-md-12">
        <div class="form-group col-md-12 tieude parent">
            <label for="post_titles">
                Tiêu đề:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="text" name="post_titles" class="form-control" placeholder="Tiêu đề" value="{{$tin['title']}}" required=""/>
        </div>
        <div class="form-group col-md-12 noidung parent">
            <label for="post_contents">
                Nội dung 
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <textarea name="post_contents" class="form-control" id="edit"required="">{{$tin['content']}}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <legend>Hình ảnh</legend>
        <i class="describe col-md-12">Hình ảnh đại diện tin tức.(Kích thước của file phải nhỏ hơn 10 MB. Các định dạng cho phép: png gif jpg jpeg.)</i>
        <div class="col-md-12">
            <div class="form-group">
                <input id="hinh-anh" name="hinhanh[]" type="file" multiple class="file">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-sm-12" style="padding-left:0;">
            <button type="submit" name="dangtin" class="btn btn-primary">Sửa tin tức</button>
        </div>
    </div>
    <?php
    $html = $htmlcon = "";
    foreach ($tin['arr_hinhanh'] as $hinh) {
        $html .="\"<img src='" . base_url() . $hinh['thumb_src'] . "' class='file-preview-image' alt='" . $hinh['ten_hinhanh'] . "' title='" . $hinh['ten_hinhanh'] . "'>\",";
        $htmlcon .= "{
        caption: '" . $hinh['ten_hinhanh'] . "',
        width: '120px',
        url: '" . base_url() . "member/deleteImage/1',
        key: " . $hinh['id_hinhanh'] . "
    },";
        echo "<input type='hidden' name='id_hinhanh[]' value='" . $hinh['id_hinhanh'] . "' class='hinhanh'>";
    }
    ?>
</form>

<script type='text/javascript'>
    $("#hinh-anh").fileinput({
        uploadUrl: '<?php echo base_url() . "member/uploadhinhanh"; ?>', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
        maxFileSize: 10000,
        maxFileCount: 1,
        validateInitialCount: true,
        overwriteInitial: false,
        initialPreview: [
<?= $html ?>
        ],
        initialPreviewConfig: [
<?= $htmlcon ?>
        ],
    });
    $("#hinh-anh").on('fileuploaded', function (event, data, previewId, index) {
        var id = data.response.key;
        var add = "<input type='hidden' name='id_hinhanh[]' value='" + id + "' class='hinhanh'>";
        $("#form-dang-tin").append(add);
    });
    $('#hinh-anh').on('filedeleted', function (event, key) {
        $(".hinhanh[value='" + key + "'").remove();
    });
    $(document).ready(function () {
        /* dang tin */
        $('#edit').froalaEditor({
            heightMin: 200,
            heightMax: 500
        })
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