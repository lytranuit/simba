<div style="padding: 10px">
    <div class="row">
        <div class="col-md-12" style="margin:20px 0px;">
            <a class="btn btn-success" href="{{base_url()}}member/dangtin">Đăng tin</a>
        </div>
    </div>
    <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Địa chỉ</th>
                <th>Diện tích</th>
                <th>Duyệt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr_tin as $key=>$tin)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$tin->title}}</td>
                <td>{{$tin->diachi}}</td>   
                <td>{{number_format($tin->dientich)}} m2</td>
                <td>
                    @if($tin->active)
                    <a href="{{base_url()}}member/deactivate_tin/{{$tin->id_tin}}">
                        <button class="btn btn-xs btn-success">
                            <i class="ace-icon fa fa-check bigger-120">
                            </i>
                        </button>
                    </a>
                    @else
                    <a href="{{base_url()}}member/activate_tin/{{$tin->id_tin}}">
                        <button class="btn btn-xs btn-danger">
                            <i class="ace-icon glyphicon-remove glyphicon bigger-120">
                            </i>
                        </button>
                    </a>
                    @endif
                </td>
                <td>
                    <a href="{{base_url()}}member/edittin/{{$tin->id_tin}}">
                        <button class="btn btn-xs btn-info">
                            <i class="ace-icon fa fa-pencil bigger-120">
                            </i>
                        </button>
                    </a>
                    <a href="{{base_url()}}member/remove_tin/{{$tin->id_tin}}">
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
        $('#quanlytin').DataTable();
    });
</script>