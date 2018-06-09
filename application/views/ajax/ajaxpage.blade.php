<tr>
    <td><span class="id"></span></td>
    <td><input class="page form-control" value="" /></td>
    <td>
        <select class="link form-control">
            @foreach($link as $row)
            @if(in_array($row,$page_ava))
            <option value="{{$row}}" disabled="">{{$row}}</option>
            @else
            <option value="{{$row}}" style="color:black;">{{$row}}</option>
            @endif
            @endforeach
        </select>
    </td>
    <td><input href="#" class="param form-control" value=""/></td>
    <td><input href="#" class="seo form-control" value=""/></td>
    <td>
        <select class="template form-control" >
            <option value="box">Box</option>
            <option value="left">Left</option>
            <option value="right">Right</option>
            <option value="template">Full</option>
            <option value="page">Page</option>
        </select>
    </td>
    <td>
        <a href="#" class="text-success add">
            <i class="icon icon-plus">
            </i>
        </a>
    </td>
</tr>