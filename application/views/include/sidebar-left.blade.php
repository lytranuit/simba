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
            <a class="navbar-brand" href="{{base_url()}}">ADMINSB</a>
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
                <li data='info'>
                    <a href="<?= base_url() ?>admin">
                        <i class="material-icons">account_box</i>
                        <span>Cá nhân</span>
                    </a>
                </li>
                @if($userdata['role'] < 3)
                <li data="noibo">
                    <a href="<?= base_url() ?>admin/quanlynoibo">
                        <i class="material-icons">view_list</i>
                        <span>Thông tin nội bộ</span>
                    </a>
                </li>
                @endif
                <?php if ($userdata['role'] == 1): ?>
                    <li data="quanlynoibo">
                        <a href="<?= base_url() ?>admin/quanlythongtinnoibo">
                            <i class="material-icons">view_list</i>
                            <span>Quản lý thông tin nội bộ</span>
                        </a>
                    </li>
                    <li class="header">Quản trị</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block toggled">
                            <i class="material-icons">home</i>
                            <span>Trang chủ</span>
                        </a>
                        <ul class="ml-menu" style="display: block;">
                            <li data='banner'>
                                <a href="<?= base_url() ?>admin/slider">
                                    <span>Banner</span>
                                </a>
                            </li>
                            <li data='category'>
                                <a href="<?= base_url() ?>admin/quanlycategory">
                                    <span>Thông tin nhóm hàng</span>
                                </a>
                            </li>
                            <li data='about'>
                                <a href="<?= base_url() ?>admin/gioithieu">
                                    <span>Sim Ba</span>
                                </a>
                            </li>
                            <li data='client'>
                                <a href="<?= base_url() ?>admin/quanlyclient">
                                    <span>Đối tác</span>
                                </a>
                            </li>
                            <li data='happy'>
                                <a href="<?= base_url() ?>admin/quanlyhappy">
                                    <span>Thông tin Đối tác</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li data='menu'>
                        <a href="<?= base_url() ?>admin/quanlymenu">
                            <i class="material-icons">list</i>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li data='page'>
                        <a href="<?= base_url() ?>admin/quanlypage">
                            <i class="material-icons">list</i>
                            <span>Liên kết</span>
                        </a>
                    </li>
                    <li data='noibat'>
                        <a href="<?= base_url() ?>admin/quanlynoibat">
                            <i class="material-icons">list</i>
                            <span>Thông tin nổi bật</span>
                        </a>
                    </li>
                    <li data='tintuc'>
                        <a href="<?= base_url() ?>admin/quanlytintuc">
                            <i class="material-icons">list</i>
                            <span>Công bố thông tin</span>
                        </a>
                    </li>
                    <li data='product'>
                        <a href="<?= base_url() ?>admin/quanlyproduct">
                            <i class="material-icons">list</i>
                            <span>CBCL Sản phẩm</span>
                        </a>
                    </li>
                    <li data='type'>
                        <a href="<?= base_url() ?>admin/quanlytype">
                            <i class="material-icons">list</i>
                            <span>Loại tin tức</span>
                        </a>
                    </li>
                    <li data='comment'>
                        <a href="<?= base_url() ?>admin/quanlycomment">
                            <i class="material-icons">list</i>
                            <span>Góp ý</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
<script>
    $(document).ready(function () {
        var menu_active = "{{$menu_active or 0}}";
        $("#leftsidebar li[data=" + menu_active + "]").addClass("active");
        $("#leftsidebar li[data=" + menu_active + "]").parents("li").addClass("active");
        $.AdminBSB.leftSideBar.activate();
    })
</script>
