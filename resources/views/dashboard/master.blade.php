<x-app-layout>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->
    <div class="layout-wrapper">
        <!-- ======== sidebar-nav start =========== -->

        @include('dashboard.layout.sidbar')
        <div class="overlay">

        </div>
        <!-- ======== sidebar-nav end =========== -->

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper" style="background-color: rgb(240, 240, 240);">
            @include('dashboard.layout.header')
            <!-- ========== header start ========== -->
            <!-- ========== header end ========== -->

            <!-- ========== section start ========== -->
            {{-- <div style="background-color:#f3f4f7;"></div> --}}
            <section class="section" >
                @yield('content')
            </section>
                
                @yield('scripts')
            <!-- ========== section end ========== -->

            <!-- ========== footer start =========== -->
            @include('dashboard.layout.footer')
            {{-- </div> --}}
            <!-- ========== footer end =========== -->
        </main>

    </div>

</x-app-layout>
