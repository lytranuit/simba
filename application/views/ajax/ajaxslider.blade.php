
<div class="col-md-12 alert box-{{$id}}">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <div class="col-md-1 col-xs-1 col-sm-1 col-lg-1" style="margin: 8px 0px 20px;">Slider</div>
        <div class="col-md-1 col-xs-1 col-sm-1 col-lg-1" ><input class="form-control" name="order[]" required="" style="min-height: 0px;padding: 5px;"/></div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input id="hinh-anh{{$id}}" name="hinhanh[]" type="file" multiple class="file">
        </div>
    </div>
    <div class="form-group col-md-4 parent">
        <label for="text1">
            Text1:
        </label><span class="text-danger">*</span><span class="error-place"></span>
        <textarea name="text1[]" value="" class="form-control edit"></textarea>
    </div>
    <div class="form-group col-md-4 parent">
        <label for="text2">
            Text2:
        </label><span class="text-danger">*</span><span class="error-place"></span>
        <textarea name="text2[]" value="" class="form-control edit"></textarea>
    </div>
    <div class="form-group col-md-4 parent">
        <label for="text3">
            Text3:
        </label><span class="text-danger">*</span><span class="error-place"></span>
        <textarea name="text3[]" value="" class="form-control edit"></textarea>
    </div>
    <input type="hidden" name="id[]" value="{{$id}}"/>
    <script type="text/javascript">
        $("#hinh-anh{{$id}}").fileinput({
            uploadUrl: '<?php echo base_url() . "member/uploadhinhanh"; ?>', // you must set a valid URL here else you will get an error
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            maxFileSize: 10000,
            maxFileCount: 1,
            overwriteInitial: false,
            validateInitialCount: true
        });
        $("#hinh-anh{{$id}}").on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var add = "<input type='hidden' name='id_hinhanh[]' value='" + id + "' class='hinhanh'>";
            $("#form-slider .box-{{$id}}").append(add);
        });
        $('#hinh-anh{{$id}}').on('filedeleted', function (event, key) {
            $(".hinhanh[value='" + key + "'").remove();
        });

        $('.edit').froalaEditor({
            toolbarButtons: ['color'],
        })
    </script>
</div>