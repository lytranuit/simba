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
                                <div class="col-sm-6 col-8">
                                    <a class="fancybox" href="{{base_url()}}{{$tin['hinhanh']['src'] or 'public/img/intro-carousel/san pham.png'}}"><img class="img-fluid"src="{{base_url()}}{{$tin['hinhanh']['src'] or 'public/img/intro-carousel/san pham.png'}}" /></a>
                                    <p class="text-center">View full size</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <span style="font-size: 1.5rem">{{lang('product_tomtat')}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4 col-6">{{lang('product_code')}}:</label>
                                        <span>{{$tin['product']['code']}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4 col-6">{{lang('product_xuatxu')}}:</label>
                                        <span>{{$tin['product']['country'][pick_language($tin['product']['country'],'name_')]}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4 col-6">{{lang('product_dungtich')}}:</label>
                                        <span>{{$tin['product']['volume']}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4 col-6">{{lang('product_baoquan')}}:</label>
                                        <span>{{$tin['product']['preservation'][pick_language($tin['product']['preservation'],'name_')]}}</span>
                                    </li>
                                    <li>
                                        <label class="col-md-4 col-6">{{lang('product_mota')}}:</label>
                                        <span>{{$tin['product'][pick_language($tin['product'],'description_')]}}</span>
                                    </li>
                                    @if(count($tin['files']))
                                    <li>
                                        <label class="col-md-4 col-6">{{lang('product_file')}}:</label>
                                        <div>
                                            @foreach($tin['files'] as $row)
                                            <a href="#" class="files d-block mt-1" data='{{$row['id_hinhanh']}}'>
                                                <i class="file-icon" data-type="<?= pathinfo($row['real_hinhanh'], PATHINFO_EXTENSION); ?>"></i>
                                                {{$row['real_hinhanh']}}
                                            </a>
                                            @endforeach
                                        </div>
                                    </li>
                                    @endif
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