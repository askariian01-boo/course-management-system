@include('website.layout.header')

@php
    use Illuminate\Support\Str;
@endphp

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

                        <img class="img-fluid w-100" src="{{ asset('images/classes/' . $category->image) }}"
                            alt="" style="height: 320px; object-fit: cover;">

                        <div class="position-absolute top-0 start-0 w-100 h-100"
                            style="background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2));">
                        </div>

                        <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white">

                            <h3 class="fw-bold mb-2 text-white">
                                {{ $category->ClassName }}
                            </h3>

                            <p class="mb-3" style="font-size:14px; line-height:1.7;">
                                {{ Str::limit($category->description, 90) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center">

                                <span class="bg-primary px-3 py-2 rounded-pill small fw-bold">
                                    <i class="fa fa-users me-1"></i>
                                    Capacity :
                                    {{ $category->capacity }}
                                </span>

                                <span class="bg-light text-dark px-3 py-2 rounded-pill small fw-bold">
                                    <i class="fa fa-book-open me-1"></i>
                                    Class
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

        <div class="row g-4 align-items-stretch">

            @foreach ($teachers as $teacher)
                <div class="col-lg-3 col-md-6 wow fadeInUp">

                    <div class="team-item bg-light rounded shadow-sm h-100 overflow-hidden">

                        <div style="height: 300px; overflow: hidden;">

                            <img class="w-100 h-100" src="{{ asset('images/Teachers/' . $teacher->Image) }}"
                                alt="" style="object-fit: cover;">

                        </div>

                        <div class="text-center p-4">

                            <h5 class="mb-1">
                                {{ $teacher->FirstName }} {{ $teacher->LastName }}
                            </h5>

                            <small class="text-muted">
                                {{ $teacher->Email }}
                            </small>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>

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
                        style="width: 80px; height: 80px; object-fit:cover;">

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

                    <div class="testimonial-text bg-light text-center p-4 rounded">

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
