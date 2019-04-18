
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Nhà cung cấp</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Nhà cung cấp</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="row py-1">
                            <b class="col-md-3">Code:</b>
                            <div class="col-md-9">
                                <input class="form-control" name="code"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Name:<span class="text-danger">*</span></b>
                            <div class="col-md-9">
                                <input class="form-control"  required name="name"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Short Name:</b>
                            <div class="col-md-9">
                                <input class="form-control" name="short_name"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Address:</b>
                            <div class="col-md-9">
                                <input class="form-control"  name="address"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Phone:</b>
                            <div class="col-md-9">
                                <input class="form-control"  name="phone"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Fax:</b>
                            <div class="col-md-9">
                                <input class="form-control" name="fax"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Email:</b>
                            <div class="col-md-9">
                                <input class="form-control" name="email" type="email"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Tax Code:</b>
                            <div class="col-md-9">
                                <input class="form-control" name="tax_code"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">Người liên hệ:</b>
                            <div class="col-md-9">
                                <input class="form-control" name="contact_people"/>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name="dangtin" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#form-dang-tin").validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                form.submit();
                return false;
            }
        });
    });
</script>