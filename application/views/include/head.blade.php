<meta charset="utf-8">
@if($template == "admin")
<meta name="viewport" content="width=1280">
@else
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endif
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
<script>
    var path = '<?= base_url() ?>';
</script>