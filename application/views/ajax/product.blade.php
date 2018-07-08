@if($data)
@foreach($data as $row)
<div class="no-img deactivated normal col-12 row">
    <div class="col-lg-3">
        <span class="date mr-5">{{date("Y/m/d",$row['date'])}}</span>
        <span class="c_icon"></span>
    </div>
    <div class="col-lg-9">
        <span class="news_tx">
            <a href="<?= get_url_seo('index/product', array($row['id'], sluggable($row[pick_language($row, 'name_')]))) ?>">
                {{$row[pick_language($row,'name_')]}}
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
<div class="col-12 text-center">
    <ul class="pagination" style="font-size:14px;">
        @if($current_page > 1)
        <li>
            <a class="page_prev" href="#" tabindex="-1"><i class="fa fa-angle-left"></i></a>
        </li>
        @endif
        <li class='<?= 1 == $current_page ? "active" : "" ?>'>
            <a class='page_link' href="#" tabindex="-1">1</a>
        </li>
        @if($current_page > 3)
        <li class="disabled"><span class="">...</span></li>
        @endif

        @if($current_page > 2)
        <li class=""><a class="page_link" href="#">{{$current_page - 1}}</a></li>
        @endif
        @if($current_page > 1 && $current_page < $max_page)
        <li class="active"><a class="page_link" href="#">{{$current_page}}</a></li>
        @endif
        @if($current_page < $max_page - 2)
        <li class=""><a class="page_link" href="#">{{$current_page + 1}}</a></li>
        @endif
        @if($current_page < $max_page - 3)
        <li class="disabled"><span class="">...</span></li>
        @endif
        <li class='<?= $max_page == $current_page ? "active" : "" ?>'>
            <a class='page_link' href="#" tabindex="-1">{{$max_page}}</a>
        </li>
        @if($current_page != $max_page)
        <li class="">
            <a class="page_next" href="#"><i class="fa fa-angle-right"></i></a>
        </li>
        @endif
    </ul>
</div>
@endif
@else
<h3 class="no-data text-center col-12">
   {{lang('no_data')}}
</h3>
@endif
