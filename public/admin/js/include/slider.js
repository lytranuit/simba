$(document).ready(function () {
    $.ajax({
        url: path + "ajax/listslider",
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            var initialPreview = [];
            var initialPreviewConfig = [];
            $.each(data, function (k, v) {
                initialPreview.push(path + v['hinh']['thumb_src']);
                initialPreviewConfig.push({caption: v['hinh']["real_hinhanh"], width: "120px", url: path + "index/success", key: v['id_hinhanh']})
            });
            $("#kv-explorer").fileinput({
                'theme': 'explorer-fa',
                'uploadUrl': path + 'admin/uploadhinhanh',
                'allowedFileExtensions': ['jpg', 'png', 'gif'],
                overwriteInitial: false,
                initialPreviewAsData: true,
                initialPreview: initialPreview,
                initialPreviewConfig: initialPreviewConfig
            }).on("filebatchselected", function (event, files) {
                $(this).fileinput("upload");
            });
        }
    });
    $("#upload").click(function (e) {
        e.preventDefault();
        var array = $("#kv-explorer").fileinput("getPreview");
        var listhinh = array['config'].map(function (item) {
            return item['key'];
        });
        $.ajax({
            url: path + "admin/saveslider",
            dataType: "JSON",
            type: "POST",
            data: {listhinh: JSON.stringify(listhinh)},
            success: function (data) {
                location.reload();
            }
        });
    })
})