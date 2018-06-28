@if($data)
@foreach($data as $row)
<?php $typeobj = (array) $row['typeobj']; ?>
<div class="no-img deactivated normal col-12 row">
    <div class="col-lg-3">
        <span class="date mr-5">{{date("Y/m/d",$row['date'])}}</span>
        <span class="c_icon" style="background:{{$typeobj['color']}};"><?= $typeobj[pick_language($typeobj, 'name_')] ?></span>
    </div>
    <div class="col-lg-9">
        <span class="news_tx">
            <a href="<?= base_url() ?>index/tintuc" target="_blank">
                {{$row[pick_language($row,'title_')]}}
            </a>
        </span>
        @if(isset($row['files']) && count((array) $row['files']))
        @foreach($row['files'] as $std)
        <span class="d_icon"><i class="file-icon" data-type="<?= pathinfo($std->real_hinhanh, PATHINFO_EXTENSION); ?>"></i></span>
        <span class="filesize">({{ceil($std->size / 1024)}}KB)</span>
        @endforeach
        @endif
    </div>
</div>
@endforeach
@if($max_page > 1)
<div class="col-12">
    <nav>
        <ul class="pagination justify-content-center" style="font-size:14px;">
            @if($current_page > 1)
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            @endif
            @for($i = 1;$i<=$max_page;$i++)
            <li class="page-item"><a class="page-link <?= $i == $current_page ? "active" : "" ?>" href="#">{{$i}}</a></li>
            @endfor
            @if($current_page != $max_page)
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endif
@else
<h3 class="no-data text-center col-12">
    No data
</h3>
@endif