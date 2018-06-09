<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>public/img/favicon.png">
<title>
    @section("title") 
    {{$project_name}}
    @show
</title>

<!-- core CSS -->
@foreach($stylesheet_tag as $url)
<link href="{{$url}}" rel="stylesheet">
@endforeach

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->      
@foreach($javascript_tag as $url)
<script src="{{$url}}"></script>
@endforeach