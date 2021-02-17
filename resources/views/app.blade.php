<!DOCTYPE html>
<html>

@include('sections.head')

<body class="hold-transition sidebar-mini">

    <div class="wrapper" id="app">

        <App :basepath="{{ json_encode(route('web.basepath')) }}"></App>

        <div id="sidebar-overlay"></div>
    </div>

    @include('sections.script')

</body>

</html>
