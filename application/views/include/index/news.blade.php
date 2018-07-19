<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="header">
                        <h2>{{$tin[pick_language($tin,'title_')]}}</h2>
                    </div>
                    <div class="body">
                        <div class="fr-view">
                            <?= $tin[pick_language($tin, 'content_')] ?>
                        </div>

                        @if(count($tin['files']))
                        <div>
                            @foreach($tin['files'] as $row)
                            <a href="#" class="files d-block mt-1" data='{{$row['id_hinhanh']}}' role="{{$row['role_download']}}">
                                <i class="file-icon" data-type="<?= pathinfo($row['real_hinhanh'], PATHINFO_EXTENSION); ?>"></i>
                                {{$row['real_hinhanh']}}
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>