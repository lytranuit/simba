<div style="padding: 10px">
    <div class="row">
        <div class="col-md-12" style="margin:20px 0px;">
            <a class="btn btn-success" href="{{base_url()}}member/dangtintuc">Thêm tin tức mới</a>
        </div>
    </div>
    <table id="quanlytintuc" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Mã tin</th>
                <th>Tiêu đề</th>
                <th>Duyệt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr_tin as $key=>$tin)
            <tr>
                <td>{{$tin->id_tintuc}}</td>
                <td>{{$tin->title}}</td>
                <td>
                    @if($tin->active)
                    <a href="{{base_url()}}member/deactivate_tintuc/{{$tin->id_tintuc}}">
                        <button class="btn btn-xs btn-success">
                            <i class="ace-icon fa fa-check bigger-120">
                            </i>
                        </button>
                    </a>
                    @else
                    <a href="{{base_url()}}member/activate_tintuc/{{$tin->id_tintuc}}">
                        <button class="btn btn-xs btn-danger">
                            <i class="ace-icon glyphicon-remove glyphicon bigger-120">
                            </i>
                        </button>
                    </a>
                    @endif
                </td>
                <td>
                    <a href="{{base_url()}}member/edittintuc/{{$tin->id_tintuc}}">
                        <button class="btn btn-xs btn-info">
                            <i class="ace-icon fa fa-pencil bigger-120">
                            </i>
                        </button>
                    </a>
                    <a href="{{base_url()}}member/remove_tintuc/{{$tin->id_tintuc}}">
                        <button class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120">
                            </i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#quanlytintuc').DataTable();
    });
</script>