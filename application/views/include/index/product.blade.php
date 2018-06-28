<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="header">
                        <h2>{{$tin[pick_language($tin,'name_')]}}</h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 row justify-content-center">
                                <div class="col-6">
                                    <img class="img-fluid"src="{{base_url()}}{{$tin['hinhanh']['src'] or 'public/img/product/1.jpg'}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <span style="font-size: 1.5rem">Chi Tiết</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">Mã hàng:</label>
                                        <span>{{$tin['product']['code']}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">Xuất Xứ:</label>
                                        <span>Nhật bản</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">Dung tích/Trọng lượng:</label>
                                        <span>{{$tin['product']['volume']}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">Bảo quản:</label>
                                        <span>Bảo quản nhiệt độ phòng </span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">Mô tả:</label>
                                        <span>{{$tin['product'][pick_language($tin['product'],'description_')]}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">File đính kèm:</label>
                                        <div>
                                            @foreach($tin['files'] as $row)
                                            <a href="#" class="need_login d-block">
                                                <i class="file-icon" data-type="<?= pathinfo($row['real_hinhanh'], PATHINFO_EXTENSION); ?>"></i>
                                                {{$row['ten_hinhanh']}}
                                            </a>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="fr-view">
                            <?= $tin[pick_language($tin, 'content_')] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>