<div class="main">
                   <!--<p>Sign up once and watch any of our free demos.</p>-->
    <form id="logbook_form" method="post" action="#">
        <div class="wrap-input100 validate-input">
            <input class="input100" id="name2" type="text" name="name" placeholder="Tên của bạn" required="">
            <label class="label-input100" for="name">
                <span class="fa fa-user"></span>
            </label>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="customer" placeholder="Nhà cung cấp/Khách hàng" required="">
            <label class="label-input100" for="customer">
                <i class="fa fa-male"></i>
            </label>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100" type="date" name="date" placeholder="Ngày" required="" value="<?= date("Y-m-d") ?>">
            <label class="label-input100" for="date">
                <i class="fa fa-clock-o"></i>
            </label>
        </div>
        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="subject" placeholder="Mô tả sơ lược" required="">
            <label class="label-input100" for="subject">
                <i class="fa fa-envelope"></i>
            </label>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Message is required">
            <textarea class="input100 edit" name="content" placeholder="Nội dung" required=""></textarea>
        </div>
        <div>
            <button class="btn btn-success btn-sm">
                <?= lang('Send_Message') ?>
            </button>
        </div>
    </form>
</div>