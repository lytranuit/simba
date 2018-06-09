<div style="padding: 10px">
    <div class="row">
        <div class="col-md-12" style="margin:20px 0px;">
            <a class="btn btn-success" href="{{base_url()}}member/thempage">Thêm page</a>
        </div>
    </div>
    <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>SEO URL</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr_tin as $key=>$tin)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$tin->title}}</td>
                <td>{{$tin->alias}}</td>   
                <td>
                    <a target="blank" href="{{base_url() . $tin->alias}}"><i class="icon-eye-open"></i></a>
                    <a href="{{base_url()}}member/editpage/{{$tin->id}}" class="text-info">
                        <i class="ace-icon fa fa-pencil bigger-120">
                        </i>
                    </a>
                    <a href="{{base_url()}}member/removepage/{{$tin->id}}" class="text-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120">
                        </i>
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