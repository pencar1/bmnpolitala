<!DOCTYPE html>
<html lang="en">
@include('layout.head')
<body>
    <div class="wrapper">
        @include('layout.nav')
        @include('layout.side')

        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>
</body>
</html>
