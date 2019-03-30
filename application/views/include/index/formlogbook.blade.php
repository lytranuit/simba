<div class="page-loader-wrapper" style="display: none;">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<div class="container-fluid">
    <form id="logbook_form" method="post" action="#">
        <div class="row">
            <div class="col-md-4">
                <h6>1.Nhà cung cấp</h6>
                <textarea class="edit-ncc form-control" name="ncc" rows="10" placeholder="-Tên &#10;-Địa chỉ&#10;-Website &#10;-Số điện thoại&#10;-Email&#10;-Người liên hệ&#10;...."></textarea>
            </div>
            <div class="col-md-4">
                <h6>2.Các nhân sự tham gia</h6>
                <textarea class="edit-nhansu form-control" name="nhansu" required="" rows="10" placeholder="-Nhân sự 1 - Chức vụ - Chi tiết liên hệ &#10;-Nhân sự 2 - Chức vụ - Chi tiết liên hệ&#10; ...."></textarea>
            </div>
            <div class="col-md-4">

                <h6>3.Nhân sự của công ty khác(nếu có)</h6>
                <textarea class="edit-nhansu-khac form-control" name="nhansukhac" rows="10" placeholder="- Nhà xuất khẩu &#10;- Nhà tư vấn &#10;- Công ty khác"></textarea>
            </div>
            <div class="col-md-4">
                <div>
                    <h6>4.Khách hàng</h6>
                    <select id="customer_logbook" name="customers[]"  multiple="" required="">
                    </select>
                    <a href="#" class="text-success fa fa-plus" id="button_new_customer" style="font-size:20px;margin-top: 5px;"></a>
                    <div id="box_new_customer" class="d-none">
                        <textarea class="new_customer form-control" name="new_customer" rows="10" placeholder="Thông tin khách hàng mới: &#10; - Tên &#10; - Địa chỉ:&#10; - Người liên hệ - số điện thoại - Email liên lạc"></textarea>
                    </div>
                </div>
                <div>
                    <h6>5.Sản phẩm chính</h6>
                    <select id="product_logbook" name="products[]"  multiple="" required="">
                    </select>
                    <a href="#" class="text-success fa fa-plus" id="button_new_product"style="font-size:20px;margin-top: 5px;"></a>
                    <div id="box_new_product" class="d-none">
                        <textarea class="new_product form-control" name="new_product" rows="10" placeholder="Thông tin sản phẩm mới: &#10; - Hình ảnh đính kèm &#10; - Tên sản phẩm:&#10; - Quy cách đóng gói:&#10; - Hạn sử dụng:&#10; - Bảo quản: &#10; - Cách sử dụng:"></textarea>
                    </div>

                </div>
                <h6 class="mt-1">6.Thời gian cuộc họp</h6>
                <input class="form-control" name="date" value="<?= date("Y-m-d H:i:s") ?>" id='pickadatetime' required>
                <h6 class="mt-1">7.Chia sẻ thông tin</h6>
                <select class="form-control" id='send_to' name="send_to[]" multiple="">
                    @foreach($roles as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                <a href="#" class="text-success fa fa-plus" id="button_new_email"style="font-size:20px;margin-top: 5px;"></a>
                <h6 class="mt-1">8.Tiêu đề báo cáo</h6>
                <input class="form-control" name="subject" placeholder="Subject Title" required>
            </div>
            <div class="col-md-8">
                <h6>9.Nội dung cuộc họp</h6>
                <textarea class="content_logbook form-control" name="content" rows="15" required=""placeholder="-Nội dung cuộc họp"></textarea>
                <h6 class="text-danger">10.File đính kèm</h6>
                <input id="kv-file" type="file" name="file_up[]" multiple>
                <h6 class="text-danger">11.Lưu ý đặc biệt</h6>
                <textarea class="contentkhac_logbook form-control" name="note" rows="4"></textarea>
            </div>
        </div>
        <div class="mt-1">
            <button class="btn btn-success btn-sm">
                Hoàn tất
            </button>
        </div>
        <input type="hidden" id="date"/>
        <input type="hidden" id="time"/>
    </form>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#kv-file").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': path + 'admin/uploadfilev2',
            maxFileCount: 5,
            validateInitialCount: true,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            browseLabel: "",
            overwriteInitial: false,
        }).on("filebatchselected", function (event, files) {
//            $("#form-dang-tin .id_files").remove();
            $(this).fileinput("upload");
        }).on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var append = "<input type='hidden' name='id_files[]' value='" + id + "' class='id_files'/>";
            $("#logbook_form").append(append);
        }).on('filedeleted', function (event, key) {
            $(".id_files[value='" + key + "'").remove();
        });
        var datepicker = $('#date').pickadate({
            format: 'yyyy-mm-dd',
            // editable: true,
            closeOnSelect: true,
            closeOnClear: false,
            // Formats
            onSet: function (item) {
                if ('select' in item)
                    setTimeout(timepicker.open, 0);
            }
        }).pickadate('picker');
        var timepicker = $('#time').pickatime({
            format: 'H:i:00',
            interval: 60,
            onSet: function (item) {
                if ('select' in item)
                    setTimeout(function () {
                        $('#pickadatetime').val(datepicker.get() + ' ' + timepicker.get());
                    }, 0)
            }
        }).pickatime('picker');
        $('#pickadatetime').on('focus', datepicker.open).on('click', function (event) {
            event.stopPropagation();
            datepicker.open();
        });
        $("#send_to").val(1);
        $("#send_to").chosen({width: "100%"});
        $("#button_new_customer").click(function (e) {
            e.preventDefault();
            $("#box_new_customer").toggleClass("d-none");
        });
        $("#button_new_product").click(function (e) {
            e.preventDefault();
            $("#box_new_product").toggleClass("d-none");
        });
        $("#button_new_email").click(function (e) {
            e.preventDefault();
            var html = '<div id="box_new_email" class="my-1">'
                    + '<input class="form-control" name="email_add[]" placeholder="email@simba.com.vn"/>'
                    + '</div>';
            $($(this)).after(html);
        });
        $("#product_logbook").ajaxChosen({
            dataType: 'json',
            type: 'POST',
            url: path + "ajax/feedbackproduct",
        }, {
            loadingImg: path + 'public/img/loading.gif'
        }, {width: "100%", allow_single_deselect: true});
        $("#customer_logbook").ajaxChosen({
            dataType: 'json',
            type: 'POST',
            url: path + "ajax/feedbackcustomer",
        }, {
            loadingImg: path + 'public/img/loading.gif'
        }, {width: "100%", allow_single_deselect: true});
        $(".edit-ncc").froalaEditor({
            placeholderText: '-Tên \n - Địa chỉ \n - Website \n -Số điện thoại \n - Email \n - Người liên hệ \n ....',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 250,
            imageUploadURL: path + 'admin/uploadimage',
            toolbarSticky: false,
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
        $(".edit-nhansu").froalaEditor({
            placeholderText: '-Nhân sự 1 - Chức vụ - Chi tiết liên hệ \n -Nhân sự 2 - Chức vụ - Chi tiết liên hệ \n ....',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarSticky: false,
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 250,
            imageUploadURL: path + 'admin/uploadimage',
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
        $(".edit-nhansu-khac").froalaEditor({
            placeholderText: '- Nhà xuất khẩu \n - Nhà tư vấn \n - Công ty khác',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarSticky: false,
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 250,
            imageUploadURL: path + 'admin/uploadimage',
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
        $(".content_logbook").froalaEditor({
            placeholderText: 'Nội dung cuộc họp',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 200,
            imageUploadURL: path + 'admin/uploadimage',
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
        $(".contentkhac_logbook").froalaEditor({
//            toolbarInline: true,
//            toolbarVisibleWithoutSelection: true,
            placeholderText: 'Lưu ý đặc biệt',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 200,
            imageUploadURL: path + 'admin/uploadimage',
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
        $(".new_customer").froalaEditor({
            placeholderText: 'Thông tin khách hàng mới:\n- Tên\n- Địa chỉ:\n- Người liên hệ - số điện thoại:\n- Email liên lạc:',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 250,
            imageUploadURL: path + 'admin/uploadimage',
            toolbarSticky: false,
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
        $(".new_product").froalaEditor({
            placeholderText: 'Thông tin sản phẩm mới: \n- Hình ảnh đính kèm\n- Tên sản phẩm:\n- Quy cách đóng gói:\n- Hạn sử dụng:\n- Bảo quản: \n- Cách sử dụng: ',
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
            toolbarButtonsXS: ['bold', 'italic', 'underline', 'align', 'insertImage', 'fullscreen'],
//                        pluginsEnabled: ['image', 'fullscreen', 'charCounter', 'imageManager', 'file'],
            heightMin: 250,
//            toolbarInline: true,
            imageUploadURL: path + 'admin/uploadimage',
            toolbarSticky: false,
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
        });
//                    $('#myModal').modal({show: true});
        $("#logbook_form").validate({
            highlight: function (input) {
//                            $(input).parents('.wrap-input100').addClass('error');
            },
            unhighlight: function (input) {
//                            $(input).parents('.wrap-input100').removeClass('error');
            },
            errorPlacement: function (error, element) {
//            $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                var customers = $("#customer_logbook").val();
                var products = $("#product_logbook").val();
                var ncc = $("[name=ncc]").val();
                var new_customer = $(".new_customer").val();
                var new_product = $(".new_product").val();
//                if (!customers.length && new_customer == "" && ncc == "") {
//                    alert("Chọn tên khách hàng!");
//                    return false;
//                }
//                if (!products.length && new_product == "") {
//                    alert("Chọn sản phẩm chính!");
//                    return false;
//                }
                if ($("#logbook_form").data("requestRunning"))
                    return false;
                $(".page-loader-wrapper").show();
                $.ajax({
                    url: path + 'ajax/logbook',
                    data: $("#logbook_form").serialize(),
                    dataType: "JSON",
                    type: "POST",
                    beforeSend: function () {
                        $("#logbook_form").data("requestRunning", true);
                    },
                    success: function (data) {
                        $("#logbook_form").data("requestRunning", false);
                        var code = data.code;
                        var msg = data.msg;
                        alert(msg);
                        if (code == 400) {
                            location.reload();
                        }
                    }
                });
                return false;
            }
        });
    })
</script>
<style>
    h6{
        margin: 5px;
    }
    #date,#time{display:none;}
    textarea.form-control{font-size: 12px;}
</style>