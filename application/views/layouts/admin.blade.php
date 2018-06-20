<!doctype html>
<html>
    <head lang="en">
        @include("include.head")
    </head><!--/head-->

    <body class='theme-red'>
        @include("include.sidebar-left")
        <section class="content">
            <div class="container-fluid">
                @yield("content")
            </div>
        </section>
    </body>
</html>