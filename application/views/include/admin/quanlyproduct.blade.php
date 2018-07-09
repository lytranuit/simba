<?php
$role_download = explode(",", $role_download->content);
?>
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">CBCL Sản phẩm</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>CBCL Sản phẩm</h2>
            </div>
            <div class="body">

                <div class="row">
                    @if(is_permission("themproduct"))
                    <div class="col-md-4" style="margin:20px 0px;">
                        <a class="btn btn-success" href="{{base_url()}}admin/themproduct">Thêm CBCL Sản phẩm</a>
                    </div>
                    @endif
                    @if(is_permission("editproduct"))
                    <form method="POST" action="{{base_url()}}admin/updatedownload" id="form-update" class="col-md-8">

                        <div class="col-md-12 text-center">
                            <b>Update toàn bộ quyền download file CBCL </b>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="role_download[]" id="role_download" multiple="">
                                @foreach($role as $row)
                                @if(in_array($row['id'],$role_download))
                                <option value="{{$row['id']}}" selected="">{{$row['name']}}</option>
                                @else 
                                <option value="{{$row['id']}}">{{$row['name']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" value="info" name="updatedownload" />
                            <button class="btn btn-primary" data-type="updatedownload">Update</button>
                        </div>
                    </form>
                    @endif
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#role_download").chosen();
        $('#quanlytin').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": path + "admin/tableproduct",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                {"data": "id"},
                {"data": "hinhanh"},
                {"data": "name"},
                {"data": "action"},
            ]

        });
    });
</script>