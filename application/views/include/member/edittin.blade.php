<form method="POST" action="" id="form-dang-tin" style="margin: 20px 0px;">
    <h2 class='text-center text-success'>
        Sửa tin
    </h2>
    <div class="col-md-12">
        <legend>Thông tin bắt buộc</legend>
        <i class="describe col-md-12">Bạn vui lòng điền đầy đủ thông tin bên dưới.</i>
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
        <div class="form-group col-md-6 parent">
            <label>
                Tỉnh/Thành phố
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <select name="post_tp" ajax="" class="post_tp form-control" required="">
                @foreach($thanhpho as $row)
                @if($row['id_khuvuc'] == $tin['thanhpho'])
                <option value='{{$row['id_khuvuc']}}'  selected="">{{$row['ten_khuvuc']}}</option>
                @else
                <option value='{{$row['id_khuvuc']}}'>{{$row['ten_khuvuc']}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 parent">
            <label>
                Quận/Huyện:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <select name="post_quan" class="post_quan form-control" required="">
                @foreach($quan as $row)
                @if($row['id_khuvuc'] == $tin['quan'])
                <option value='{{$row['id_khuvuc']}}'selected="">{{$row['ten_khuvuc']}}</option>
                @else
                <option value='{{$row['id_khuvuc']}}'>{{$row['ten_khuvuc']}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4 parent">
            <label>
                Địa chỉ:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input name="diachi" class="diachi form-control" required="" value="{{$tin['diachi']}}"/>
        </div>
        <div class="form-group col-md-4 parent">
            <label>
                Diện tích (m2):
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input name="dientich" class="dien-tich form-control" required="" value='{{$tin['dientich']}}'/>
        </div>
        <div class="form-group col-md-4 parent">
            <label>
                Giá tiền (triệu đồng):
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input name="gia_ban" class="gia form-control" required="" value="{{$tin['gia']}}"/>
        </div>
    </div>
    <div class="col-md-12">
        <legend>Hình ảnh</legend>
        <i class="describe col-md-12">Hình ảnh thật của bất động sản.(Kích thước của file phải nhỏ hơn 10 MB. Các định dạng cho phép: png gif jpg jpeg.)</i>

        <div class="col-md-12">
            <div class="form-group">
                <input id="hinh-anh" name="hinhanh[]" type="file" multiple class="file">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <legend>Thông tin khác</legend>
        <i class="describe col-md-12">THông tin không bắt buộc,nên điền đầy đủ để máy chủ tìm kiếm bài viết của bạn dễ hơn.</i>
        <div class="form-group col-sm-12 col-md-6 parent">
            <label>
                Chiều dài
            </label><span class="error-place"></span>
            <input name="chieudai" class="form-control chieudai" value="{{$tin['chieudai']}}"/>
        </div>
        <div class="form-group col-sm-12 col-md-6 parent">
            <label>
                Chiều rộng
            </label><span class="error-place"></span>
            <input name="chieurong" class="form-control chieurong" value="{{$tin['chieurong']}}"/>
        </div>
        <div class="form-group col-sm-12 col-md-6 parent">
            <label>
                Hướng
            </label><span class="error-place"></span>
            <select name="huong" class="form-control">
                <option value="0">--- Chọn Hướng ---</option>
                @foreach($huong as $row)
                @if($row['id_huong'] == $tin['id_huong'])
                <option value='{{$row['id_huong']}}' selected="">{{$row['ten_huong']}}</option>
                @else
                <option value='{{$row['id_huong']}}'>{{$row['ten_huong']}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-6 parent">
            <label>
                Pháp lý
            </label><span class="error-place"></span>
            <select name="phaply" class="form-control">
                <option value="0">--- Chọn Pháp lý ---</option>
                @foreach($phaply as $row)
                @if($row['id_phaply'] == $tin['id_phaply'])
                <option value='{{$row['id_phaply']}}' selected="">{{$row['ten_phaply']}}</option>
                @else
                <option value='{{$row['id_phaply']}}'>{{$row['ten_phaply']}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-sm-12" style="padding-left:0;">
            <button type="submit" name="dangtin" class="btn btn-primary">Đăng Bài</button>
        </div>
    </div>
    <?php
    $html = $htmlcon = "";
    foreach ($tin['arr_hinhanh'] as $hinh) {
        $html .= "\"<img src='" . base_url() . $hinh['thumb_src'] . "' class='file-preview-image' alt='" . $hinh['ten_hinhanh'] . "' title='" . $hinh['ten_hinhanh'] . "'>\",";
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
        maxFileCount: 5,
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
        $(document).on('change', '.post_tp', function () {
            var parent = $(this).val();
            get_quan_huyen(parent);
        });
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $('.gia,.dien-tich,.chieudai,.chieurong').autoNumeric("init", {
            aSep: ' ',
            aDec: ',',
            pSign: 's',
            mDec: 0
        });
        $("#form-dang-tin").validate({
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
    function get_quan_huyen(parent) {
        $(".post_quan").empty();
        $.ajax({
            type: 'GET',
            data: {parent: parent},
            url: '{{base_url()}}ajax/get_quan_huyen',
            success: function (data) {
                $(".post_quan").html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    }
</script>