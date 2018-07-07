
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Quản lý thông tin nổi bật</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý thông tin nổi bật</h2>
            </div>
            <div class="body">

                @if(is_permission("themnoibat"))
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px;">
                        <a class="btn btn-success" href="{{base_url()}}admin/themnoibat">Thêm</a>
                    </div>
                </div>
                @endif
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arr_tin as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{base_url()}}{{$tin->hinhanh->thumb_src or 'public/img/preview.png'}}" width="100"</td>
                            <td>{{$tin->title_vi}}</td>
                            <td>

                                @if(is_permission("editnoibat"))
                                <a href="{{base_url()}}admin/updatenoibat/{{$tin->id}}" class="btn btn-default" title="update">
                                    <i class="fa fa-star">
                                    </i>
                                </a>
                                <a href="{{base_url()}}admin/editnoibat/{{$tin->id}}" class="btn btn-default" title="edit">
                                    <i class="ace-icon fa fa-pencil bigger-120">
                                    </i>
                                </a>
                                @endif

                                @if(is_permission("removenoibat"))
                                <a href="{{base_url()}}admin/removetintuc/{{$tin->id}}" class="btn btn-default" data-type='confirm' title="remove">
                                    <i class="ace-icon fa fa-trash-o bigger-120">
                                    </i>
                                </a>
                                @endif
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