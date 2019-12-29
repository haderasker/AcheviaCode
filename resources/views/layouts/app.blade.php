<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("layouts.head")

@yield('head')

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">
<div id="app">
    @include("layouts.headerMobile")
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @include("layouts.aside")
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                @include("layouts.header")

                @yield('content')

                @include("layouts.footer")
            </div>

            @include("layouts.scripts")

            @yield('script')
        </div>
    </div>
</div>
</body>
</html>


