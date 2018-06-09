<div class="col-md-12" style="margin:20px 0px;">
    <button class="btn btn-success themslider" href=""><span></span>Thêm Lý do</button>
</div>
<form  method="POST" action="" id="form-slider" style="margin: 20px 0px;">
    <div class="form-group col-md-12 tieude parent">
        <label for="post_titles">
            Tiêu đề:
        </label><span class="text-danger">*</span><span class="error-place"></span>
        <input type="text" name="post_titles" class="form-control" placeholder="Tiêu đề" value="{{$tieu_de or ''}}" required=""/>
    </div>
    @foreach($arr_slider as $slider)
    <div class="col-md-12 alert box-{{$slider['id']}}">
        <a href="#" class="close delete-slider" data-id="{{$slider['id']}}" data-dismiss="alert" aria-label="close" title="close">×</a>
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="float: left;width: 50px;margin: 8px 0px 20px;">Lý do</div>
            <div class="col-md-1 col-xs-1 col-sm-1 col-lg-1" ><input class="form-control" name="order[]" required="" style="min-height: 0px;padding: 5px;" value="{{$slider['order']}}"/></div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input id="hinh-anh{{$slider['id']}}" name="hinhanh[]" type="file" multiple class="file">
            </div>
        </div>
        <div class="form-group col-md-12 parent">
            <label for="text1">
                Tiêu đề:
            </label><span class="error-place"></span>
            <textarea name="text1[]" value="" class="form-control edit">{{$slider['tieu_de']}}</textarea>
        </div>
        <div class="form-group col-md-12 parent">
            <label for="text2">
                Nội dung:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <textarea name="text2[]" value="" class="form-control edit">{{$slider['noi_dung']}}</textarea>
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
        $(".themslider").click(function () {
            $.ajax({
                type: 'GET',
                url: '{{base_url()}}ajax/loadlydo',
                success: function (data) {
                    $("#form-slider .tieude").after(data);
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