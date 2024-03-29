<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Thêm loại</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Thêm loại</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin">
                        <div class="col-md-3">
                            <div class="form-group form-float">
                                <b class="form-label">Tên Tiếng Việt (*):</b>
                                <div class="form-line">
                                    <input type="text" name='name_vi' class="form-control" required="" aria-required="true">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-float">
                                <b class="form-label">Tên Tiếng Anh:</b>
                                <div class="form-line">
                                    <input type="text" name='name_en' class="form-control" aria-required="true">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="form-group form-float">
                                <b class="form-label">Tên Tiếng Nhật:</b>
                                <div class="form-line">
                                    <input type="text" name='name_jp' class="form-control" aria-required="true">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"> 
                            <b class="form-label">Màu:</b>
                            <div class="input-group colorpicker">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="color" value="#000000">
                                </div>
                                <span class="input-group-addon">
                                    <i></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-12" style="padding-left:0;">
                                <button type="submit" name="dangtin" class="btn btn-primary">Thêm loại</button>
                            </div>
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