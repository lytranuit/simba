<!--==========================
     Portfolio Section
     ============================-->
<section class="" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-12 portfolio-container owl-carousel category-carousel" data-wow-delay="0.5s">
                @foreach($data as $key => $row)
                <figure class="portfolio-item filter-app">
                    <a href="<?= get_url_seo('index/category', array($row['id'], sluggable($row[pick_language($row, 'name_')]))) ?>">
                        <img alt="" class="img-fluid" src="{{base_url()}}{{$row['hinhanh']['src'] or 'public/img/preview.png'}}">
                        <figcaption class="figure-caption">{{$row[pick_language($row,'name_')]}}</figcaption>
                        <div class="figure-icon style<?= $key < 10 ? $key + 1 : $key - 9 ?>">
                            <button>
                                <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                    </a>
                </figure>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- #portfolio -->