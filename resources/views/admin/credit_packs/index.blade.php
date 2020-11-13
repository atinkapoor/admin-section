@extends('adminlte::page')
@section('title', 'Credit Packs')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>'Credit Packs'])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="card-title">Credit Packs</h3>
                </div>
                <div class="col-lg-5 text-left">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="d_search" action="{{ route('credit_packs') }}"
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
                    <a href="{{route('credit_packs.create')}}" class="btn btn-success">Add Credit Pack</a>
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
                    <th style="width: 20%">
                        <a href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>'name','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Name</a>
                    </th>
                    <th style="width: 15%">
                        <a href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>'credits','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Credits</a>
                    </th>
                    <th style="width: 10%">
                        <a href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>'price','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Price</a>
                    </th>
                    <th style="width: 15%">
                        <a href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>'expire_month','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Recurring Month</a>
                    </th>
                    <th style="width: 10%">
                        Subscribers
                    </th>
                    <th style="width: 5%" class="text-center">
                        <a href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>'active','sort_desc'=>(Request::get('sort_desc')=='DESC')?'ASC':'DESC']) }}">Status</a>
                    </th>
                    <th style="width: 25%">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($creditPacks['result'] as $creditPack)
                    <tr>
                        <td>
                            {{$creditPack['name']}}
                            <br/>
                            <small>
                                Created @include('admin.partials.date',['field'=>$creditPack['created_at']])
                            </small>
                        </td>
                        <td>
                            {{$creditPack['credits']}}
                        </td>
                        <td>
                            {{$creditPack['price']}}
                        </td>
                        <td>
                            {{$creditPack['expire_month']}}
                        </td>
                        <td>
                            @php
                                $subscribersFound=0;
                            @endphp
                            @if(array_key_exists($creditPack['id'],$subscribersStats))
                                {{$subscribersStats[$creditPack['id']]}}
                                @php
                                    $subscribersFound=1;
                                @endphp
                            @endif
                        </td>
                        <td class="project-state">
                            @include('admin.partials.status',['field'=>$creditPack['active']])
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-success btn-sm" href="{{route('credit_packs.edit',$creditPack['id'])}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            @if($subscribersFound==1)
                                <a class="btn btn-success btn-sm switch_credit_packs" data-id="{{$creditPack['id']}}"
                                   href="javacript:void(0);">
                                    <i class="fas fa-user">
                                    </i>
                                    Switch Subscribers
                                </a>
                            @else
                                <a class="btn btn-success btn-sm disabled" href="javascript:void(0);">
                                    <i class="fas fa-user">
                                    </i>
                                    Switch Subscribers
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        @if(!empty($creditPacks['result']))
            <div class="card-tools p-2">
                <ul class="pagination pagination-sm">
                    @for($p=1;$p<=$creditPacks['totalPages'];$p++)
                        @php
                            $previousPage=($page>1)?$page-1:$page;
                        @endphp
                        @if($p==1)
                            <li class="page-item @if($page==1) disabled @endif"><a
                                        href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>Request::get('sort_field'),'sort_desc'=>Request::get('sort_desc'),'page'=>$previousPage]) }}"
                                        class="page-link">«</a></li>
                        @endif
                        <li class="page-item @if($page==$p) active @endif"><a
                                    href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>Request::get('sort_field'),'sort_desc'=>Request::get('sort_desc'),'page'=>$p]) }}"
                                    class="page-link">{{$p}}</a></li>
                        @if($p==$creditPacks['totalPages'])
                            @php
                                $nextPage=($page==$creditPacks['totalPages'])?$page:$page+1;
                            @endphp
                            <li class="page-item @if($page==$creditPacks['totalPages']) disabled @endif"><a
                                        href="{{ URL::route('credit_packs',['search'=>Request::get('search'),'sort_field'=>Request::get('sort_field'),'sort_desc'=>Request::get('sort_desc'),'page'=>$nextPage]) }}"
                                        class="page-link">»</a></li>
                        @endif
                    @endfor

                </ul>
            </div>
        @endif
    </div>
    <div class="modal fade" id="modal-default">
    </div>

@stop
@section('js')
    <script>
        $(function () {
            $(".switch_credit_packs").bind("click", function () {
                var url = "{{route('credit_packs.change','')}}/" + $(this).data("id");
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        $("#modal-default").html(data);
                        $("#modal-default").modal('show');
                    }
                });
            });
        })
    </script>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/gym/css/bootstrap-4.min.css') }}">
@endsection
