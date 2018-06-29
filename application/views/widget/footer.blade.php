
<!--==========================
Footer
============================-->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>
                        <?= lang('USEFUL_LINKS') ?>
                    </h4>
                    <ul>
                        <li>
                            <i class="ion-ios-arrow-right">
                            </i>
                            <a href="{{base_url()}}">
                                Trang chủ
                            </a>
                        </li>
                        @foreach($lienket as $row)
                        <li>
                            <i class="ion-ios-arrow-right">
                            </i>
                            <a href="<?= get_url_seo("index/page", array($row['id'], sluggable($row[pick_language($row, 'title_')]))) ?>">
                                {{$row[pick_language($row, 'title_')]}}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>
                        <?= lang('CONTACT_US') ?>
                    </h4>
                    <p>
                        <i class="ion-ios-location-outline">
                        </i>
                        R1-08-03, Tòa nhà Everich, số 968 Ba Tháng Hai,
                        Phường 15, Quận 11, Thành phố Hồ Chí Minh
                        <br>
                        <i class="ion-ios-telephone-outline">
                        </i>
                        18009469
                        <br>
                        <i class="ion-ios-email-outline">
                        </i>
                        info@simba.com.vn
                    </p>
                    <div class="social-links">
                        <a class="facebook" href="#">
                            <i class="fa fa-facebook">
                            </i>
                        </a>
                        <a class="twitter" href="#">
                            <i class="fa fa-twitter">
                            </i>
                        </a>
                        <a class="instagram" href="#">
                            <i class="fa fa-instagram">
                            </i>
                        </a>
                        <a class="google-plus" href="#">
                            <i class="fa fa-google-plus">
                            </i>
                        </a>
                        <a class="linkedin" href="#">
                            <i class="fa fa-linkedin">
                            </i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 footer-newsletter" id="contact">
                    <h4>
                        <?= lang('OUR_NEWSLETTER') ?>
                    </h4>
                    <div class="form">
                        <div id="errormessage">
                        </div>
                        <form id="contactForm">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <input class="form-control" id="name" name="name" required="" placeholder="<?= lang('Your_Name') ?>" type="text"/>
                                    <div class="validation">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <input class="form-control" id="sdt" name="phone" required="" placeholder="<?= lang('Your_Phone') ?>" type="tel"/>
                                    <div class="validation">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="form-control" id="email" name="email" required="" placeholder="<?= lang('Your_Email') ?>" type="email"/>
                                    <div class="validation">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control"  name="content" required=""  placeholder="<?= lang('Message') ?>" rows="5"></textarea>
                                <div class="validation">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button id="send_message"class="btn btn-success btn-sm" name="submit" type="submit">
                                        <?= lang('Send_Message') ?>
                                    </button>
                                    <a class="btn btn-secondary btn-sm" href="#" data-target="#comment-modal" data-toggle="modal">
                                        <?= lang('text_gop_y') ?>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <?= $scriptCap ?>
                                    <?= $captcha ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="copyright col-lg-9 col-sm-12">© Copyright 2018 www.simba.com.vn, All rights reserved.<br>
                    + Tên công ty: Công ty TNHH Thương Mại Sim Ba<br>
                    + Địa chỉ: R1-08-03, Tòa nhà Everich, số 968 Ba Tháng Hai, Phường 15, Quận 11, Thành phố Hồ Chí Minh<br>
                    + Email liên hệ: info@simba.com.vn<br>
                    + MST: 0303582244
                </div>
                <div class="col-lg-3 col-sm-12">
                    <a href=" http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=27522" target="_blank" class="bocongthuong">
                        <p>Chứng nhận SGD TMĐT</p>
                        <img src="http://www.oishii.vn/img/bct.png" alt="TMĐT">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Comment Modal-->
<div aria-hidden="true" aria-labelledby="comment-modalLabel" class="modal fade" id="comment-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comment-modalLabel">
                    <?= lang('OUR_NEWSLETTER') ?>
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        x
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="main">
                    <!--<p>Sign up once and watch any of our free demos.</p>-->
                    <form class="" method="post" action="#">
                        <div class="wrap-input100 validate-input">
                            <input class="input100" id="name1" type="text" name="name" placeholder="Tên">
                            <label class="label-input100" for="name">
                                <span class="fa fa-user"></span>
                            </label>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" id="customer" type="text" name="customer" placeholder="Khách hàng">
                            <label class="label-input100" for="name">
                                <span class="fa fa-envelope"></span>
                            </label>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" id="product" type="text" name="product" placeholder="Sản phẩm">
                            <label class="label-input100" for="name">
                                <span class="fa fa-phone"></span>
                            </label>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <textarea class="input100" name="message" placeholder="Nội dung..."></textarea>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm">
                                <?= lang('Send_Message') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #footer -->
<a class="back-to-top" href="#">
    <i class="fa fa-chevron-up">
    </i>
</a>