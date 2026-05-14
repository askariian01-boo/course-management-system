@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
     <div class="card-body">
        <h4 class="card-title">Rejester income  </h4><br>
            <form class="form-sample" action="{{ route('income_save') }}" method="POST">
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">amount</label>
                          <div class="col-sm-9">
                             <input type="number" class="form-control"  placeholder="enter income amount" required name="amount">
                             @error('amount')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="font-weight:600;">income date</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" value="{{ Date('Y-m-d') }}" required name="date">
                             @error('date')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">source</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="source_id">
                                    <option>select income source</option>
                                    @foreach ($sources as $source)
                                        <option value="{{ $source->id }}">{{ $source->source_name }}</option>
                                    @endforeach
                                </select>
                                @error('source')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info" value="Save">
            </form>
        </div>
@endsection