@extends('layouts.errors')
@section('title','404')
@section('content')
    <div class="mid404">
        <div class="error_cnt">
            <h5 class="innerpage-sub-heading">OOPS ...</h5>
            <div class="404im"><img src="{{asset('images/404.png')}}"></div>
            <h4 class="innerpage-sub-heading">THE PAGE YOU'RE LOOKING FOR DOESN'T EXIST</h4>
            <div class="btns">
                <a class="wow fadeInDown animated" id="pt_singup_middle" style="visibility: visible;" href="{{route("home")}}">GO BACK</a>
            </div>
        </div>
    </div>
@endsection