<form method="POST" action="" id="form-gioithieu" style="margin: 20px 0px;">
    <h2 class='text-center text-success'>
        Trang giới thiệu
    </h2>
    <input name="id" hidden="" value="{{$gioithieu['id_option']}}"/>
    <div class="form-group col-md-12 noidung parent">
        <label for="post_contents"></label>
        <span class="error-place"></span>
        <textarea name="post_contents" class="form-control" id="edit"required="">{{$gioithieu['content']}}</textarea>
    </div>
    <div class="col-md-12">
        <div class="col-sm-12" style="padding-left:0;">
            <button type="submit" name="dangtin" class="btn btn-primary">Edit</button>
        </div>
    </div>
</form>
<script type='text/javascript'>

    $(document).ready(function () {
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $('#edit').froalaEditor({
            heightMin: 200,
            heightMax: 500
        })
        $("#form-gioithieu").validate({
            errorPlacement: function (error, element) {
                element.parents(".parent").find(".error-place").addClass("text-danger");
                error.appendTo(element.parents(".parent").find(".error-place"));
            },
            submitHandler: function (form) {
                $('.gia,.dien-tich,.chieudai,.chieurong').each(function () {
                    var value = $(this).autoNumeric('get');
                    $(this).val(value);
                });
                form.submit();
                return false;

            }
        });

        /* ENd dang tin */
    });
</script>