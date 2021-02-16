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
        let self = this;
        axios.interceptors.response.use(undefined, function (err) {
            return new Promise(function (resolve, reject) {
                    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
                        console.log('AUTH_LOGOUT_FULL');
                        self.$store.commit('AUTH_LOGOUT_FULL');
                        self.$router.push({ name: "login" });
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
