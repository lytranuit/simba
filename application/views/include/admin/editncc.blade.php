
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
                            <b class="col-md-3">{{lang("ma_ncc")}}:</b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("ma_ncc")}}" name="code"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("ten_ncc")}}:<span class="text-danger">*</span></b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("ten_ncc")}}" required name="name"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("diachi_ncc")}}:</b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("diachi_ncc")}}" name="address"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("dienthoai_ncc")}}:</b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("dienthoai_ncc")}}" name="phone"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("fax_ncc")}}:</b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("fax_ncc")}}" name="fax"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("email_ncc")}}:</b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("email_ncc")}}" name="email" type="email"/>
                            </div>
                        </div>
                        <div class="row py-1">
                            <b class="col-md-3">{{lang("nlh_ncc")}}:</b>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="{{lang("nlh_ncc")}}" name="note"/>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0;">
                            <button type="submit" name="dangtin" class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        var tin = <?= json_encode($tin) ?>;
        $.AdminBSB.function.fillForm($("#form-dang-tin"), tin);
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