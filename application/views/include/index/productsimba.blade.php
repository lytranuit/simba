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
                            <div class="col-lg-6 row justify-content-center align-items-center">
                                <div class="col-6">
                                    <img class="img-fluid"src="http://www.oishii.vn{{$tin['image_url']}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <span style="font-size: 1.5rem">{{lang('product_tomtat')}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">{{lang('product_code')}}:</label>
                                        <span>{{$tin['code']}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">{{lang('product_xuatxu')}}:</label>
                                        <span>Nhật bản</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">{{lang('product_dungtich')}}:</label>
                                        <span>{{$tin['volume']}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">{{lang('product_baoquan')}}:</label>
                                        <span>Bảo quản nhiệt độ phòng</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4">{{lang('product_mota')}}:</label>
                                        <span>{{$tin[pick_language($tin,'description_')]}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="fr-view">
                            <?= $tin[pick_language($tin, 'guide_')] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>