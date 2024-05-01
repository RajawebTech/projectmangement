@include('partials.header')
    <div id="app">
        @include('partials.sidebar')
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('partials.header_nav')
            <div class="page-heading px-3">
                @yield('content')
            </div>
            @include('partials.footer_info_bar')
        </div>    
    </div>
@include('partials.footer')