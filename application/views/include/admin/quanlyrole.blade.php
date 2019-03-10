
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Role</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Role</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-success" href="{{base_url()}}admin/themrole">Thêm</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-primary" id="save" href="javascript:void(0);">Save</a>
                    </div>
                </div>
                <div class="dd" id="nestable2">
                    <?= $html_nestable ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#nestable').nestedSortable({
            forcePlaceholderSize: true,
            items: 'li',
            opacity: .6,
            placeholder: 'dd-placeholder',
        });
        $("#save").click(function () {
            var arraied = $('#nestable').nestedSortable('toArray', {excludeRoot: true});
            $.ajax({
                type: "POST",
                data: {data: JSON.stringify(arraied)},
                url: path + "ajax/saveorderrole",
                success: function (msg) {
                    alert("Success!");
                }
            })
        });
    });
</script>