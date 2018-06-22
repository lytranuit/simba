
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Quản lý tin tức</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý tin tức</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px;">
                        <a class="btn btn-success" href="{{base_url()}}admin/themtintuc">Thêm tin tức</a>
                    </div>
                </div>
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Type</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arr_tin as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src='{{base_url()}}{{$tin->obj_hinh->thumb_src or 'public/img/product/1.jpg'}}' width="50"/></td>
                            <td>{{$tin->title}}</td>
                            <td><span style="background: {{$tin->obj_type->color or '#000000'}};padding: 5px 20px;color: white;">{{$tin->obj_type->name_vi or ''}}</span></td>   
                            <td>
                                <a href="{{base_url()}}admin/edittintuc/{{$tin->id}}" class="text-info">
                                    <i class="ace-icon fa fa-pencil bigger-120">
                                    </i>
                                </a>
                                <a href="{{base_url()}}admin/removetintuc/{{$tin->id}}" class="text-danger">
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