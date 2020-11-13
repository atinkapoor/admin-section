@extends('adminlte::page')
@section('title', 'Credit Packs')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>'Credit Pack - Subscribers','sub_links'=>array('Credit Packs'=>url(route('credit_packs')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Credit Pack</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <label for="name">Name</label>
                    {{$credit_pack['name']}}
                </div>
                <div class="col-lg-6">
                    <label for="name">Credits</label>
                    {{$credit_pack['credits']}}
                </div>
            </div>
        </div>
    </div>
@stop