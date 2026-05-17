@extends('dashboard.master')

@section('content')
    <div class="card mt-3 ml-3 mr-3">

        <div class="card-body">

            <h4 class="card-title mb-4">
                Create Or Update Contact Us
            </h4>

            <form class="form-sample" action="{{ route('contact_us_save') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- Office Address --}}
                    <div class="col-md-12">
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label fw-bold">
                                Office Address :
                            </label>

                            <div class="col-sm-10">

                                <input type="text" class="form-control" placeholder="Enter office address" required
                                    name="office_address"
                                    value="{{ old('office_address', $contact->office_address ?? '') }}">

                                @error('office_address')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-12">
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label fw-bold">
                                Phone Number :
                            </label>

                            <div class="col-sm-10">

                                <input type="text" class="form-control" required name="phone"
                                    placeholder="Enter your phone number" value="{{ old('phone', $contact->mobile ?? '') }}">

                                @error('phone')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-12">
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label fw-bold">
                                Email Address :
                            </label>

                            <div class="col-sm-10">

                                <input type="email" class="form-control" required name="email"
                                    placeholder="Enter your email address"
                                    value="{{ old('email', $contact->email ?? '') }}">

                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>
                    </div>

                    {{-- Google Map Preview --}}
                    {{-- @if (!empty($contact->office_address))
                        <div class="col-md-12 mb-4">

                            <label class="fw-bold mb-2 d-block">
                                Google Map Preview :
                            </label>

                            <iframe width="100%" height="350" style="border:0; border-radius:12px;" loading="lazy"
                                allowfullscreen
                                src="https://www.google.com/maps?q={{ urlencode($contact->office_address) }}&output=embed">
                            </iframe>

                        </div>
                    @endif --}}
                    {{-- Facebook --}}
                    <div class="col-md-12">
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label fw-bold">
                                Facebook :
                            </label>

                            <div class="col-sm-10">

                                <input type="text" class="form-control" name="facebook"
                                    placeholder="https://facebook.com/yourpage"
                                    value="{{ old('facebook', $contact->facebook ?? '') }}">

                                @error('facebook')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>
                    </div>

                    {{-- Telegram --}}
                    <div class="col-md-12">
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label fw-bold">
                                Telegram :
                            </label>

                            <div class="col-sm-10"> 

                                <input type="text" class="form-control" name="telgram"
                                    placeholder="https://t.me/username"
                                    value="{{ old('telgram', $contact->telegram ?? '') }}">

                                @error('telgram')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="col-md-12">
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label fw-bold">
                                WhatsApp :
                            </label>

                            <div class="col-sm-10">

                                <input type="text" class="form-control" name="watsapp"
                                    placeholder="https://wa.me/93700111222"
                                    value="{{ old('watsapp', $contact->watsapp ?? '') }}">

                                @error('watsapp')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary px-4 mt-3">
                    Save Contact Information
                </button>

            </form>

        </div>

    </div>
@endsection
