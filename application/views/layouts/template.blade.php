<!doctype html>
<html>
    <head lang="en">
        @include("include.head")
    </head><!--/head-->

    <body class='{{$template or ""}}'>
        @include("include.header")
        @yield("content")
        @include("include.footer")

        @foreach($javascript_tag as $url)
        <script src="{{$url}}"></script>
        @endforeach
    </body>
</html>