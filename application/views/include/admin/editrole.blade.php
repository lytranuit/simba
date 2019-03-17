<?php
$arr_permission = $tin['permission'] ? array_keys($tin['permission']) : array();
?>
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Role</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sửa Role</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <b class="form-label">Tên:</b>
                                <div class="form-line">
                                    <input type="text" name='name' class="form-control" required="" aria-required="true">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <b class="form-label">Group mail:</b>
                                <div class="form-line">
                                    <input type="text" name='email' class="form-control" required="" aria-required="true">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                        </div>
                        @if($tin['id'] != 1)
                        @foreach($permission as $key=>$row)
                        <div class="col-md-12">
                            <div class="col-md-2">
                                {{$row['module_alias']}}
                            </div>
                            @foreach($row['child'] as $key1=>$row1)
                            <div class="col-md-2">
                                <input type="checkbox" id="md_checkbox_{{$key}}_{{$key1}}" class="filled-in chk-col-blue" name="permission[]" value="{{$row1['id']}}" <?= in_array($row1['id'], $arr_permission) ? "checked" : "" ?>>
                                <label for="md_checkbox_{{$key}}_{{$key1}}">{{$row1['function_alias']}}</label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                        @endif
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