<div class="blog">
    <div class="blog-item">
        
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
                    <?php echo $tin['content']; ?>
                </div>
            </div>
        </div>
    </div><!--/.blog-item-->
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
    });
</script>