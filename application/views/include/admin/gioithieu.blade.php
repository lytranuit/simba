
<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Sim Ba</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Sim Ba 
                </h2>
            </div>
            <div class="body">
                <template>
                    <li class="input">
                        <div class="timeline-image input-image">
                            <img style="width: 100%;height: 100%" src="<?= base_url(); ?>public/img/1.jpg" alt="" data>
                            <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                        </div>
                        <div class="timeline-panel froala-editor">
                            <div class="timeline-heading">
                                <h4>2009-2011</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                            </div>
                        </div>
                        <div class="timeline-close">
                            <span><i class="fa fa-close"></i></span>
                        </div>
                    </li>
                </template>
                <!--==========================
    About Us Section
    ============================-->
                <section id="about">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng Việt</a></li>
                        <li role="presentation" class=""><a href="#en" data-toggle="tab" aria-expanded="false">Tiếng Anh</a></li>
                        <li role="presentation" class=""><a href="#jp" data-toggle="tab" aria-expanded="false">Tiếng Nhật</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="vi">
                            <div class="row input">
                                <div class="col-md-6 input-image">
                                    <img style="width: 100%;height: 100%;cursor: pointer;" src="{{base_url()}}{{$arr_vi[0]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}" data='{{$arr_vi[0]->hinhanh->id_hinhanh or ''}}'/>
                                    <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                                </div>
                                <div class="col-md-6 froala-editor">
                                    <?= $arr_vi[0]->content ?>
                                </div>

                            </div>
                            <div style="height: 60px;"></div>
                            <div class="row about-cols">
                                <div class="col-lg-12">
                                    <ul class="timeline">
                                        @for($i = 1; $i < count($arr_vi);$i++)
                                        <li class="input <?= $i % 2 ? "" : "timeline-inverted" ?>">
                                            <div class="timeline-image input-image">
                                                <img style="width: 100%;height: 100%" src="{{base_url()}}{{$arr_vi[$i]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}" data='{{$arr_vi[$i]->hinhanh->id_hinhanh or ''}}'>
                                                <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                                            </div>
                                            <div class="timeline-panel froala-editor">
                                                <?= $arr_vi[$i]->content ?>
                                            </div>
                                            <div class="timeline-close">
                                                <span><i class="fa fa-close"></i></span>
                                            </div>
                                        </li>
                                        @endfor
                                        <li class="timeline-inverted add">
                                            <div class="timeline-image">
                                                <h4><span class="fa fa-plus"></span></h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="en">
                            <div class="row input">
                                <div class="col-md-6 input-image">
                                    <img style="width: 100%;height: 100%;cursor: pointer;" src="{{base_url()}}{{$arr_en[0]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}" data='{{$arr_en[0]->hinhanh->id_hinhanh or ''}}'/>
                                    <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                                </div>
                                <div class="col-md-6 froala-editor">
                                    <?= $arr_en[0]->content ?>
                                </div>

                            </div>
                            <div style="height: 60px;"></div>
                            <div class="row about-cols">
                                <div class="col-lg-12">
                                    <ul class="timeline">
                                        @for($i = 1; $i < count($arr_en);$i++)
                                        <li class="input <?= $i % 2 ? "" : "timeline-inverted" ?>">
                                            <div class="timeline-image input-image">
                                                <img style="width: 100%;height: 100%" src="{{base_url()}}{{$arr_en[$i]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}" data='{{$arr_en[$i]->hinhanh->id_hinhanh or ''}}'>
                                                <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                                            </div>
                                            <div class="timeline-panel froala-editor">
                                                <?= $arr_en[$i]->content ?>
                                            </div>
                                            <div class="timeline-close">
                                                <span><i class="fa fa-close"></i></span>
                                            </div>
                                        </li>
                                        @endfor
                                        <li class="timeline-inverted add">
                                            <div class="timeline-image">
                                                <h4><span class="fa fa-plus"></span></h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="jp">
                            <div class="row input">
                                <div class="col-md-6 input-image">
                                    <img style="width: 100%;height: 100%;cursor: pointer;" src="{{base_url()}}{{$arr_jp[0]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}" data='{{$arr_jp[0]->hinhanh->id_hinhanh or ''}}'/>
                                    <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                                </div>
                                <div class="col-md-6 froala-editor">
                                    <?= $arr_jp[0]->content ?>
                                </div>

                            </div>
                            <div style="height: 60px;"></div>
                            <div class="row about-cols">
                                <div class="col-lg-12">
                                    <ul class="timeline">
                                        @for($i = 1; $i < count($arr_jp);$i++)
                                        <li class="input <?= $i % 2 ? "" : "timeline-inverted" ?>">
                                            <div class="timeline-image input-image">
                                                <img style="width: 100%;height: 100%" src="{{base_url()}}{{$arr_jp[$i]->hinhanh->src or 'public/img/intro-carousel/san-pham.png'}}" data='{{$arr_jp[$i]->hinhanh->id_hinhanh or ''}}'>
                                                <input class="kv-explorer" type="file" name="hinhanh[]" accept="image/*" class='upload_hinhanh'>
                                            </div>
                                            <div class="timeline-panel froala-editor">
                                                <?= $arr_jp[$i]->content ?>
                                            </div>
                                            <div class="timeline-close">
                                                <span><i class="fa fa-close"></i></span>
                                            </div>
                                        </li>
                                        @endfor
                                        <li class="timeline-inverted add">
                                            <div class="timeline-image">
                                                <h4><span class="fa fa-plus"></span></h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <button class="btn btn-success" id="save">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        /*
         * INIT
         */
        $(".kv-explorer").fileinput({
            'theme': 'explorer-fa',
            'uploadUrl': path + 'admin/uploadhinhanh',
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
            maxFileCount: 1,
            showPreview: false,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            browseLabel: "",
        }).on("filebatchselected", function (event, files) {
            $(this).fileinput("upload");
        }).on('fileuploaded', function (event, data, previewId, index) {
            var id = data.response.key;
            var src = data.response.initialPreview[0];
            var parent = $(this).parents(".input");
            var image = $(".input-image > img", parent).attr("src", src).attr("data", id);
        });
        $(".kv-explorer").parents(".file-input").hide();

        $('.froala-editor').froalaEditor({
            toolbarInline: true,
            charCounterCount: false,
//            toolbarVisibleWithoutSelection: true,
            imageUploadURL: '<?= base_url() ?>admin/uploadimage',
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            htmlRemoveTags: [],
            toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'color', '-', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'indent', 'outdent', '-', 'insertImage', 'insertLink', 'insertFile', 'insertVideo', 'undo', 'redo']
        });
        /*
         * EVENT
         */
        $(document).on("click", ".input-image > img", function () {
            var parent = $(this).parents(".input");
            $(".kv-explorer", parent).click();
            console.log($(".kv-explorer", parent));
        });

        $(document).on("click", ".timeline-close", function () {
            var parent = $(this).parents("li");
            parent.nextAll("li").each(function () {
                $(this).toggleClass("timeline-inverted");
            });
            parent.remove();
        })
        $(".add").click(function () {
            var parents = $(this).parents(".tab-pane");
            var ele = $(this).prev().clone();
            if (ele.length && ele.is("li"))
                ele.toggleClass("timeline-inverted");
            else
                ele = $($("template").html());
            var id = $(".timeline li", parents).length;
            $(".kv-explorer", ele).attr("id", 'kv-' + id);
            $(".froala-editor", ele).attr("id", 'fr-' + id);
            $(this).before(ele);
            /*
             * INIT
             */
            $("#kv-" + id, parents).fileinput({
                'theme': 'explorer-fa',
                'uploadUrl': path + 'admin/uploadhinhanh',
                'allowedFileExtensions': ['jpg', 'png', 'gif'],
                maxFileCount: 1,
                showPreview: false,
                showRemove: false,
                showUpload: false,
                showCancel: false,
                browseLabel: "",
            }).on("filebatchselected", function (event, files) {
                $(this).fileinput("upload");
            }).on('fileuploaded', function (event, data, previewId, index) {
                var id = data.response.key;
                var src = data.response.initialPreview[0];
                var parent = $(this).parents(".input");
                var image = $(".input-image > img", parent).attr("src", src).attr("data", id);
            });
            $("#kv-" + id, parents).parents(".file-input").hide();
            $('#fr-' + id, parents).froalaEditor({
                toolbarInline: true,
                charCounterCount: false,
//            toolbarVisibleWithoutSelection: true,
                imageUploadURL: '<?= base_url() ?>admin/uploadimage',
                // Set request type.
                imageUploadMethod: 'POST',
                // Set max image size to 5MB.
                imageMaxSize: 5 * 1024 * 1024,
                // Allow to upload PNG and JPG.
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
                htmlRemoveTags: [],
                toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'color', '-', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'indent', 'outdent', '-', 'insertImage', 'insertLink', 'insertFile', 'insertVideo', 'undo', 'redo']
            });
        });
        $("#save").click(function () {
            var array = [];
            $(".tab-pane").each(function () {
                var language = $(this).attr("id");
                $(".input", $(this)).each(function (k) {
                    var id_hinhanh = $(".input-image > img", $(this)).attr("data");
                    var content = $(".froala-editor", $(this)).froalaEditor('html.get', true);
                    var order = k;
                    array.push({id_hinhanh: id_hinhanh, content: content, language: language, order: order});
                });
            });
            $.ajax({
                url: path + "admin/savegioithieu",
                dataType: "JSON",
                data: {data: JSON.stringify(array)},
                type: "POST",
                success: function (data) {
                    location.reload();
                }
            });
            console.log(array);
        });
    });
</script>