<div class="page-loader-wrapper" style="display: none;">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!--==========================
    Header
    ============================-->
<header id="header">
    <div class="container">
        <div class="pull-right hidden-md-down mt-2">
            <?php if ($is_login): ?> 
                <a class="button_login logged" href="<?= base_url() ?>admin" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="{{$userdata['role']}}"data-name="{{$userdata['identity']}}">
                    <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                        <?= $userdata['identity'] ?>
                    </span>
                </a>
            <?php else: ?>
                <a class="button_login" data-target="#login-modal" data-toggle="modal" id="navbarDropdownMenuLink" href="<?= base_url() ?>admin" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-get-started" style="font-size: 0.8rem;padding: 5px 8px;margin: 0;">
                        <?= lang('login') ?>
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
        <div class="pull-left">
            <a href="<?= base_url(); ?>" id="logo">
                <img alt="" src="<?= base_url(); ?>public/img/logo.png" title=""/>
            </a>
            <div class="hidden-sm-down pull-left">
                <a target="_blank" style="font-size: 12px;margin-right: 5px;" class="btn btn-light btn-outline-success btn-sm mt-2" href="https://simbafresh.vn/" id="simba-app">
                    <span class="fa fa-shopping-cart text-danger"></span>
                    <span>
                        Simba Fresh Market
                    </span>
                </a>
                <a target="_blank" style="font-size: 12px" class="btn btn-light btn-outline-success btn-sm mt-2" href="https://www.simbaeshop.com/" id="oishii-web">
                    <span class="fa fa-shopping-cart text-danger"></span>
                    <span>
                        Simba E-shop
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
                    <!-- <li class="pull-right dropdown hidden-md-down"> 
                        <a href="#" class="toggle-search">
                            <i class="fa fa-search"></i> 
                        </a>
                        <form class="dropdown-menu" action="<?= base_url() ?>index/search" id="form_search"> 
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <select name="category" class="filter_category">
                                        <option value="0">All</option>
                                        @foreach($category as $row)
                                        <option value="{{$row['id']}}">{{$row[pick_language($row,"name_")]}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <input type="text" name="q"class="form-control border-right-0 border" placeholder="{{lang("search_product")}}">
                                <span class="input-group-append">
                                    <button class="btn bg-white border-left-0 border" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </li> -->
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
                    {{lang('login')}}
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
                        <input class="form-control" id="email_modal" placeholder="{{lang("login_identity_label")}}" type="text" name="identity">
                        </input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="password_modal" placeholder="{{lang("login_password_label")}}" type="password" name="password">
                        </input>
                    </div>
                    <p class="text-center">
                        <button class="btn btn-template-outlined" id="button_login">
                            <i class="fa fa-sign-in">
                            </i>
                            {{lang('login')}}
                        </button>
                    </p>
                </form>
                <p class="text-center text-muted">
                    <a href="customer-register.html">
                        <strong>

                        </strong>
                    </a>
                    {{lang('help_login')}}
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Login modal end-->