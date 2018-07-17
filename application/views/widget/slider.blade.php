
<!--==========================
Intro Section
============================-->
<section id="intro">
    <div class="intro-container container">
        <div class="row">
            <div class="col-lg-8">
                <div class="carousel slide" id="introCarousel">
                    <ol class="carousel-indicators">
                    </ol>
                    <div class="carousel-inner" role="listbox" >
                        @foreach($list_silder as $key => $row)
                        <div class="carousel-item <?= $key == 0 ? "active" : "" ?>">
                            <div class="carousel-background">
                                <img alt="" src="<?= base_url() . $row['hinh']['slider_src']; ?>" width="100%"/>
                            </div>
                            <div class="carousel-container" >
                                “Hoàn thiện giá trị cuộc sống thông qua dinh dưỡng an toàn và có trách nhiệm”
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--            <div class="col-lg-4">
                            <div class="row justify-content-center">
                                <a target="_blank" href='http://www.oishii.vn/' alt="" style="background-image:url(<?= base_url() ?>public/img/intro-carousel/OISHII-1.jpg)" class="box-image" id="simba-web"></a>
                                <a target="_blank" href='https://itunes.apple.com/vn/app/simba-fresh/id1331294173' alt="" style="background-image:url(<?= base_url() ?>public/img/intro-carousel/FRESH-1.jpg);" class="box-image" id="simba-app"></a>
                                <a target="_blank" href='#'  alt="" style="background-image:url(<?= base_url() ?>public/img/intro-carousel/SAKE_ZONE-1.jpg)" class="box-image"></a>
                            </div>
                        </div>-->
            <div class="col-lg-4">
                <!-- Single Blog Post -->
                @foreach($list_tintuc as $key => $row)
                <div class="single-blog-post post-style-2 d-flex align-items-center">
                    @if($row['only_image'] != "1")
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <a href="<?= get_url_seo("index/news", array($row['id'], sluggable($row[pick_language($row, 'title_')]))) ?>" >
                            <img src="{{base_url()}}{{$row['hinhanh']['thumb_src'] or 'public/img/preview.png'}}" alt="">
                        </a>
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <a href="<?= get_url_seo("index/news", array($row['id'], sluggable($row[pick_language($row, 'title_')]))) ?>" class="headline">
                            <h5><?= mb_strlen($row[pick_language($row, 'title_')]) < 50 ? $row[pick_language($row, 'title_')] : mb_substr($row[pick_language($row, 'title_')], 0, 50) . "..."; ?></h5>
                        </a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <p>admin on {{date("F j, Y, g:i a",$row['date'])}}</p>
                        </div>
                    </div>
                    @else 
                    <a class='w-100 h-100' href="<?= get_url_seo("index/news", array($row['id'], sluggable($row[pick_language($row, 'title_')]))) ?>" >
                        <img src="{{base_url()}}{{$row['hinhanh']['src'] or 'public/img/preview.png'}}" alt="" class='w-100 h-100'>
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- #intro -->