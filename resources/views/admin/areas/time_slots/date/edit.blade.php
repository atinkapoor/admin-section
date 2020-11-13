@extends('adminlte::page')
@section('title', 'Global Date Range Slots')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>$area['name'].' - Time Slots','sub_links'=>array('Areas'=>url(route('areas')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        @include('admin.partials.errormsg')
        <div class="card-body">
            <form action="{{ url(route('areas.timeslot.date.update',[$area['id'],$date_range_data['id']])) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="area_id" value="{{$area['id']}}"/>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{ $date_range_data['name'] }}" placeholder="Name"/>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date range:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="date_range" value="{{$date_range_data['date_range']}}"
                                       class="form-control float-right {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                       id="reservation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select class="form-control custom-select" name="active">
                                <option value="1" @if($date_range_data['active']==1) selected='selected' @endif>Active</option>
                                <option value="0" @if($date_range_data['active']==0) selected='selected' @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="name">Slots</label>
                    </div>
                </div>
                <div class="row">

                        @php
                            $flag=0;
                        @endphp
                        @foreach($time_slots as $time_slot)
                            @if ($flag==3)
                </div><div class="row"><div class="col-lg-12">&nbsp;</div></div><div class="row">
                        @php
                            $flag=0;
                        @endphp
                        @endif
                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>{{$time_slot['time_val']}}</b></span>
                                </div>
                                <input type="hidden" name="{!!'slots['.$time_slot['id'].'][slot_id]' !!}" value="{{$time_slot['id']}}"/>
                                @php
                                    $price="";
                                    $existing_range_datas=$date_range_data['global_date_slots'];
                                    foreach ($existing_range_datas as $existing_range_data)
                                    {
                                        if($time_slot['id']==$existing_range_data['slot_id'])
                                        {
                                            $price=$existing_range_data['price'];
                                            break;
                                        }
                                    }
                                @endphp

                                <input type="text" name="{!!'slots['.$time_slot['id'].'][price]' !!}"
                                       class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}"
                                       value="{{$price}}" placeholder="Price"/>
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('price')}}
                                    </div>
                                @endif
                            </div>

                        </div>
                        @php
                            $flag=$flag+1;
                        @endphp
                        @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('areas.timeslot.date',$area['id'])}}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/adminlte/gym/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/gym/js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/gym/js/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/gym/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/gym/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(function () {
            $('#reservation').daterangepicker();
        })
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/gym/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/gym/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection