<template>
    <div class="content-wrapper" style="min-height: 529.031px;">

        <!-- BreadCrumb -->
        <bread-crumb></bread-crumb>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <transition name="slide-fade" mode="out-in">

                           <router-view></router-view>

                        </transition>

                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
import BreadCrumb from './BreadCrumb';

export default {
    components: {BreadCrumb},
    created() {
        $('body').removeClass()
                .addClass('sidebar-mini layout-fixed control-sidebar-slide-open text-sm accent-primary sidebar-collapse sidebar-closed')
                .css({"height":"auto", "min-height":"552.391px"});
    },
}
</script>

<style>

</style>
