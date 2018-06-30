
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Menu</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Quản lý Menu</h2>
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
                            <th>Tiếng Việt</th>
                            <th>Tiếng Anh</th>
                            <th>Tiếng Nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$tin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tin->text_vi}}</td>
                            <td>{{$tin->text_en}}</td>
                            <td>{{$tin->text_jp}}</td>
                            <td>
                                <a href="{{base_url()}}admin/editmenu/{{$tin->id}}" class="btn btn-default" title="edit">
                                    <i class="ace-icon fa fa-pencil bigger-120">
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