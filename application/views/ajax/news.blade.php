@if($data)
@foreach($data as $row)
<div class="no-img deactivated normal col-12 row">
    <div class="col-lg-3">
        <span class="date mr-5">{{date("Y/m/d",$row['date'])}}</span>
        <span class="c_icon"><img src="http://file.swcms.net/file/wismettac/dam/jcr:bbbe5575-4c20-484a-b2a5-d93a9ffd80b2/disclosure.png" alt="withLink"></span>
    </div>
    <div class="col-lg-9">
        <span class="news_tx">
            <a href="<?= base_url() ?>index/tintuc" target="_blank">
                {{$row[pick_language($row,'title_')]}}
            </a>
        </span>
        @if(isset($row['files']) && count((array) $row['files']))
        @foreach($row['files'] as $std)
        <span class="d_icon"><img src="http://file.swcms.net/file/wismettac/dam/jcr:eed0655e-2d22-4ba4-a8b9-bcfb99d43e89/pdf.png" alt="pdf"></span>
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