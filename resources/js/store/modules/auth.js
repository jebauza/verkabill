const state = {
    token: localStorage.getItem("access_token") || "",
    user: null,
    status: ''
};

const getters = {
    isAuthenticated: state => !!state.token,
    authStatus: state => state.status,

    authUser: state => state.user,
    token: state => state.token,
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },

    AUTH_SUCCESS(state, token) {
        state.status = "success";
        state.token = token;
    },

    AUTH_LOGOUT(state) {
        state.token = "";
        state.user = null;
        state.status = "";
    },

    AUTH_LOGOUT_FULL(state) {
        state.token = "";
        state.user = null;
        state.status = "";
        localStorage.removeItem("access_token");
        delete axios.defaults.headers.common['Authorization'];
    }
};


const actions = {
    login({ commit, dispatch }, credentials) {
        return new Promise((resolve, reject) => {
            axios.post('/api/auth/login', credentials)
                .then(res => {
                    const token = res.data.access_token;
                    localStorage.setItem('access_token', token); // store the token in localstorage
                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    commit('AUTH_SUCCESS', token);
                    dispatch('getAuthUser');
                    resolve(res)
                })
                .catch(err => {
                    commit('AUTH_LOGOUT_FULL');
                    reject(err);
                });
        });
    },

    logout({ commit, dispatch }, payload) {
        return new Promise((resolve, reject) => {
            commit('AUTH_LOGOUT');
            axios.get('/api/auth/logout')
                .then(res => {
                    commit('AUTH_LOGOUT_FULL');
                    resolve(res)
                })
                .catch(err => {
                    localStorage.removeItem('access_token'); // if the request fails, remove any possible user token if possible
                    reject(err);
                });
        });
    },

    register({ commit, dispatch }, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/auth/register', data)
                .then(res => {
                    resolve(res)
                })
                .catch(err => {
                    reject(err);
                });
        });
    },

    getAuthUser({ commit, dispatch }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/auth/user')
                .then(res => {
                    const user = res.data;
                    commit('SET_USER', user);
                    resolve(res);
                })
                .catch(err => {
                    commit('SET_USER', null);
                    reject(err);
                })
        });
    }
};


export default {
    state,
    getters,
    mutations,
    actions
};
