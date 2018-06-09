@extends("layouts.$template")
@section("title")
{{$title}} - @parent
@stop
@section("content")
@include("include.$content")
@stop
@section("right-side")
@include("include.sidebar-right")
@stop

@section("left-side")
@include("include.sidebar-left")
@stop