
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Công bố chất lượng</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Công bố chất lượng</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px;">
                        <a class="btn btn-success" href="{{base_url()}}admin/themproduct">Thêm sản phẩm</a>
                    </div>
                </div>
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arr_tin as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src='{{base_url()}}{{$tin->hinhanh->thumb_src or 'public/img/preview.png'}}' width="50"/></td>
                            <td>{{$tin->name_vi}}</td>
                            <td>
                                <a href="{{base_url()}}admin/updateproduct/{{$tin->id}}" class="text-warning" title="update">
                                    <i class="fa fa-star">
                                    </i>
                                </a>
                                <a href="{{base_url()}}admin/editproduct/{{$tin->id}}" class="text-info" title="edit">
                                    <i class="ace-icon fa fa-pencil bigger-120">
                                    </i>
                                </a>
                                <a href="{{base_url()}}admin/removeproduct/{{$tin->id}}" class="text-danger" data-type='confirm' title="remove">
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