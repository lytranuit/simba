<!doctype html>
<html>
    <head lang="en">
        @include("include.head")
    </head><!--/head-->

    <body class='{{$template or ""}}'>
        @include("include.header")
        @yield("content")
        @include("include.footer")
    </body>
</html>