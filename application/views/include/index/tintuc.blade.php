<div id="content-tintuc" style="padding-top: 10px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><?= lang('Home'); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= lang('news'); ?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12" style="padding-bottom: 60px">
                <div class="content-block">
                    <div class="article">
                        <div class="new-head">
                            <h3 class="news-title">{{$tin->title}}</h3>
                        </div>
                        <div class="fr-view">
                            <?= $tin->content ?>
                        </div>
                        @if(count((array)$tin->files))
                        <div class="files">
                            @foreach($tin->files as $row)
                            <div class="tin_file">
                                <a href="<?= base_url() . $row->src ?>" download='{{$row->ten_hinhanh}}'>{{$row->ten_hinhanh}}</a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>