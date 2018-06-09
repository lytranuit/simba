<div style="padding: 10px">
    <table id="quanlyuser" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Groups</th>
                <th>Active</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>STT</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Groups</th>
                <th>Active</th>
                <th>Hành động</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($arr_users as $key=>$user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a class="groups_users" href="#" data-value="{{$user->groups}}"data-type="checklist" data-pk="1" data-url="{{base_url()}}member/change_group/{{$user->id}}" data-title="Select Group"></a>
                </td>
                <td>
                    @if($user->active)
                    <a href="{{base_url()}}member/deactivate/{{$user->id}}">
                        <button class="btn btn-xs btn-success">
                            <i class="ace-icon fa fa-check bigger-120">
                            </i>
                        </button>
                    </a>
                    @else
                    <a href="{{base_url()}}member/activate/{{$user->id}}">
                        <button class="btn btn-xs btn-danger">
                            <i class="ace-icon glyphicon-remove glyphicon bigger-120">
                            </i>
                        </button>
                    </a>
                    @endif
                </td>
                <td>
                    <a href="{{base_url()}}member/remove_user/{{$user->id}}">
                        <button class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120">
                            </i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#quanlyuser').DataTable();
        $('.groups_users').each(function () {
            $(this).editable({
                source: <?php echo json_encode($arr_groups) ?>
            });
        });

    });
</script>