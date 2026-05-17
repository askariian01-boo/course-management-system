@include('website.layout.header')

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center wow fadeInUp">
            <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
            <h1 class="mb-5">Contact For Any Query</h1>
        </div>

        <div class="row g-4">

            {{-- LEFT INFO --}}
            <div class="col-lg-4 col-md-6 wow fadeInUp">

                <h5 class="mb-3">Get In Touch</h5>

                <p class="mb-4 text-muted">
                    Please use the contact form below to send us your message. Our team will respond promptly.
                </p>

                {{-- OFFICE --}}
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary"
                        style="width:50px;height:50px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>

                    <div class="ms-3">
                        <h6 class="text-primary mb-1">Office</h6>
                        <p class="mb-0">
                            {{ $contact->office_address ?? 'No address' }}
                        </p>
                    </div>
                </div>

                {{-- PHONE --}}
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary"
                        style="width:50px;height:50px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>

                    <div class="ms-3">
                        <h6 class="text-primary mb-1">Mobile</h6>
                        <p class="mb-0">
                            {{ $contact->mobile ?? 'No phone' }}
                        </p>
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center bg-primary"
                        style="width:50px;height:50px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>

                    <div class="ms-3">
                        <h6 class="text-primary mb-1">Email</h6>
                        <p class="mb-0">
                            {{ $contact->email ?? 'No email' }}
                        </p>
                    </div>
                </div>

                {{-- SOCIAL LINKS --}}
                <hr>
                @if ($contact)

                    <div class="mt-4">

                        <h6 class="text-primary mb-3">Social Links</h6>

                        <div class="d-flex gap-3">

                            @if (!empty($contact->facebook))
                                <a href="{{ $contact->facebook }}" target="_blank"
                                    class="btn btn-primary rounded-circle social-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif

                            @if (!empty($contact->telegram))
                                <a href="{{ $contact->telegram }}" target="_blank"
                                    class="btn btn-info rounded-circle social-btn">
                                    <i class="fab fa-telegram-plane"></i>
                                </a>
                            @endif

                            @if (!empty($contact->watsapp))
                                <a href="https://wa.me/{{ $contact->watsapp }}" target="_blank"
                                    class="btn btn-success rounded-circle social-btn">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            @endif

                        </div>

                    </div>

                @endif

            </div>

            {{-- MAP --}}
            <div class="col-lg-4 col-md-6 wow fadeInUp d-flex">

                <div class="w-100 h-100">

                    @if ($contact && $contact->office_address)
                        <iframe class="w-100 h-100 rounded" style="min-height: 100%; border:0;" loading="lazy"
                            src="https://www.google.com/maps?q={{ urlencode($contact->office_address) }}&output=embed">
                        </iframe>
                    @endif

                </div>

            </div>

            {{-- FORM --}}
            <div class="col-lg-4 col-md-12 wow fadeInUp d-flex">

                <div class="w-100 h-100 p-3 bg-white shadow-sm rounded">

                    <form method="POST">
                        @csrf

                        <div class="row g-4">

                            <div class="col-md-6">
                                <input class="form-control" placeholder="Your Name">
                            </div>

                            <div class="col-md-6">
                                <input class="form-control" placeholder="Your Email">
                            </div>

                            <div class="col-12">
                                <input class="form-control" placeholder="Subject">
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" rows="6" placeholder="Message"></textarea>
                            </div>
                            
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">
                                    Send Message
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>
            <hr>

        </div>
    </div>
</div>

@include('website.layout.footer')
