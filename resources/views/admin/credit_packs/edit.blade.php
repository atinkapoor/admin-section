@extends('adminlte::page')
@section('title', 'Credit Packs')
@section('content_header')
    @include('admin.partials.sub_head',['page_heading_label'=>'Edit Credit Pack','sub_links'=>array('Credit Packs'=>url(route('credit_packs')))])
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        @include('admin.partials.errormsg')
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-red">
                    PLEASE NOT EDIT PACKAGE PRICING OR STATUS AS IT WILL NOT UPDATE FOR EXISTING SUBSCRIBERS. 
                    <br/><br/>
                    If package details must be changed, you should deactivate existing pack and create a new one. Existing subscribers will still remain on this plan, unless cancelled but new ones will get the updated version.
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    &nbsp;
                </div>
            </div>
            <form action="{{ url(route('credit_packs.update',$credit_pack['id'])) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{$credit_pack['name']}}" placeholder="Name"/>
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
                               value="{{$credit_pack['credits']}}" placeholder="Credits"/>
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
                               readonly="readonly" value="{{$credit_pack['price']}}" placeholder="Price"/>
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
                                <option value="0" @if($credit_pack['active']==0) selected='selected' @endif>Inactive
                                </option>
                                <option value="1" @if($credit_pack['active']==1) selected='selected' @endif>Active
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="name">Renewal/Expiry Month</label>
                        <input type="text" name="expire_month"
                               class="form-control {{ $errors->has('expire_month') ? 'is-invalid' : '' }}"
                               readonly="readonly" value="{{$credit_pack['expire_month']}}" placeholder=""/>
                        @if ($errors->has('expire_month'))
                            <div class="invalid-feedback">
                                {{ $errors->first('expire_month') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Image</label>
                            @if($credit_pack['image'])
                                <div class="input-group m-2">
                                    <img src="{{ $credit_pack['image_url'] }}{{ $credit_pack['image'] }}" style="max-width:25%"/>
                                </div>
                            @endif
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
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$credit_pack['description']}}</textarea>
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