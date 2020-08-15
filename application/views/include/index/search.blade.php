<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="header">
                        <h2>{{lang('search_heading')}}</h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            @if(!empty($product))
                            @foreach($product as $row)
                            <a class="col-md-3 col-6 text-center hover_product" href="<?= get_url_seo('index/productsimba', array($row['id'], sluggable($row[pick_language($row, 'name_')]))) ?>" style="color: black;">
                                <img class="img-fluid" src="http://www.simbaeshop.com{{$row['image_url']}}" alt="Card image cap" style="max-height: 180px;"> 
                                <div class="">
                                    <b>{{$row['code']}}</b>
                                    <p>{{$row[pick_language($row,'name_')]}}</p>
                                </div>
                            </a>
                            @endforeach
                            @else
                            <div class="col-12 text-center">
                                {{lang('no_data')}}
                            </div>
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
</div>