
@foreach($data_all as $key=>$row1)
<div class="col-xs-6">
    <div class="box_chat box-solid box-primary direct-chat direct-chat-primary" data-room='{{$row1['id']}}' data-id='0'>
        <div class="box-header with-border">
            <h3 class="box-title">{{$row1['ip_address']}}<span class="badge alert-danger"></span></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
                @foreach($row1['chat'] as $row)
                @if($row['id_customer'] != "0")
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg left" data-id='{{$row['id']}}'>
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"></span>
                        <span class="direct-chat-timestamp pull-right" data-date="{{$row['note_date']}}">{{$row['note_date']}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="{{base_url()}}public/img/testimonial-dummy1.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{$row['note_content']}}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                @else
                <!-- Message to the right -->
                <div class="direct-chat-msg right" data-id='{{$row['id']}}'>
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right">Admin</span>
                        <span class="direct-chat-timestamp pull-left" data-date="{{$row['note_date']}}">{{$row['note_date']}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="{{base_url()}}public/img/testimonial-dummy1.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{$row['note_content']}}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                @endif
                @endforeach
            </div>
            <!--/.direct-chat-messages-->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="textchat form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-flat sendchat">Send</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- /.box-footer-->
    </div>
</div>
@endforeach