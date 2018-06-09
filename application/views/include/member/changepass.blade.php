<form name="form" id="form-edit-user" action="{{base_url()}}member/change_pass" class=""method="POST">
    <h2 class='text-center text-danger'>
        THAY ĐỔI MẬT KHẨU
    </h2>
    <div class="col-md-12">
        @if($success != '')
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#">×</a>{{$success}}
        </div>
        @endif
        <div class="form-group col-md-12 parent">
            <label for="passwordold">
                Mật khẩu cũ:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="password" name="passwordold" class="form-control" placeholder="Mật khẩu cũ" required=""/>
        </div>
        <div class="form-group col-md-12 parent">
            <label for="password">
                Mật khẩu mới:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="password" name="password" class="form-control" minlength="8"  placeholder="Ít nhất 8 kí tự" required=""/>
        </div>
        <div class="form-group col-md-12 parent">
            <label for="confirmpass">
                Nhập lại mật khẩu mới:
            </label><span class="text-danger">*</span><span class="error-place"></span>
            <input type="password" name="confirmpass" class="form-control" placeholder="Nhập lại mật khẩu" required=""/>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" name="change_pass" class="btn btn-primary">Thay đổi</button>
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
        $("#form-edit-user").validate({rules: {
                passwordold: {
                    required: true,
                    remote: {
                        url: '{{base_url()}}index/checkUserpass',
                        data: {
                            id: '{{$id_user}}'
                        },
                        type: "post"
                    }
                },
                confirmpass: {
                    equalTo: "#form-edit-user input[name=password]"
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