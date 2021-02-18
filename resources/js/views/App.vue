<template>
    <div>

        <template v-if="isNotLayoutView">
            <transition name="slide-fade" mode="out-in">

                <router-view></router-view>

            </transition>
        </template>

        <template v-else>
            <div class="wrapper">
                <Navbar :basepath="basepath" ></Navbar>

                <Sidebar :basepath="basepath" :userAuth="userAuth"></Sidebar>

                <Content></Content>

                <Footer></Footer>
            </div>
        </template >


    </div>
</template>

<script>
import Navbar from './layouts/Navbar';
import Sidebar from './layouts/Sidebar';
import Content from './layouts/Content';
import Footer from './layouts/Footer';

export default {
    props: ['basepath'],

    components: {Navbar,Sidebar,Content,Footer},

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
        },
        userAuth() {
            return this.$store.getters.userAuth;
        }
    }
}
</script>
