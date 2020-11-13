@extends('adminlte::page')
@section('title', 'Areas')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>'Areas'])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="card-title">Areas</h3>
                </div>
                <div class="col-lg-5 text-left">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="d_search" action="{{ route('areas') }}"
                                  method="GET">
                                <input type="text" id="searchKeyword" required name="search"
                                       class="form-control"
                                       value="{{ Request::get('search') }}" placeholder="Search by name"/>
                        </div>
                        <div class="col-lg-6">
                            <a href="#" onclick="event.preventDefault();$('#d_search').submit();"
                               class="btn btn-primary">Search</a>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <a href="{{route('areas.create')}}" class="btn btn-success">Add Area</a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 35%">
                        <a href="{{ URL::route('areas',['search'=>Request::get('search'),'sort_field'=>'name','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Name</a>
                    </th>
                    <th style="width: 8%" class="text-center">
                        <a href="{{ URL::route('areas',['search'=>Request::get('search'),'sort_field'=>'active','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Status</a>
                    </th>
                    <th style="width: 30%">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas['result'] as $area)
                    <tr>
                        <td>
                            {{$area['name']}}
                            <br/>
                            <small>
                                Created @include('admin.partials.date',['field'=>$area['created_at']])
                            </small>
                        </td>
                        <td class="project-state">
                            @include('admin.partials.status',['field'=>$area['active']])
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-success btn-sm" href="{{route('areas.edit',$area['id'])}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{route('areas.timeslot',$area['id'])}}">
                                <i class="fas fa-clock">
                                </i>
                                Daily Price
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{route('areas.timeslot.date',$area['id'])}}">
                                <i class="fas fa-calendar-alt">
                                </i>
                                Date Range Price
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        @if(!empty($areas['result']))
            <div class="card-tools p-2">
                <ul class="pagination pagination-sm">
                    @for($p=1;$p<=$areas['totalPages'];$p++)
                        @php
                            $previousPage=($page>1)?$page-1:$page;
                        @endphp
                        @if($p==1)
                            <li class="page-item @if($page==1) disabled @endif"><a href="{{ URL::route('areas',['search'=>Request::get('search'),'sort_field'=>Request::get('sort_field'),'sort_desc'=>Request::get('sort_desc'),'page'=>$previousPage]) }}" class="page-link">«</a></li>
                        @endif
                        <li class="page-item @if($page==$p) active @endif"><a href="{{ URL::route('areas',['search'=>Request::get('search'),'sort_field'=>Request::get('sort_field'),'sort_desc'=>Request::get('sort_desc'),'page'=>$p]) }}" class="page-link">{{$p}}</a></li>
                        @if($p==$areas['totalPages'])
                            @php
                                $nextPage=($page==$areas['totalPages'])?$page:$page+1;
                            @endphp
                            <li class="page-item @if($page==$areas['totalPages']) disabled @endif"><a href="{{ URL::route('areas',['search'=>Request::get('search'),'sort_field'=>Request::get('sort_field'),'sort_desc'=>Request::get('sort_desc'),'page'=>$nextPage]) }}" class="page-link">»</a></li>
                        @endif
                    @endfor

                </ul>
            </div>
        @endif
    </div>
@stop
