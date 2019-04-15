
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Nhà cung cấp</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Nhà cung cấp</h2>
            </div>
            <div class="body">
                @if(is_permission("themncc"))
                <div style="margin:20px 0px;">
                    <a class="btn btn-success" href="http://localhost/simba/admin/themncc">Thêm</a>
                </div>
                @endif
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="white-space: pre-line">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>Fax</th>
                            <th>Email</th>
                            <th>Người liên hệ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#quanlytin').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": path + "admin/tablencc",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                {"data": "id"},
                {"data": "code"},
                {"data": "name"},
                {"data": "address"},
                {"data": "phone"},
                {"data": "fax"},
                {"data": "email"},
                {"data": "note"},
                {"data": "action"},
            ]

        });
        table.on('draw', function () {
            var body = $(table.table().body());
            body.unhighlight({className: "bg-danger"});
            body.highlight(table.search(), {className: "bg-danger"});
        });
    });
</script>