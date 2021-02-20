<!DOCTYPE html>
<html>

@include('sections.head')

<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm accent-primary sidebar-open sidebar-collapse"
    style="height: auto;">

    <div id="app">

        <App :basepath="{{ json_encode(route('web.basepath')) }}"></App>

        <div id="sidebar-overlay"></div>
    </div>

    @include('sections.script')
</body>

</html>
