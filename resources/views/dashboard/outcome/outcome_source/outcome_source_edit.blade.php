@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Rejester ouctome source 
          <a href="{{ route('outcome_source_list') }}" class="btn btn-sm btn-secondary float-right"
                    style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;" >
                    <i class="fa fa-arrow-left"></i> back
                </a></h4><br>
            <form class="form-sample" action="{{route('outcome_source_update' , $outcome_source->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">source name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $outcome_source->source_name }}" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter source name" required name="source_name">
                             @error('source_name')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                        <input type="submit" class="btn btn-info btn-sm" value="Save">
                        <a href="{{ route('outcome_source_list') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
                      </div>
                </div>
            </form>
        </div>
@endsection