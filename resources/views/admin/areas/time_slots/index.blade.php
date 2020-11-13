@extends('adminlte::page')
@section('title', 'Daily Price')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>$area['name'].' - Daily Price','sub_links'=>array('Areas'=>url(route('areas')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-3">
                    <select name="day_id" class="form-control" onchange="window.location.href = window.location.href.replace('?d_id={{ $day_id }}', '') + '?d_id=' + this.value">
                        @foreach($days as $info)
                            <option value="{{$info['id']}}"
                                    @if($day_id==$info['id']) selected='selected' @endif>{{$info['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-5 text-left">
                    &nbsp;
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
        <div class="card-body p-1">
            <form action="{{ url(route('areas.timeslot.update',$area['id'])) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="day_id"
                       value="{{$day_id}}"/>
                <div class="row">
                    @php
                        $flag=0;
                    @endphp
                    @foreach($time_slots as $time_slot)
                        @if ($flag==3)
                </div>
                <div class="row">
                    <div class="col-lg-12">&nbsp;</div>
                </div>
                <div class="row">
                    @php
                        $flag=0;
                    @endphp
                    @endif
                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>{{$time_slot['time_val']}}</b></span>
                            </div>
                            <input type="hidden" name="{!!'global_area_day_slots['.$time_slot['id'].'][id]' !!}"
                                   value="{{$time_slot['id']}}"/>
                            <input type="text" name="{!!'global_area_day_slots['.$time_slot['id'].'][price]' !!}"
                                   class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}"
                                   value="@if(isset($slotPrice[$time_slot['id']])){{$slotPrice[$time_slot['id']]}}@endif" placeholder="Price"/>
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
                    <div class="col-lg-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

@stop