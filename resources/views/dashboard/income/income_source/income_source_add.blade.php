@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Rejester income source </h4><br>
            <form class="form-sample" action="{{route('income_source_save')}}" method="POST">
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">source name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" pattern="^[A-Za-z _-]+$" title="Only English letters, spaces, hyphens (-), and underscore (_) are allowed!" placeholder="enter source name" required name="name">
                             @error('name')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div> 
                        </div>
                        <input type="submit" class="btn btn-info" value="Save">
                      </div>
                </div>
            </form>
        </div>
@endsection