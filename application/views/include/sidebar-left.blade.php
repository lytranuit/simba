<div class="page-loader-wrapper">
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
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars" style="display: none;"></a>
            <a class="navbar-brand" href="index.html">ADMINSB</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="material-icons">more_vert</i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url() ?>index/logout" class="waves-effect waves-block">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">User</li>
                <li class="active">
                    <a href="index.html">
                        <i class="material-icons">account_box</i>
                        <span>Cá nhân</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.html">
                        <i class="material-icons">view_list</i>
                        <span>Thông tin nội bộ</span>
                    </a>
                </li>
                <?php if ($userdata['role'] == 1): ?>
                    <li class="header">Quản trị</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block toggled">
                            <i class="material-icons">home</i>
                            <span>Trang chủ</span>
                        </a>
                        <ul class="ml-menu" style="display: block;">
                            <li>
                                <a href="<?= base_url() ?>admin/slider">
                                    <span>Banner</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Sim ba</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Đối tác</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">list</i>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">list</i>
                            <span>Page</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">list</i>
                            <span>Tin tức</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">list</i>
                            <span>Loại tin tức</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">list</i>
                            <span>Gớp ý</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
