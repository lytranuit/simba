<div style="padding: 10px">
    
    <table id="quanly" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Tin nhắn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr_tin as $key=>$tin)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$tin->ten}}</td>
                <td>{{$tin->email}}</td>   
                <td>{{$tin->sodt}}</td>
                <td>{{$tin->message}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#quanly').DataTable();
    });
</script>