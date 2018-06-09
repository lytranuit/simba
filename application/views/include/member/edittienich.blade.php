<div class="col-md-12" style="margin:20px 0px;">
    <button class="btn btn-success themslider" href=""><span></span>Thêm tiện ích</button>
</div>
<form  method="POST" action="" id="form-slider" style="margin: 20px 0px;">
    @foreach($arr_slider as $slider)
    <div class="col-md-12 alert box-{{$slider['id']}}">
        <a href="#" class="close delete-slider" data-id="{{$slider['id']}}" data-dismiss="alert" aria-label="close" title="close">×</a>
        <div class="form-group col-md-12 parent">
            <label for="text1">
                Tiêu đề:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input name="text1[]" value="{{$slider['tieu_de']}}" class="form-control"/>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input id="hinh-anh{{$slider['id']}}" name="hinhanh[]" type="file" multiple class="file">
            </div>
        </div>
        <input type="hidden" name="id[]" value="{{$slider['id']}}"/>
        <input type='hidden' name='id_hinhanh[]' value='{{$slider['id_hinhanh']}}' class='hinhanh'>
        <script type="text/javascript">
            $("#hinh-anh{{$slider['id']}}").fileinput({
                uploadUrl: '<?php echo base_url() . "member/uploadhinhanh"; ?>', // you must set a valid URL here else you will get an error
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                maxFileSize: 10000,
                maxFileCount: 1,
                validateInitialCount: true,
                overwriteInitial: false,
                initialPreview: [
<?= $slider['hinhhtml'] ?>
                ],
                initialPreviewConfig: [
<?= $slider['hinhconf'] ?>
                ],
            }).on("filebatchselected", function (event, files) {
                $(this).fileinput("upload");
            });
            $("#hinh-anh{{$slider['id']}}").on('fileuploaded', function (event, data, previewId, index) {
                var id = data.response.key;
                var add = "<input type='hidden' name='id_hinhanh[]' value='" + id + "' class='hinhanh'>";
                $("#form-slider .box-{{$slider['id']}}").append(add);
            });
            $("#hinh-anh{{$slider['id']}}").on('filedeleted', function (event, key) {
                $(".hinhanh[value='" + key + "'").remove();
            });
        </script>
    </div>
    @endforeach
    <div class="col-md-12">
        <div class="col-sm-12" style="padding-left:0;">
            <button type="submit" name="slider" class="btn btn-primary">Sửa</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.edit').froalaEditor({
            toolbarButtons: ['color'],
        })
        $(".themslider").click(function () {
            $.ajax({
                type: 'GET',
                url: '{{base_url()}}ajax/loadtienich',
                success: function (data) {
                    $("#form-slider").prepend(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        });
        $(".delete-slider").click(function () {
            var id = $(this).attr("data-id");
            $("#form-slider").append("<input type='hidden' name='id_deleted[]' value='" + id + "'/>")
        });
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#form-slider").validate({
            errorPlacement: function (error, element) {
                element.parents(".parent").find(".error-place").addClass("text-danger");
                error.appendTo(element.parents(".parent").find(".error-place"));
            },
            submitHandler: function (form) {
                var numslider = $("#form-slider .alert").length;
                var numhinhanh = $("#form-slider .hinhanh").length;
                if (numslider != numhinhanh) {
                    alert("Up hình cho mỗi Silder");
                    return false;
                }
                form.submit();
                return false;
            }
        });
    });
</script>