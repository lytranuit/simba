
<!--==========================
Footer
============================-->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>
                        <?= lang('Links') ?>
                    </h4>
                    <ul>
                        <li>
                            <i class="ion-ios-arrow-right">
                            </i>
                            <a href="{{base_url()}}">
                                <?= lang('Home') ?>
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
                        <?= lang('Contact') ?>
                    </h4>
                    <p>
                        <i class="ion-ios-location-outline">
                        </i>
                        {{lang("diachi")}}
                        <br>
                        <!-- <i class="ion-ios-telephone-outline">
                        </i>
                        {{$phone}}
                        <br> -->
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
                        <?= lang('Comment') ?>
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
                                <div class="col-md-6 mb-2">
                                    <button id="send_message"class="btn btn-success btn-sm" name="submit" type="submit">
                                        <?= lang('Send_Message') ?>
                                    </button>
                                    <a id="advanced_comment" class="btn btn-secondary btn-sm" href="#" data-target="#comment-modal" data-toggle="modal" role_feedback="{{$role_feedback}}">
                                        <?= lang('text_gop_y') ?>
                                    </a>
                                    <a id="logbook" class="btn btn-secondary btn-sm" href="{{base_url()}}index/formlogbook" target="_blank" role_feedback="{{$role_feedback}}">
                                        <?= lang('text_nhat_ky') ?>
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
                    + Tên công ty: Công Ty Cổ Phần Thương Mại Sim Ba<br>
                    + Địa chỉ: R1-08-03, Tòa nhà Everich, số 968 Ba Tháng Hai, Phường 15, Quận 11, Thành phố Hồ Chí Minh<br>
                    + MST: 0303582244
                </div>
                <div class="col-lg-3 col-sm-12">
                    <a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=52435" target="_blank" class="bocongthuong">
                        <p>Chứng nhận SGD TMĐT</p>
                        <img src="/public/img/bct.png" alt="TMĐT">
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
                    <?= lang('text_gop_y') ?>
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        x
                    </span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<!-- #footer -->


<!-- #footer -->
<a class="back-to-top" href="#">
    <i class="fa fa-chevron-up">
    </i>
</a>