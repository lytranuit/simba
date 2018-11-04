
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="header">
                        <h2>{{$tin[pick_language($tin,'name_')]}}</h2>
                    </div>
                    <div class="body">
                        <div class="fr-view">
                            <?= $tin[pick_language($tin, 'content_')] ?>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="card card-style1 mb-3">
                    <div class="card-header">{{lang('heading_product')}}</div>
                    <div class="card-body row">
                        @if(count($tin['products']))
                        @if(!$is_login && $tin['products'][0]['require_year_old'] == 1)
                        <div class="offline_sale" style="margin: 50px auto;"><span class="os_contact">Liên hệ</span><span class="os_phone">Hotline miễn phí 18009469</span></div>

                        @else
                        @foreach($tin['products'] as $row)
                        @if($row['status'] == 1)
                        <a class="col-md-3 col-6 text-center hover_product" href="<?= get_url_seo('index/productsimba', array($row['id'], sluggable($row[pick_language($row, 'name_')]))) ?>" style="color: black;">
                            <img class="img-fluid" src="http://www.oishii.vn{{$row['image_url']}}" alt="Card image cap" style="max-height: 180px;"> 
                            <div class="">
                                <b>{{$row['code']}}</b>
                                <p>{{$row[pick_language($row,'name_')]}}</p>
                            </div>
                        </a>
                        @endif
                        @endforeach
                        @endif
                        @endif
                        <div class="col-12 d-none">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" style="font-size:14px;">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>