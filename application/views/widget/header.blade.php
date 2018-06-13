<!--==========================
    Header
    ============================-->
<header id="header">
    <div class="container-fluid">
        <div class="pull-left" id="logo">
            <a href="#intro">
                <img alt="" src="<?= base_url(); ?>public/img/logo.png" title=""/>
            </a>
        </div>
        <nav id="nav-menu-container">
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
                <li>
                    <a class="#" data-target="#login-modal" data-toggle="modal" href="#">
                        <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                            <?= lang('login_heading') ?>
                        </span>
                    </a>
                </li>
                <li class="menu-has-children">
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
                </li>
            </ul>
        </nav>
        <!-- #nav-menu-container -->
    </div>
</header>

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
                <form action="customer-orders.html" method="get">
                    <div class="form-group">
                        <input class="form-control" id="email_modal" placeholder="email" type="text">
                        </input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="password_modal" placeholder="password" type="password">
                        </input>
                    </div>
                    <p class="text-center">
                        <button class="btn btn-template-outlined">
                            <i class="fa fa-sign-in">
                            </i>
                            Log in
                        </button>
                    </p>
                </form>
                <p class="text-center text-muted">
                    Not registered yet?
                </p>
                <p class="text-center text-muted">
                    <a href="customer-register.html">
                        <strong>
                            Register now
                        </strong>
                    </a>
                    ! It is easy and done in 1 minute and gives you access to special discounts and much more!
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Login modal end-->