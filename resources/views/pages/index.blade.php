@extends('layouts.defaultnew')
@section('title', $pageContent['meta_title'])
@section('content')
    @include('partials.v14.content-logo')
    <div class="conditions">
        <div class="container">
            <h3>{{$pageContent['heading']}}</h3>
            {!!$pageContent['content']!!}
        </div>
    </div>
@stop