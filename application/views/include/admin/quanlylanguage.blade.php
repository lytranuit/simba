
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Language</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Language</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px;">
                        <a class="btn btn-success" id='Save' href="£">Save</a>
                    </div>
                </div>
                <table id="quanlytin" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Key</th>
                            <th>Tiếng Việt</th>
                            <th>Tiếng Anh</th>
                            <th>Tiếng Nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($moduleData as $key=>$row)
                        <tr>
                            <td class="key">{{$key}}</td>
                            <td><input type='text' style="width:100%;" class="form-control vietnamese" value='{{$row['vietnamese'] or ""}}' /></td>
                            <td><input type='text' style="width:100%;" class="form-control english" value='{{$row['english'] or ""}}' /></td>
                            <td><input type='text' style="width:100%;" class="form-control japanese" value='{{$row['japanese'] or ""}}' /></td>
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
        $('#quanlytin').DataTable({
            "lengthMenu": [[-1], ["All"]]
        });
        $("#Save").click(function (e) {
            e.preventDefault();
            var data = {vietnamese: {}, english: {}, japanese: {}};
            $("#quanlytin tbody tr").each(function () {
                var key = $(".key", $(this)).text();
                var vietnamese = $(".vietnamese", $(this)).val();
                var english = $(".english", $(this)).val();
                var japanese = $(".japanese", $(this)).val();
                data['vietnamese'][key] = vietnamese;
                data['english'][key] = english;
                data['japanese'][key] = japanese;
            });
//            console.log(data);
//           return false;
            $.ajax({
                url: path + "admin/savelanguage",
                type: "POST",
                dataType: "JSON",
                data: {data: JSON.stringify(data)},
                success: function (res) {
                    location.reload();
                }
            })
        })
    }
    );
</script>