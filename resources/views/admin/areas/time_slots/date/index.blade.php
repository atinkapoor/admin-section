@extends('adminlte::page')
@section('title', 'Date Range Price')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>$area['name'].' - Date Range Price','sub_links'=>array('Areas'=>url(route('areas')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="card-title">Date Range Price</h3>
                </div>
                <div class="col-lg-5 text-left">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="d_search" action="{{ route('areas.timeslot.date',$area['id']) }}"
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
                    <a href="{{route('areas.timeslot.date.create',$area['id'])}}" class="btn btn-success">Add Date Range Slots</a>
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
                    <th style="width: 15%">
                        Name
                    </th>
                    <th style="width: 15%">
                        Date range
                    </th>
                    <th style="width: 21%">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($ranges as $info)
                    <tr>
                        <td>
                            {{$info['name']}}
                            <br/>
                            <small>
                                Created @include('admin.partials.date',['field'=>$info['created_at']])
                            </small>
                        </td>
                        <td>
                            {{$info['date_range']}}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-success btn-sm" href="{{route('areas.timeslot.date.edit',[$area['id'],$info['id']])}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form id="d_{{$info['id']}}"
                                  action="{{ route('areas.timeslot.date.destory',[$area['id'],$info['id']]) }}" style="display: none"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="btn btn-danger btn-sm" href=""
                               onclick="event.preventDefault();if(confirm('do you want to delete ?')){$('#d_{{$info['id']}}').submit();}">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="modal fade" id="modal-default">
    </div>
    <!-- /.modal -->
@stop
