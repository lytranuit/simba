<div class="row" id="tin-details">
    <div class="col-md-12">
        <h2 class="title">
            {{$tin['title']}} -
            <span class="author">
                {{$tin['author']}}
            </span>
            <div class="pull-right">
                <span class="fromdate">
                    {{$tin['date']}}
                </span>
            </div>
        </h2>
    </div>
    <div class="content col-md-12">
        <div class="fr-view">
            <?php echo $tin['content']; ?>
        </div>
    </div>
    <hr class="col-md-12">
    <div class="details col-md-12">
        <div class="col-md-12">
            <label>Địa chỉ:</label>
            <span>{{$tin['diachi']}}</span>
        </div>
        <div class="col-md-6">
            <label>Diện tích:</label>
            <span>{{number_format($tin['dientich'],0,'.'," ")}} m2</span>
        </div>
        <div class="col-md-6">
            <label>Giá:</label>
            <span class="text-danger">{{$tin['gia']}} VNĐ</span>
        </div>
        <div class="col-md-3">
            <label>Chiều dài:</label>
            <span>{{number_format($tin['chieudai'],0,'.'," ")}} m</span>
        </div>
        <div class="col-md-3">
            <label>Chiều rộng:</label>
            <span>{{number_format($tin['chieurong'],0,'.'," ")}} m</span>
        </div>
        <div class="col-md-3">
            <label>Hướng:</label>
            <span>{{$tin['huong']}}</span>
        </div>
        <div class="col-md-3">
            <label>Tình trạng pháp lý:</label>
            <span>{{$tin['phaply']}}</span>
        </div>
    </div>
    <hr class="col-md-12">
    <div class="col-md-12 property-detail-flexslider">
        <div class="flexslider">
            <ul class="slides">
                @foreach($tin['arr_hinhanh'] as $row)
                <li data-thumb="{{base_url() . $row['thumb_src']}}">
                    <a href="{{base_url() . $row['bg_src']}}" class="swipebox">
                        <img src="{{base_url() . $row['bg_src']}}" /> 
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Tin liên quan</h2>
        <?php echo $widget->tinlienquan(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        moment.updateLocale('en', {
            relativeTime: {
                future: "in %s",
                past: "%s trước",
                s: "giây",
                m: "1 phút",
                mm: "%d phút",
                h: "1 giờ",
                hh: "%d giờ",
                d: "1 ngày",
                dd: "%d ngày",
                M: "1 tháng",
                MM: "%d tháng",
                y: "1 năm",
                yy: "%d năm"
            }
        });
        var date = $(".fromdate").html();
        var ngay = moment(date).fromNow();
        $(".fromdate").html(ngay);
        eventSlider();
    });
    function eventSlider() {
        // SILDER OTHER
        var flexslider = $('.flexslider').flexslider({
            slideshow: true,
            animation: "slide",
            directionNav: true,
            controlNav: "thumbnails",
            start: function (slider) {
                slider.resize();
                //eventDetail();
            }
        });
        $('.flex-control-nav').jcarousel({
            vertical: true,
            scroll: 1
        });
        /* SLIDER pgwslideshow*/
        //var pgwSlideshow;
        //var newConfig = {};
        //newConfig.autoSlide = true,
        //newConfig.transitionEffect = 'fiding';
        ///* END SLIDER pgwslideshow*/
        //if ($('.pgwSlideshow').length > 0) {
        //    pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
        //    newConfig.maxHeight = 550;
        //    pgwSlideshow.reload(newConfig);
        //    $('.ps-current ul li a').addClass('swipebox');
        //}

        //if ($('.ps-list ul li').length < 2) {
        //    $('.ps-list').hide();
        //}



        /*-----------------------------------------------------------------------------------*/
        /* Swipe Box Lightbox
         /*-----------------------------------------------------------------------------------*/
        $('.clone .swipebox').removeClass('swipebox');
        $(".swipebox").swipebox(
                {
                    afterClose: function () {
                        //eventDetail();
                        if ($('.ps-list ul li').length < 2) {
                            $('.ps-list').hide();
                        }
                    }
                }
        );
    }
</script>