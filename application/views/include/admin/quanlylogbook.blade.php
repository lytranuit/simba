
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Nhật ký</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý nhật ký</h2>
            </div>
            <div class="body">
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Nhân viên</th>
                            <th>Đối tác/Khách hàng</th>
                            <th>Mô tả sơ lược</th>
                            <th>Nội dung</th>
                            <th>Ngày</th>
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
                {"data": "name"},
                {"data": "customer"},
                {"data": "subject"},
                {"data": "content"},
                {"data": "date"},
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