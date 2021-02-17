<template>
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <router-link :to="{name:'login'}">
                    <b>Iniciar Sección</b>
                </router-link>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Ingrese sus credenciales</p>

                    <form autocomplete="off" @submit.prevent="login" method="post">
                        <div class="input-group mb-3">
                            <vs-input icon-after @keyup.enter="login" v-model="form.email" placeholder="Correo" :state="(errors.email) ? 'danger' : ''">
                                <template #icon>
                                    <i class='fas fa-envelope'></i>
                                </template>
                                <template v-if="errors.email" #message-danger>
                                    {{ errors.email[0] }}
                                </template>
                            </vs-input>
                        </div>
                        <div class="input-group mb-3">
                            <vs-input type="password" icon-after @keyup.enter="login" v-model="form.password" placeholder="Contraseña" :state="(errors.password) ? 'danger' : ''">
                                <template #icon>
                                    <i class='fas fa-lock'></i>
                                </template>
                                <template v-if="errors.password" #message-danger>
                                    {{ errors.password[0] }}
                                </template>
                            </vs-input>
                        </div>

                        <div class="social-auth-links text-center mb-3">
                            <button type="submit" class="btn btn-flat btn-block btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    created() {

    },
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            errors: {},

            errorLogin: null,
            fullscreenLoading: false
        }
    },
    methods: {
        login() {
            const loading = this.$vs.loading({
                type: 'points',
                color: 'blue',
                // background: '#7a76cb',
                text: 'Cargando...'
            });

            this.$store
            .dispatch("login", this.form)
            .then(res => {
                loading.close();
                this.$router.push({ name: "dashboard" });
            })
            .catch(err => {
                loading.close();
                if (err.response.status == 422) {
                    this.errors = err.response.data.errors;
                } else if (err.response.status == 403) {
                    this.errors = {
                        email: [err.response.data.msg_error],
                        password: true
                    }
                }
                console.log(err.response.data);
            });
        }
    }
};
</script>

<style scope>
.vs-input-parent, .vs-input {
    width: 100% !important;
}
</style>

