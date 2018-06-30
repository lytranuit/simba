<!--==========================
    Clients Section
    ============================-->
<section class="wow fadeInUp" id="clients">
    <div class="container">
        <header class="section-header">
            <h3>
                {{lang("Clients")}}
            </h3>
        </header>
        <div class="owl-carousel clients-carousel">
            @foreach($data as $row)
            <a href="{{$row['link']}}">
                <img alt="" src="{{base_url()}}{{$row['hinhanh']['src'] or 'public/img/preview.png'}}">
            </a>
            @endforeach
        </div>
    </div>
</section>
<!-- #clients -->