<template>
    <div>

        <template v-if="isNotLayoutView">
            <transition name="slide-fade" mode="out-in">

                <router-view></router-view>

            </transition>
        </template>

        <template v-else>
            <!-- <Navbar :basepath="basepath" :auth_user="authUser" :userPermissions="userPermissions"></Navbar> -->

            <!-- <Sidebar :basepath="basepath" :auth_user="authUser" :userPermissions="userPermissions"></Sidebar> -->

            <Content></Content>

            <!-- <Footer :basepath="basepath"></Footer> -->
        </template >


    </div>
</template>

<script>
import Content from './layouts/Content';

export default {
    props: ['basepath'],

    components: {Content},

    created() {
        console.log(this.basepath,);
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

        const getters = this.$store.getters;
        if (getters.isAuthenticated && !getters.userAuth) {
            this.$store.dispatch("getAuthUser");
        }

        console.log(this.$store.getters,'hhh');
    },

    computed: {
        currentRouteName() {
            return this.$route.name;
        },
        isNotLayoutView() {
            const notLayautViews = ['login', 'register'];

            return notLayautViews.includes(this.$route.name)
        }
    }
}
</script>
