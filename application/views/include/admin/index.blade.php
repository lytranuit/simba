
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
                            <input type="text" class="form-control" name="username" maxlength="10" minlength="3" required="" aria-required="true">
                        </div>
                        <div class="help-info"></div>
                    </div>
                    <div class="form-group">
                        <b class="form-label">Name</b>
                        <div class="form-line">
                            <input type="text" class="form-control" name="fullname" maxlength="10" minlength="3" required="" aria-required="true">
                        </div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <a href="#"> 
                            <i class="material-icons" style='font-size: 20px;vertical-align: middle;'>lock</i>
                            <span>Thay đổi mật khẩu</span> 
                        </a>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>