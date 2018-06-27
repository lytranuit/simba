<!--==========================
    About Us Section
    ============================-->
<section id="about">
    <div class="container">
        <header class="section-header">
            <h3>
                <?= lang('SIMBA') ?>
            </h3>
        </header>
        <div class="row mt-5">
            <div class="col-md-6">
                <img class="img-fluid" src="{{base_url()}}{{$arr_about[0]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}">
            </div>
            <div class="col-md-6 fr-view">
                <?= $arr_about[0]->content ?>
            </div>
        </div>
        <div style="height: 60px;"></div>
        @if(count($arr_about) > 1) 
        <div class="row about-cols">
            <div class="col-lg-12">
                <ul class="timeline">
                    @for($i = 1; $i < count($arr_about);$i++)
                    <li class="<?= $i % 2 ? "" : "timeline-inverted" ?>">
                        <div class="timeline-image">
                            <img style="width: 100%;height: 100%" src="{{base_url()}}{{$arr_about[$i]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}">
                        </div>
                        <div class="timeline-panel fr-view">
                            <?= $arr_about[$i]->content ?>
                        </div>
                    </li>
                    @endfor
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endif
    </div>
</section>