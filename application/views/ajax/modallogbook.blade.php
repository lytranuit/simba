<div class="main">
    <form id="logbook_form" method="post" action="#">
        <div class="row">
            <div class="col-md-4">
                <h6>1.Nhà cung cấp</h6>
                <textarea class="edit-ncc" name="ncc" required=""></textarea>
            </div>
            <div class="col-md-4">
                <h6>2.Các nhân sự tham gia</h6>
                <textarea class="edit-nhansu" name="nhansu" required=""></textarea>
            </div>
            <div class="col-md-4">

                <h6>3.Nhân sự của công ty khác(nếu có)</h6>
                <textarea class="edit-nhansu-khac" name="nhansukhac"></textarea>
            </div>
            <div class="col-md-4">
                <h6>4.Khách hàng</h6>
                <select id="customer_logbook" name="customers[]"  multiple="" required="">
                </select>
                <h6>5.Sản phẩm chính</h6>
                <select id="product_logbook" name="products[]"  multiple="" required="">
                </select>
                <h6 class="mt-1">6.Thời gian cuộc họp</h6>
                <input class="form-control" name="date" type="date" value="<?= date("Y-m-d") ?>" required>
                <h6 class="mt-1">7.Chia sẽ thông tin</h6>
                <select class="form-control" id='send_to' name="send_to[]" required="" multiple="">
                    @foreach($roles as $row)
                    <option value="{{$row->email}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8">
                <h6>8.Nội dung cuộc họp</h6>
                <textarea class="content_logbook" name="content"></textarea>
            </div>
        </div>
        <div class="mt-1">
            <button class="btn btn-success btn-sm">
                Hoàn tất
            </button>
        </div>
    </form>
</div>