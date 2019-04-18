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
                            <div class='fr-view'style="white-space: pre"><?= isset($tin->nccObject) ? $tin->nccObject->code . "-" . $tin->nccObject->short_name : "" ?> <?= $tin->ncc ?></div>
                        </div>
                        <div class="col-md-4">
                            <b>2.Nhân sự tham gia</b>
                            <div class='fr-view' style="white-space: pre"><?= $tin->nhansu ?></div>
                        </div>
                        <div  class="col-md-4" >
                            <b>3.Nhân sự công ty khác</b>
                            <div class='fr-view' style="white-space: pre"><?= $tin->nhansukhac ?></div>
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

                                <div class='fr-view' style="white-space: pre"><?= $tin->new_customer ?></div>
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
                                <div class='fr-view' style="white-space: pre"><?= $tin->new_product ?></div>
                            </div>
                        </div>

                        <div class="" style="clear: both;">
                        </div>
                        <div class="col-md-4">
                            <div>
                                <b>6.Thời gian bắt đầu</b>
                                <div class='fr-view'>
                                    <?= date("Y-m-d H:i:s", $tin->date) ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <b>7.Thời gian kết thúc</b>
                                <div class='fr-view'>
                                    <?= date("Y-m-d H:i:s", $tin->date_end) ?>
                                </div>
                            </div>
                        </div>
                        <div class="" style="clear: both;">
                        </div>
                        <div class="col-md-4">
                            <div>
                                <b>8.Chia sẻ thông tin</b>
                                <div class='fr-view'>
                                    <?php
                                    $emails = explode(",", $tin->email_send);
                                    foreach ($emails as $row):
                                        echo "- <a href='#'>$row</a> <br>";
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <b>9.Tiêu đề báo cáo</b>
                                <div class='fr-view' style="white-space: pre"><?= $tin->subject ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <b>10.Nội dung</b>
                            <div class='fr-view' style="white-space: pre"><?= $tin->content ?></div>
                        </div>

                        <div class="col-md-12">
                            <b>11.File đính kèm</b>
                            <div>
                                @if(!empty($tin->files))
                                @foreach($tin->files as $row)
                                @if(strpos($row->type,'image') === FALSE)
                                <div>
                                    <a href="{{base_url()}}{{$row->src}}" class="files d-block mt-1" data='{{$row->id_hinhanh}}'>
                                        <i class="file-icon" data-type="<?= pathinfo($row->real_hinhanh, PATHINFO_EXTENSION); ?>"></i>
                                        {{$row->real_hinhanh}}
                                    </a>
                                </div>
                                @else
                                <!--                                <div>
                                                                    <img class='img-responsive' src="{{base_url()}}{{$row->src}}" />
                                                                </div>-->
                                <div>
                                    <a href="{{base_url()}}{{$row->src}}" class="files d-block mt-1" data='{{$row->id_hinhanh}}'>
                                        {{$row->real_hinhanh}}
                                    </a>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <b class="text-danger">12.Lưu ý đặc biệt</b>
                                <div class='fr-view' style="white-space: pre"><?= $tin->note ?></div>
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