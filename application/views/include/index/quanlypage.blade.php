<div style="padding: 10px">
    <div class="row">
        <div class="col-md-12" style="margin:20px 0px;">
            <a class="btn btn-success addpage" href="#">Thêm page</a>
        </div>
    </div>
    <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Param</th>
                <th>Seo URL</th>
                <th>Template</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr_page as $key=>$page)
            <tr>
                <td><span class="id">{{$page['id']}}</span></td>
                <td><input class="page form-control" value="{{$page['page']}}" /></td>
                <td>
                    <select class="link form-control">
                        @foreach($link as $row)
                        @if($row == $page['link'])
                        <option value="{{$row}}" selected="" style="font-weight: bold;color:black;">{{$row}}</option>
                        @elseif(in_array($row,$page_ava))
                        <option value="{{$row}}" disabled="">{{$row}}</option>
                        @else
                        <option value="{{$row}}" style="color:black;">{{$row}}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
                <td><input href="#" class="param form-control" value="{{$page['param']}}"/></td>
                <td><input href="#" class="seo form-control" value="{{$page['seo_url']}}"/></td>
                <td>
                    <select class="template form-control" >
                        <option value="box" {{$page['template'] == "box" ? "selected" : ""}}>Box</option>
                        <option value="left" {{$page['template'] == "left" ? "selected" : ""}}>Left</option>
                        <option value="right" {{$page['template'] == "right" ? "selected" : ""}}>Right</option>
                        <option value="template" {{$page['template'] == "template" ? "selected" : ""}}>Full</option>
                        <option value="page" {{$page['template'] == "page" ? "selected" : ""}}>Page</option>
                    </select>
                </td>
                <td>
                    <a target="blank" href="{{get_url_seo($page['link'])}}"><i class="icon-eye-open"></i></a>
                    <a href="#" class="text-info edit">
                        <i class="icon icon-edit">
                        </i>
                    </a>
                    <a href="#" class="text-danger remove">
                        <i class="icon icon-remove">
                        </i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
    .form-control{
        padding: 5px;
        min-height: 0px;
    }
</style>
<script type="text/javascript">

    $(document).ready(function () {
        $('#quanlytin').DataTable({
            iDisplayLength: -1
        });

        $(document).on("click", '.edit', function () {
            var tr = $(this).parents("tr");
            var id = $(".id", tr).text();
            var page = $(".page", tr).val();
            var link = $(".link", tr).val();
            var param = $(".param", tr).val();
            var seo = $(".seo", tr).val();
            var template = $(".template", tr).val();
            $.ajax({
                url: '{{base_url()}}ajax/editpage',
                data: {id: id, param: param, page: page, link: link, seo: seo, template: template},
                success: function () {
                    location.reload();
                }
            })
        })
        $(document).on("click", '.remove', function () {
            var tr = $(this).parents("tr");
            var id = $(".id", tr).text();
            $.ajax({
                url: '{{base_url()}}ajax/removepage',
                data: {id: id},
                success: function () {
                    location.reload();
                }
            })
        })
        $(document).on("click", '.addpage', function () {
            $.ajax({
                url: '{{base_url()}}ajax/rowpage',
                success: function (data) {
                    $("#quanlytin tbody").prepend(data);
                }
            })
        });
        $(document).on("click", '.add', function () {
            var tr = $(this).parents("tr");
            var page = $(".page", tr).val();
            var link = $(".link", tr).val();
            var seo = $(".seo", tr).val();
            var param = $(".param", tr).val();
            var template = $(".template", tr).val();
            $.ajax({
                url: '{{base_url()}}ajax/addpage',
                data: {page: page, param: param, link: link, seo: seo, template: template},
                success: function () {
                    location.reload();
                }
            })
        });
    });
</script>