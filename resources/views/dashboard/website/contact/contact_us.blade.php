@extends('dashboard.master')

@section('content')
    <div class="container mt-4">

        {{-- CONTACT INFO --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">Contact Information
                    <a href="{{ route('contact_add') }}" class="btn btn-sm btn-primary float-end fw-bold"><i
                            class="fa fa-plus"></i>create_or_update_contact</a>
                </h5>
            </div>

            <div class="card-body">

                @foreach ($contacts as $contact)
                    <div class="border rounded p-3 mb-3">

                        <div class="row">

                            <div class="col-md-3 fw-bold">
                                ID
                            </div>
                            <div class="col-md-9">
                                {{ $contact->id }}
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 fw-bold">
                                Office Address
                            </div>
                            <div class="col-md-9">
                                {{ $contact->office_address }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 fw-bold">
                                Mobile
                            </div>
                            <div class="col-md-9">
                                {{ $contact->mobile }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 fw-bold">
                                Email
                            </div>
                            <div class="col-md-9">
                                {{ $contact->email }}
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

        {{-- SOCIAL LINKS --}}
        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">
                <h5 class="mb-0">Social Links</h5>
            </div>

            <div class="card-body">

                @foreach ($contacts as $contact)
                    {{-- Facebook --}}
                    <div class="row py-2 border-bottom align-items-center">

                        <div class="col-md-3 fw-bold">
                            Facebook
                        </div>

                        <div class="col-md-7">
                            @if ($contact->facebook)
                                <a href="{{ $contact->facebook }}" target="_blank">
                                    <i class="fab fa-facebook text-primary me-1"></i>
                                    link
                                </a>
                            @else
                                <span class="text-muted">No link</span>
                            @endif
                        </div>
                    </div>

                    {{-- Telegram --}}
                    <div class="row py-2 border-bottom align-items-center">

                        <div class="col-md-3 fw-bold">
                            Telegram
                        </div>

                        <div class="col-md-7">
                            @if ($contact->telegram)
                                <a href="{{ $contact->telegram }}" target="_blank">
                                    <i class="fab fa-telegram text-info me-1"></i>
                                    link
                                </a>
                            @else
                                <span class="text-muted">No link</span>
                            @endif
                        </div>

                        <div class="col-md-2"></div>

                    </div>

                    {{-- WhatsApp --}}
                    <div class="row py-2 border-bottom align-items-center">

                        <div class="col-md-3 fw-bold">
                            WhatsApp
                        </div>

                        <div class="col-md-7">
                            @if ($contact->watsapp)
                                <a href="{{ $contact->watsapp }}" target="_blank">
                                    <i class="fab fa-whatsapp text-success me-1"></i>
                                    link
                                </a>
                            @else
                                <span class="text-muted">No link</span>
                            @endif
                        </div>

                        <div class="col-md-2"></div>

                    </div>
                @endforeach

            </div>

        </div>

    </div>
@endsection
