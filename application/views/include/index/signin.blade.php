<div id="signinbox" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2"> 
    <form name="form" id="form-signin" action="{{base_url()}}index/signin" class=""method="POST">
        <h2 class='text-center text-success'>
            Đăng ký tài khoản
        </h2>
        @if($message != '')
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert" href="#">×</a>{{$message}}
        </div>
        @endif
        <div class="col-md-12">
            <div class="form-group col-md-6 parent">
                <label for="username">
                    Tên đăng nhập:
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <input type="text" name="username" class="form-control" minlength="6" placeholder="VD: daotran" required=""/>
            </div>
            <div class="form-group col-md-6 parent">
                <label for="ten">
                    Họ và Tên
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <input type="text" name="ten" class="form-control" placeholder="VD: Đào Lý Trân" required=""/>
            </div>
            <div class="form-group col-md-12 parent">
                <label for="gioitinh">
                    Giới tính
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <label><input type="radio" name="gioitinh" value='Nam' checked="">Nam</label>
                <label><input type="radio" name="gioitinh" value="Nữ">Nữ</label>
            </div>
            <div class="form-group col-md-6 parent">
                <label for="password">
                    Mật khẩu:
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <input type="password" name="password" class="form-control" minlength="8"  placeholder="Ít nhất 8 kí tự" required=""/>
            </div>
            <div class="form-group col-md-6 parent">
                <label for="confirmpass">
                    Nhập lại mật khẩu
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <input type="password" name="confirmpass" class="form-control" placeholder="Nhập lại mật khẩu" required=""/>
            </div>
            <div class="form-group col-md-6 parent">
                <label for="email">
                    Email:
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <input type="email" name="email" class="form-control" placeholder="VD:abc@gmail.com" required=""/>
            </div>
            <div class="form-group col-md-6 parent">
                <label for="confirmemail">
                    Nhập lại Email:
                </label><span class="text-danger">*</span><span class="error-place"></span>
                <input type="email" name="confirmemail" class="form-control" placeholder="Nhập lại Email" required=""/>
            </div>
            <div class="form-group col-md-12 parent">
                <label for="dienthoai">
                    Điện thoại:
                </label><span class="error-place"></span>
                <input type="number" name="dienthoai" class="form-control" placeholder="VD:01224545275"/>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" name="dangky" class="btn btn-primary">Đăng ký</button>
            </div>
        </div>
    </form>     
</div>
<script type="text/javascript">
    $(document).ready(function () {
        /* login */
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#form-signin").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: '{{base_url()}}index/checkEmail'
                },
                username: {
                    required: true,
                    remote: '{{base_url()}}index/checkUsername'
                },
                confirmemail: {
                    equalTo: "#form-signin input[name=email]"
                },
                confirmpass: {
                    equalTo: "#form-signin input[name=password]"
                }
            },
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