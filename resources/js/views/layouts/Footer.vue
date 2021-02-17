<template>
    <footer class="main-footer">
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
