
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Báo cáo nội bộ</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý báo cáo nội bộ</h2>
            </div>
            <div class="body">
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="white-space: pre-line">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhà cung cấp</th>
                            <th>Sản phẩm chính</th>
                            <th>Khách hàng chính</th>
                            <th>Nội dung</th>
                            <th>Ngày</th>
                            <th>Tình trạng</th>
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
                "url": path + "admin/tablelogbook",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                {"data": "id"},
                {"data": "ncc"},
                {"data": "products"},
                {"data": "customers"},
                {"data": "content"},
                {"data": "date"},
                {"data": "stauts", "className": "text-center"},
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