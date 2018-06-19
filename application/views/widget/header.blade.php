<!--==========================
    Header
    ============================-->
<header id="header">
    <div class="container">
        <div class="pull-left" id="logo">
            <a href="<?= base_url(); ?>">
                <img alt="" src="<?= base_url(); ?>public/img/logo.png" title=""/>
            </a>
        </div>
        <div class="pull-right hidden-md-down" style="margin: 5px;">
            <a class="button_login" data-target="#login-modal" data-toggle="modal" href="#">
                <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                    <?= lang('login_heading') ?>
                </span>
            </a>
            <div id="language" class="d-inline-block">
                <?php foreach ($language_list as $key => $lang): ?>
                    <a href="#" data='<?= $key ?>'>
                        <img src="<?= base_url(); ?>public/img/flag/<?= $lang ?>.png" />
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <a style="font-size: 12px" class="btn btn-light btn-outline-success btn-sm mt-2" href="https://itunes.apple.com/vn/app/simba-fresh/id1331294173" id="simba-app">
                <span class="fa fa-shopping-cart text-danger"></span>
                <span>
                    APP
                </span>
            </a>
            <a style="font-size: 12px" class="btn btn-light btn-outline-success btn-sm mt-2" href="http://www.oishii.vn/">
                <span class="fa fa-shopping-cart text-danger"></span>
                <span>
                    Website
                </span>
            </a>
        </div>
    </div>
</header>
<div id="menu" class="blue-grdt">
    <div class="container">
        <div clas="col-12">
            <nav id='nav-menu-container'>
                <ul class="nav-menu">
                    <li class="menu-active">
                        <a href="#intro">
                            <?= lang("Home") ?>
                        </a>
                    </li>
                    <li>
                        <a href="#about">
                            <?= lang("SIMBA") ?>
                        </a>
                    </li>
                    <li>
                        <a href="#news">
                            <?= lang("news") ?>
                        </a>
                    </li>
                    <li>
                        <a href="#news">
                            Thông tin nội bộ
                        </a>
                    </li>
                    <!--                <li class="menu-has-children">
                                        <a href="">
                                            Drop Down
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    Drop Down 1
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Drop Down 3
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Drop Down 4
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Drop Down 5
                                                </a>
                                            </li>
                                        </ul>
                                    </li>-->
                    <li>
                        <a href="#clients">
                            <?= lang("clients") ?>
                        </a>
                    </li>
                    <li>
                        <a href="#footer">
                            <?= lang("contact") ?>
                        </a>
                    </li>
                    <!--                <li>
                                        <a class="#" data-target="#login-modal" data-toggle="modal" href="#">
                                            <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                    <?= lang('login_heading') ?>
                                            </span>
                                        </a>
                                    </li>-->
                    <!--                    <li class="menu-has-children">
                                            <a href="#">
                    <?= $language_list[language_current()] ?>
                                            </a>
                                            <ul id="language">
                    <?php foreach ($language_list as $key => $lang): ?>
                                                                                        <li>
                                                                                            <a href="#" data='<?= $key ?>'>
                        <?= $lang ?>
                                                                                            </a>
                                                                                        </li>
                    <?php endforeach; ?>
                    
                                            </ul>
                                        </li>-->
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </div>
</div>
<!-- Login Modal-->
<div aria-hidden="true" aria-labelledby="login-modalLabel" class="modal fade" id="login-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login-modalLabel">
                    Login
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        x
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-login">
                    <div class="form-group">
                        <input class="form-control" id="email_modal" placeholder="username" type="text" name="identity">
                        </input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="password_modal" placeholder="password" type="password" name="password">
                        </input>
                    </div>
                    <p class="text-center">
                        <button class="btn btn-template-outlined" id="button_login">
                            <i class="fa fa-sign-in">
                            </i>
                            Log in
                        </button>
                    </p>
                </form>
                <p class="text-center text-muted">
                    <a href="customer-register.html">
                        <strong>
                            
                        </strong>
                    </a>
                   Bạn chưa có tài khoản đăng nhập! Vui lòng liên hệ Oishii.vn
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Login modal end-->