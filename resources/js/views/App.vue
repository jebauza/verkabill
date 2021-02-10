<template>
    <div>
        <!-- <Navbar :basepath="basepath" :auth_user="authUser" :userPermissions="userPermissions"></Navbar> -->

        <!-- <Sidebar :basepath="basepath" :auth_user="authUser" :userPermissions="userPermissions"></Sidebar> -->

        <Content></Content>

        <!-- <Footer :basepath="basepath"></Footer> -->
    </div>
</template>

<script>
import Content from './layouts/Content';

export default {
    props: ['basepath'],
    created() {
        console.log(this.basepath);
        axios.interceptors.response.use(undefined, function (err) {
            return new Promise(function (resolve, reject) {
                    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
                        this.$store.dispatch('AUTH_LOGOUT_FULL');
                    }
                    throw err;
                });
        });
        axios.defaults.withCredentials = true
        axios.defaults.baseURL = this.basepath;
    }
}
</script>
