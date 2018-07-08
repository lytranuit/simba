
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Góp ý khác</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý Góp ý khác</h2>
            </div>
            <div class="body">
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Khách hàng</th>
                            <th>Sản phẩm</th>
                            <th>Nội dung</th>
                            <th>Ngày</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tin->name}}</td>
                            <td><?= isset($tin->customer) ? $tin->customer->code . "-" . $tin->customer->name : "" ?></td>
                            <td><?= isset($tin->product) ? $tin->product->code . "-" . $tin->product->name_vi : "" ?></td>
                            <td>{{$tin->content}}</td>
                            <td>{{date("Y-m-d",$tin->date)}}</td>
                            <td>
                                @if(is_permission("editfeedback"))
                                <a href="{{base_url()}}admin/editfeedback/{{$tin->id}}" class="btn btn-default" title="edit">
                                    <i class="ace-icon fa fa-pencil bigger-120">
                                    </i>
                                </a>
                                @endif
                                @if(is_permission("removefeedback"))
                                <a href="{{base_url()}}admin/removefeedback/{{$tin->id}}" class="btn btn-default" data-type='confirm' title="remove">
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