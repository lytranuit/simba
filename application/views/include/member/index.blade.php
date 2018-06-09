<form name="form" id="form-edit-user" action="{{base_url()}}member" class=""method="POST">
    <h2 class='text-center text-danger'>
        THÔNG TIN CÁ NHÂN
    </h2>
    <div class="col-md-12">
        <div class="form-group col-md-6 parent">
            <label for="username">
                Tên đăng nhập:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="text" name="username" class="form-control" placeholder="VD: daotran" disabled="" value="{{$user['username']}}"/>
        </div>
        <div class="form-group col-md-6 parent">
            <label for="ten">
                Họ và Tên
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="text" name="ten" class="form-control" placeholder="VD: Đào Lý Trân" required="" value="{{$user['last_name']}}"/>
        </div>

        <div class="form-group col-md-12 parent">
            <label for="email">
                Email:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="email" name="email" class="form-control" placeholder="VD:abc@gmail.com" value="{{$user['email']}} "disabled=""/>
        </div>
        <div class="form-group col-md-12 parent">
            <label for="gioitinh">
                Giới tính
            </label><span class="text-danger">*</span><span class="error-place"></span>
            @if($user['gioitinh'] == "Nam")
            <label><input type="radio" name="gioitinh" value='Nam' checked="">Nam</label>
            <label><input type="radio" name="gioitinh" value="Nữ" />Nữ</label>
            @else
            <label><input type="radio" name="gioitinh" value='Nam' />Nam</label/
            <label><input type="radio" name="gioitinh" value="Nữ" checked="" />Nữ</label>
            @endif
        </div>
        <div class="form-group col-md-12 parent">
            <label for="dienthoai">
                Điện thoại:
            </label><span class="error-place"></span>
            <input type="number" name="dienthoai" class="form-control" placeholder="VD:01224545275" value="{{$user['phone']}}"/>
        </div>
        <div class="col-md-12">
            <a class="" href="{{base_url()}}member/changepass"> <i class="glyphicon glyphicon-lock"></i> Thay đổi mật khẩu</a>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" name="edit_user" class="btn btn-primary">Thay đổi</button>
        </div>
    </div>
</form>     
<script type="text/javascript">
    $(document).ready(function () {
        /* login */
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#form-edit-user").validate({
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