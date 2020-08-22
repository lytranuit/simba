<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">User</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sửa user</h2>
            </div>
            <div class="body">

                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="form-group">
                            <b class="form-label">Username:</b>
                            <div class="form-line">
                                <input type="text" class="form-control" value="" name="username" required="" readonly="">
                            </div>
                            <div class="help-info"></div>
                        </div>
                        <div class="form-group">
                            <b class="form-label">Tên</b>
                            <div class="form-line">
                                <input type="text" class="form-control" value="" name="fullname" minlength="3" required="">
                            </div>
                        </div>

                        <div class="form-group">

                            <input type="hidden" class="input-tmp" name="active" value="0">
                            <input type="checkbox" id="basic_checkbox_2" class="filled-in" checked="" name="active" value="1">
                            <label for="basic_checkbox_2">Active</label>
                        </div>
                        <div class="form-group col-md-12 row">
                            <b class="form-label col-md-2">Role</b>
                            <div class='col-md-4'>
                                <select name="role" style="width: 200px;">
                                    @foreach($role as $row)
                                    <option value="{{$row['id']}}">{{$row['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <a href="#" data-target="#password-modal" data-toggle="modal">
                                <i class="material-icons" style='font-size: 20px;vertical-align: middle;'>lock</i>
                                <span>Thay đổi mật khẩu</span>
                            </a>
                        </div>
                        <input type="hidden" name="dangtin" value="1">
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name='dangtin1' class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
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
                        <input type="hidden" name="id_user" value="{{$tin->id}}" />
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
    $(document).ready(function() {
        var tin = <?= json_encode($tin) ?>;
        $.AdminBSB.function.fillForm($("#form-dang-tin"), tin);
        $("select[name=role]").chosen();
        $("button[name='edit_password']").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: path + "admin/changepasswithout",
                data: $("#form-password").serialize(),
                dataType: "JSON",
                type: "POST",
                success: function(data) {
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