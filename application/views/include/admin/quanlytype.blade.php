
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Quản lý loại tin tức</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý loại tin tức</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px;">
                        <a class="btn btn-success" href="{{base_url()}}admin/themtype">Thêm loại</a>
                    </div>
                </div>
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên tiếng Viêt</th>
                            <th>Tên tiếng Anh</th>
                            <th>Tên tiếng Nhật</th>
                            <th>Màu</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arr_tin as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tin->name_vi}}</td>
                            <td>{{$tin->name_en}}</td>   
                            <td>{{$tin->name_jp}}</td>   
                            <td><span style="background: {{$tin->color}};width: 30px;height: 30px;display: inline-block;"></span></td>   
                            <td>
                                <a href="{{base_url()}}admin/edittype/{{$tin->id}}" class="text-info">
                                    <i class="ace-icon fa fa-pencil bigger-120">
                                    </i>
                                </a>
                                <a href="{{base_url()}}admin/removetype/{{$tin->id}}" class="text-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120">
                                    </i>
                                </a>
                            </td>
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