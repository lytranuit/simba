<ol class="breadcrumb breadcrumb-bg-grey">
    <li><a href="javascript:void(0);">Home</a></li>
    <li class="active"><a href="javascript:void(0);">Thêm page</a></li>
</ol>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Thêm Page</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form method="POST" action="" id="form-dang-tin">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <b class="form-label">Tiêu đề (*):</b>
                                <div class="form-line">
                                    <input type="text" name='post_titles' class="form-control" required="" aria-required="true">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <b class="form-label">Nội dung (*):</b>
                                <div class="form-line">
                                    <textarea name="post_contents" id="editor" required="" class="form-control">
    <p>Here goes the initial content of the editor.</p>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-12" style="padding-left:0;">
                                <button type="submit" name="dangtin" class="btn btn-primary">Thêm Page</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        /* ENd dang tin */
    });
</script>