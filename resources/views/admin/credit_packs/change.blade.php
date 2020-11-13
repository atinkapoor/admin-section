<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="{{ url(route('credit_packs.switch',$current_credit_pack['id'])) }}" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="current_credit_id" value="{{$current_credit_pack['id']}}"/>
            @csrf
            @method('POST')
            <div class="modal-header">
                <h4 class="modal-title">{{$current_credit_pack['name']}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Switch to</label>
                        <select name="credit_id" class="form-control">
                            @foreach($creditPacks as $key=>$creditPackData)
                                @if($creditPackData['id']!=$current_credit_pack['id'])
                                <option value="{{$creditPackData['id']}}">{{$creditPackData['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Switch"/>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->