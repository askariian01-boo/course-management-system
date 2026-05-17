@include('website.layout.header')
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">

                    <img class="img-fluid position-absolute w-100 h-100"
                        src="{{ asset('images/abouts/' . $about->image) }}" alt="" style="object-fit: cover;">
                    alt=""
                    style="object-fit: cover;">

                </div>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">

                <h6 class="section-title bg-white text-start text-primary pe-3">
                    about us
                </h6>

                <h1 class="mb-4">
                    {{ $about->title }}
                </h1>

                <p class="mb-4">
                    {{ $about->description }}
                </p>

                {{-- <div class="row gy-2 gx-4 mb-4">

                    @php
                        $features = json_decode($about->features, true);
                    @endphp

                    @if ($features)
                        @foreach ($features as $feature)
                            <div class="col-sm-6">
                                <p class="mb-0">
                                    <i class="fa fa-arrow-right text-primary me-2"></i>
                                    {{ $feature }}
                                </p>
                            </div>
                        @endforeach
                    @endif

                </div>

                <a class="btn btn-primary py-3 px-5 mt-2"
                    href="{{ $about->button_link }}">
                    {{ $about->button_text }}
                </a> --}}

            </div>
        </div>
    </div>
</div>
<!-- About End -->



<!-- Categories Start -->
<div class="container-xxl py-5 category">
    <div class="container">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Categories
            </h6>

            <h1 class="mb-5">
                Courses Categories
            </h1>
        </div>

        <div class="row g-4">

            @foreach ($categories as $category)
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.1s">

                    <a href="#" class="position-relative d-block overflow-hidden rounded-4 shadow-lg">

                        {{-- Image --}}
                        <img class="img-fluid w-100" src="{{ asset('images/classes/' . $category->image) }}"
                            alt="" style="height: 320px; object-fit: cover;">

                        {{-- Dark Overlay --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                            style="background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2));">
                        </div>

                        {{-- Content --}}
                        <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white">

                            {{-- Class Name --}}
                            <h3 class="fw-bold mb-2 text-white">
                                {{ $category->ClassName }}
                            </h3>

                            {{-- Description --}}
                            <p class="mb-3" style="font-size: 14px; line-height: 1.7;">

                                {{ Str::limit($category->description, 100) }}

                            </p>

                            {{-- Capacity --}}
                            <div class="d-flex align-items-center justify-content-between">

                                <span class="bg-primary px-3 py-2 rounded-pill small fw-bold">
                                    <i class="fa fa-users me-1"></i>
                                    Capacity :
                                    {{ $category->capacity }}
                                </span>

                                <span class="bg-light text-dark px-3 py-2 rounded-pill small fw-bold">
                                    <i class="fa fa-book-open me-1"></i>
                                    Course
                                </span>

                            </div>

                        </div>

                    </a>

                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Categories End -->



<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Instructors
            </h6>

            <h1 class="mb-5">
                Expert Instructors
            </h1>
        </div>

        <div class="row g-4">

            @foreach ($teachers as $teacher)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="team-item bg-light">

                        <div class="overflow-hidden">

                            <img class="img-fluid w-100" src="{{ asset('images/Teachers/' . $teacher->Image) }}"
                            style="height: 280px; object-fit: cover;"
                                alt="">

                        </div>

                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">

                            {{-- <div class="bg-light d-flex justify-content-center pt-2 px-1">

                                @if ($teacher->facebook)
                                    <a class="btn btn-sm-square btn-primary mx-1"
                                        href="{{ $teacher->facebook }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif

                                @if ($teacher->twitter)
                                    <a class="btn btn-sm-square btn-primary mx-1"
                                        href="{{ $teacher->twitter }}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif

                                @if ($teacher->instagram)
                                    <a class="btn btn-sm-square btn-primary mx-1"
                                        href="{{ $teacher->instagram }}">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif

                            </div> --}}
                        </div>

                        <div class="text-center p-4">

                            <h5 class="mb-0">
                                {{ $teacher->FirstName }} - {{ $teacher->LastName }}
                            </h5>

                            <small>
                                {{ $teacher->Email }}
                            </small>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Team End -->



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
                <div class="testimonial-item text-center">

                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset($item->image) }}"
                        style="width: 80px; height: 80px;">

                    <h5 class="mb-0">
                        {{ $item->name }}
                    </h5>

                    <p>
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

                    <div class="testimonial-text bg-light text-center p-4">

                        <p class="mb-0">
                            {{ $item->message }}
                        </p>

                    </div>


                </div>
            @endforeach

        </div>

    </div>
</div>
<!-- Testimonial End -->

@include('website.layout.footer')
