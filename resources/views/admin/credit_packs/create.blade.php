@extends('adminlte::page')
@section('title', 'Credit Packs')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>'Add Credit Pack','sub_links'=>array('Credit Packs'=>url(route('credit_packs')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add</h3>
        </div>
        @include('admin.partials.errormsg')
        <div class="card-body">
            <form action="{{ url(route('credit_packs.store')) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{ old('name') }}" placeholder="Name"/>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="name">Credits</label>
                        <input type="text" name="credits"
                               class="form-control {{ $errors->has('credits') ? 'is-invalid' : '' }}"
                               value="{{ old('credits') }}" placeholder="Credits"/>
                        @if ($errors->has('credits'))
                            <div class="invalid-feedback">
                                {{ $errors->first('credits') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="name">Price</label>
                        <input type="text" name="price"
                               class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                               value="{{ old('price') }}" placeholder="Price"/>
                        @if ($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select class="form-control custom-select" name="active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Renewal/Expiry Month</label>
                            <input type="text" name="expire_month"
                            class="form-control {{ $errors->has('expire_month') ? 'is-invalid' : '' }}"
                            value="{{ old('expire_month') }}" placeholder=""/>
                            @if ($errors->has('expire_month'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expire_month') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image_from" name="image_from">
                                    <label class="custom-file-label">Choose Image</label>
                                </div>
                                @if ($errors->has('image_from'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image_from') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="name">Description</label>
                        <textarea class="textarea" name="description"
                                  class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('credit_packs')}}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@stop