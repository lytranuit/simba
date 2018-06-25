
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Góp ý</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý Góp ý</h2>
            </div>
            <div class="body">
                <!--                <div class="row">
                                    <div class="col-md-12" style="margin:20px 0px;">
                                        <a class="btn btn-success" href="{{base_url()}}admin/thempage">Thêm page</a>
                                    </div>
                                </div>-->
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Điên thoại</th>
                            <th>Email</th>
                            <th>Nội dung</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tin->name}}</td>
                            <td>{{$tin->phone}}</td>
                            <td>{{$tin->email}}</td>
                            <td>{{$tin->content}}</td>
                            <td>{{date("Y-m-d",$tin->date)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#quanlytin').DataTable();
    });
</script>