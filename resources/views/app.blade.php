<!DOCTYPE html>
<html>

@include('sections.head')

<body>

    <div id="app">
        @if (Auth::check())
        <app :basepath="{{ json_encode(route('web.basepath')) }}"></app>
        @else
        <login :basepath="{{ json_encode(route('web.basepath')) }}"></login>
        @endif

    </div>

    @include('sections.script')

</body>

</html>
