<!DOCTYPE html>
<html>

@include('sections.head')

<body>

    <div id="app">

        <App :basepath="{{ json_encode(route('web.basepath')) }}"></App>

    </div>

    @include('sections.script')

</body>

</html>
