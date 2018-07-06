
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">User</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Thêm user</h2>
            </div>
            <div class="body">

                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="form-group">
                            <b class="form-label">Username:</b>
                            <div class="form-line">
                                <input type="text" class="form-control" value="" name="username" required="">
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
                        <!--                        <div style="margin-bottom: 20px;">
                                                    <a href="#" data-target="#password-modal" data-toggle="modal"> 
                                                        <i class="material-icons" style='font-size: 20px;vertical-align: middle;'>lock</i>
                                                        <span>Thay đổi mật khẩu</span> 
                                                    </a>
                                                </div>-->
                        <input type="hidden" name="dangtin" value="1">
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name='dangtin1' class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("select[name=role]").chosen();
        $("button[name='dangtin1']").click(function (e) {
            e.preventDefault();
            var username = $("input[name=username]").val();
            $.ajax({
                url: path + "admin/checkusername",
                data: {username: username},
                dataType: "JSON",
                success: function (data) {
                    if (data.success == 1) {
                        $("#form-dang-tin")[0].submit();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });

    })
</script>