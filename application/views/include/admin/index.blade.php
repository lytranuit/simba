
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Thông tin cá nhân</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Thông tin cá nhân</h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation" method="POST" novalidate="novalidate">
                    <div class="form-group">
                        <b class="form-label">Username:</b>
                        <div class="form-line">
                            <input type="text" class="form-control" value="{{$user->username}}" name="username" required="" aria-required="true" readonly="">
                        </div>
                        <div class="help-info"></div>
                    </div>
                    <div class="form-group">
                        <b class="form-label">Tên</b>
                        <div class="form-line">
                            <input type="text" class="form-control" value="{{$user->fullname}}" name="fullname" minlength="3" required="" aria-required="true">
                        </div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <a href="#" data-target="#password-modal" data-toggle="modal"> 
                            <i class="material-icons" style='font-size: 20px;vertical-align: middle;'>lock</i>
                            <span>Thay đổi mật khẩu</span> 
                        </a>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit" name="edit_user">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- THAY DOI MAT KHAU Modal-->
<div aria-hidden="true" aria-labelledby="password-modalLabel" class="modal fade" id="password-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="comment-modalLabel">
                    Thay đổi mật khẩu
                </h4>
            </div>
            <div class="modal-body">
                <div class="main">
                    <!--<p>Sign up once and watch any of our free demos.</p>-->
                    <form id="form-password">
                        <div class="form-group">
                            <b class="form-label">Mật khẩu cũ:</b>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" required="" aria-required="true">
                            </div>
                            <div class="help-info"></div>
                        </div>
                        <div class="form-group">
                            <b class="form-label">Mât khẩu mới</b>
                            <div class="form-line">
                                <input type="password" class="form-control" name="newpassword" minlength="6" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <b class="form-label">Xác nhận mật khẩu mới</b>
                            <div class="form-line">
                                <input type="password" class="form-control" name="confirmpassword" minlength="6" required="" aria-required="true">
                            </div>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit" name="edit_password">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("button[name='edit_password']").click(function (e) {
            e.preventDefault();
            $.ajax({
                url: path + "admin/changepass",
                data: $("#form-password").serialize(),
                dataType: "JSON",
                type: "POST",
                success: function (data) {
                    alert(data.msg);
                    if (data.code == 400) {
                        location.reload();
                    }
                }
            });
            return false;
        });
    })
</script>