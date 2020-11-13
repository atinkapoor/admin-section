@extends('adminlte::page')
@section('title', 'Areas')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>'Edit Areas','sub_links'=>array('Areas'=>url(route('areas')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        @include('admin.partials.errormsg')
        <div class="card-body">
            <form action="{{ url(route('areas.update',$area['id'])) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{ $area['name'] }}" placeholder="Name"/>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select class="form-control custom-select" name="active">
                                <option value="1" @if($area['active']==1) selected='selected' @endif>Active</option>
                                <option value="0" @if($area['active']==0) selected='selected' @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('areas')}}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@stop
