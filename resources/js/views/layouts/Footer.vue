<template>
    <footer class="main-footer text-sm">
        © {{ now.format('YYYY') }} Verkabill
    </footer>
</template>

<script>
import moment from 'moment';

export default {
    data() {
        return {
            now: moment()
        }
    }
}
</script>

<style>

</style>
