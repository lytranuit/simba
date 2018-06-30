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
            <?php if ($is_login): ?> 
                <a class="button_login logged" href="<?= base_url() ?>admin" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                        <?= $userdata['identity'] ?>
                    </span>
                </a>
            <?php else: ?>
                <a class="button_login" data-target="#login-modal" data-toggle="modal" id="navbarDropdownMenuLink" href="#" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                        <?= lang('login_heading') ?>
                    </span>
                </a>
            <?php endif; ?>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size: 0.9rem;">
                <a class="dropdown-item" href="<?= base_url() ?>admin">{{lang("info")}}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item logout" href="<?= base_url() ?>index/logout">{{lang("logout")}}</a>
            </div>
            <div id="language" class="d-inline-block">
                <?php foreach ($language_list as $key => $lang): ?>
                    <a href="#" data='<?= $key ?>'>
                        <img src="<?= base_url(); ?>public/img/flag/<?= $lang ?>.png" />
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="hidden-sm-down">
            <a style="font-size: 12px" class="btn btn-light btn-outline-success btn-sm mt-2" href="https://itunes.apple.com/vn/app/simba-fresh/id1331294173" id="simba-app">
                <span class="fa fa-shopping-cart text-danger"></span>
                <span>
                    App SimBa Fresh
                </span>
            </a>
            <a style="font-size: 12px" class="btn btn-light btn-outline-success btn-sm mt-2" href="http://www.oishii.vn/" id="oishii-web">
                <span class="fa fa-shopping-cart text-danger"></span>
                <span>
                    SimBa Shop Oishii
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
                    @foreach($menu as $row)
                    <li>
                        <a href="<?= base_url() . $row['link'] ?>">
                            <?= $row[pick_language($row, 'text_')] ?>
                        </a>
                    </li>
                    @endforeach

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