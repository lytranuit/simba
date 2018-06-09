<div class="blog">
    <div class="title-news">
        <h2 class="title-hot">Tin tức</h2>
        <span class="span-hot"></span>
    </div>
    <div class="row">
        @foreach($arr_tin as $tin)
        <div class="blog-item col-md-12" data-url='{{get_url_seo("index/tintuc",array($tin['id_tintuc'],sluggable($tin['title'])))}}'>
            <!--            @if(count($tin['arr_hinhanh']))
                        <img class=" img-blog" src="{{base_url() . $tin['arr_hinhanh'][0]['bg_src']}}" width="100%" height="300" alt="" />
                        @endif-->
            <div class="row">  
                <div class="col-xs-12 col-sm-2 text-center">
                    <div class="entry-meta">
                        <span id="publish_date">{{date("F,d",strtotime($tin['date']))}}</span>
                        <span><i class="fa fa-user"></i> <a href="#">{{$tin['author']}}</a></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-10 blog-content">
                    <h2>{{$tin['title']}}</h2>
                    <div class="fr-view">
                        {{substr(strip_tags($tin['content']),0,500) . "..."}}
                    </div>
                    <div style="margin-top:10px;"><a class="btn btn-primary readmore" href="{{get_url_seo("index/tintuc",array($tin['id_tintuc'],sluggable($tin['title'])))}}">Read More <i class="fa fa-angle-right"></i></a></div>
                </div>
            </div>
        </div><!--/.blog-item-->

        @endforeach
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
    });

</script>