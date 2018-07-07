
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Quant lý page</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý Page</h2>
            </div>
            <div class="body">
                @if(is_permission("thempage"))
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px;">
                        <a class="btn btn-success" href="{{base_url()}}admin/thempage">Thêm page</a>
                    </div>
                </div>
                @endif
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề Tiếng Việt</th>
                            <th>Tiêu đề Tiếng Anh</th>
                            <th>Tiêu đề Tiếng Nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arr_tin as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tin->title_vi}}</td>
                            <td>{{$tin->title_en}}</td>   
                            <td>{{$tin->title_jp}}</td>   
                            <td>
                                @if(is_permission("editpage"))
                                <a href="{{base_url()}}admin/editpage/{{$tin->id}}" class="btn btn-default" title="edit">
                                    <i class="ace-icon fa fa-pencil bigger-120">
                                    </i>
                                </a>
                                @endif
                                @if(is_permission("removepage"))
                                <a href="{{base_url()}}admin/removepage/{{$tin->id}}" class="btn btn-default" title="remove" data-type='confirm'>
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