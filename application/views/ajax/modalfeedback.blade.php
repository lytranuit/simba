<div class="main">
                   <!--<p>Sign up once and watch any of our free demos.</p>-->
    <form id="gop_y_khac" method="post" action="#">
        <div class="wrap-input100 validate-input">
            <input class="input100" id="name1" type="text" name="name" placeholder="Tên của bạn" required="">
            <label class="label-input100" for="name">
                <span class="fa fa-user"></span>
            </label>
        </div>
        <div class="wrap-input100 validate-input">
            <b>Khách hàng</b>
            <div  class="col-12">
                <select id="select_customer" name="customer_id">
                    <option value="0">Chọn khách hàng </option>
                    @foreach($customers as $row)
                    <option value="{{$row['id']}}">{{$row['code']}} - {{$row['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="wrap-input100 validate-input">
            <b>Sản phẩm</b>
            <div  class="col-12">
                <select id="select_product" name="product_id">
                    <option value="0">Chọn Sản phẩm</option>
                    @foreach($products as $row)
                    <option value="{{$row['id']}}">{{$row['code']}} - {{$row['name_vi']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Message is required">
            <textarea class="input100" name="content" placeholder="Nội dung góp ý của khách hàng về sản phẩm" required=""></textarea>
        </div>
        <div>
            <button class="btn btn-success btn-sm">
                <?= lang('Comment') ?>
            </button>
        </div>
    </form>
</div>