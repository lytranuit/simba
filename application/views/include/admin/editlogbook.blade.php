<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Báo cáo</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Báo cáo</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin" class="col-md-12">
                        <div class="col-md-12">
                            <b>Tình trạng:</b>
                            <select name="status" style="padding: 5px 10px;margin-left: 10px;border-radius: 5px;">
                                <option value="0">Chưa xử lý</option>
                                <option value="1">Đã xử lý</option>
                            </select>
                        </div>
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
                        <div class="" style="clear: both;">
                        </div>
                        <div class='col-md-4'>
                            <div>
                                <b>4.Khách hàng chính</b>
                                @if(isset($tin->customers))
                                @foreach($tin->customers as $row)
                                <p>- {{$row->code ."-".$row->name}}</p>
                                @endforeach
                                @endif

                                <div class='fr-view'>
                                    <?= $tin->new_customer ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <b>5.Sản phẩm chính</b>
                                @if(isset($tin->products))
                                @foreach($tin->products as $row)
                                <p>- {{$row->code ."-".$row->name_vi}}</p>
                                @endforeach
                                @endif 
                                <div class='fr-view'>
                                    <?= $tin->new_product ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <b>7.Thời gian cuộc họp</b>
                                <div class='fr-view'>
                                    <?= date("Y-m-d H:i:s", $tin->date) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <b>8.Nội dung</b>
                            <div class='fr-view'>
                                <?= $tin->content ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <b class="text-danger">9.Lưu ý đặc biệt</b>
                                <div class='fr-view'>
                                    <?= $tin->note ?>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("[name='status']").change(function () {
            $("#form-dang-tin").submit();
        })
    })
</script>