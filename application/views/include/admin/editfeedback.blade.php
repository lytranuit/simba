<?php
$hinh_preview = isset($tin->hinhanh->thumb_src) ? $tin->hinhanh->thumb_src : "public/img/preview.png";
?>

<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Sửa tin tức</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sửa tin tức</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="col-md-12">
                            <b>Tên người góp ý:</b>
                            <input class="form-control" id="name1" type="text" name="name" placeholder="Tên người góp ý" required="">
                        </div>
                        <div class="col-md-12">
                            <b>Khách hàng</b>
                            <select id="select_customer" name="customer_id" class="form-control">
                                <option value="0">Chọn khách hàng </option>
                                @foreach($customers as $row)
                                <option value="{{$row['id']}}">{{$row['code']}} - {{$row['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <b>Sản phẩm</b>
                            <select id="select_product" name="product_id" class="form-control">
                                <option value="0">Chọn Sản phẩm</option>
                                @foreach($products as $row)
                                <option value="{{$row['id']}}">{{$row['code']}} - {{$row['name_vi']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="col-md-12" >
                            <b>Khách hàng</b>
                            <textarea class="form-control" name="content" placeholder="Nội dung góp ý của khách hàng về sản phẩm" required=""></textarea>
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
        $("#select_product").chosen({width: "100%"});
        $("#select_customer").chosen({width: "100%"});
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