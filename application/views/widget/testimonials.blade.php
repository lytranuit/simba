@if(count($data))
<!--==========================
    Clients Section
    ============================-->
<section class="wow fadeInUp" id="testimonials">
    <div class="container">
        <!--        <header class="section-header">
                    <h3>
                        Testimonials
                    </h3>
                </header>-->
        <div class="owl-carousel testimonials-carousel">
            @foreach($data as $row)
            <div class="testimonial-item">
                <img alt="" class="testimonial-img" src="<?= base_url(); ?>{{$row['hinhanh']['thumb_src'] or 'public/img/preview.png'}}">
                <h3>
                    {{$row['name']}}
                </h3>
                <h4>
                    {{$row['position']}}
                </h4>
                <p>
                    <img alt="" class="quote-sign-left" src="<?= base_url(); ?>public/img/quote-sign-left.png">
                    {{$row['comment']}}
                    <img alt="" class="quote-sign-right" src="<?= base_url(); ?>public/img/quote-sign-right.png">
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- #testimonials -->
@endif