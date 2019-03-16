<?php
$hinh_preview = isset($tin->hinhanh->thumb_src) ? $tin->hinhanh->thumb_src : "public/img/preview.png";
?>

<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Sửa nhật ký</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Sửa nhật ký</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="col-md-4">
                            <b>1.Nhà cung cấp:</b>
                            <div class='fr-view'>
                                <?= $tin->ncc ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <b>2.Nhân sự tham gia</b>

                            <div class='fr-view'>
                                <?= $tin->nhansu ?>
                            </div>
                        </div>
                        <div  class="col-md-4" >
                            <b>3.Nhân sự công ty khác</b>
                            <div class='fr-view'>
                                <?= $tin->nhansukhac ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class='col-md-4'>
                                <div>
                                    <b>4.Khách hàng chính</b>
                                    @if(isset($tin->customers))
                                    @foreach($tin->customers as $row)
                                    <p>- {{$row->code ."-".$row->name}}</p>
                                    @endforeach
                                    @endif
                                </div>
                                <div>
                                    <b>5.Sản phẩm chính</b>
                                    @if(isset($tin->products))
                                    @foreach($tin->products as $row)
                                    <p>- {{$row->code ."-".$row->name_vi}}</p>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <b>6.Nội dung</b>
                                <div class='fr-view'>
                                    <?= $tin->content ?>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>