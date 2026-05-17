{{-- resources/views/website/testimonial.blade.php --}}

@include('website.layout.header')

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">

                <div class="position-relative overflow-hidden rounded-4 shadow-lg" style="min-height: 450px;">

                    <img class="img-fluid position-absolute w-100 h-100"
                        src="{{ asset('images/abouts/' . $about->image) }}" alt="" style="object-fit: cover;">

                </div>

            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">

                <h6 class="section-title bg-white text-start text-primary pe-3">
                    About Us
                </h6>

                <h1 class="mb-4">
                    {{ $about->title }}
                </h1>

                <p class="mb-4 text-muted" style="line-height: 1.9;">

                    {{ $about->description }}

                </p>
                <a href="{{ $about->button_link }}" class="btn btn-primary py-3 px-5 rounded-pill">

                    {{ $about->button_text }}

                </a>

            </div>

        </div>

    </div>
</div>
<!-- About End -->
<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">

    <div class="container">

        <div class="text-center">

            <h6 class="section-title bg-white text-center text-primary px-3">
                Testimonial
            </h6>

            <h1 class="mb-5">
                Our Students Say!
            </h1>

        </div>

        <div class="owl-carousel testimonial-carousel position-relative">

            @foreach ($testimonials as $item)
                <div class="testimonial-item text-center p-3">

                    <div class="bg-light rounded-4 shadow-sm p-4 h-100">

                        <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset($item->image) }}"
                            style="width: 90px; height: 90px; object-fit: cover;">

                        <h5 class="mb-1 fw-bold">
                            {{ $item->name }}
                        </h5>

                        <p class="text-primary mb-3">
                            {{ $item->position }}
                        </p>

                        <div class="mb-3">

                            @php
                                $stars = round($item->rating / 2);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $stars)
                                    <i class="fa fa-star text-warning"></i>
                                @else
                                    <i class="fa fa-star text-light"></i>
                                @endif
                            @endfor

                            <small class="text-muted ms-2">
                                {{ $item->rating }}/10
                            </small>

                        </div>

                        <div class="testimonial-text">

                            <p class="mb-0 text-muted" style="line-height: 1.8;">

                                {{ $item->message }}

                            </p>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</div>
<!-- Testimonial End -->

@include('website.layout.footer')
