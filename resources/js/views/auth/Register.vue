<template>
    <div class="register-box">
        <div class="register-logo">
            <router-link :to="{name:'register'}">
                <b>Registro de usuario</b>
            </router-link>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Nuevo usuario</p>

                <form @submit.prevent="register" method="post">

                    <div class="input-group mb-3">
                        <vs-input icon-after @keyup.enter="register" v-model="form.name" placeholder="Nombre" :state="(errors.name) ? 'danger' : ''">
                            <template #icon>
                                <i class='fas fa-user'></i>
                            </template>
                            <template v-if="errors.name" #message-danger>
                                {{ errors.name[0] }}
                            </template>
                        </vs-input>
                    </div>

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

                    <div class="input-group mb-3">
                        <vs-input type="password" icon-after @keyup.enter="login" v-model="form.c_password" placeholder="Repite contraseña" :state="(errors.c_password) ? 'danger' : ''">
                            <template #icon>
                                <i class='fas fa-lock'></i>
                            </template>
                            <template v-if="errors.c_password" #message-danger>
                                {{ errors.c_password[0] }}
                            </template>
                        </vs-input>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                    </a>
                </div> -->

                <!-- <a href="login.html" class="text-center">I already have a membership</a> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        console.log('register');
        $('body').removeClass().addClass('register-page').css({"min-height":"586.391px", "height":""});
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                c_password: ''
            },
            errors: {},
        };
    },
    methods: {
        register() {
            const loading = this.$vs.loading({
                type: 'points',
                color: 'blue',
                // background: '#7a76cb',
                text: 'Cargando...'
            });

            this.$store
            .dispatch("register", this.form)
            .then(res => {
                loading.close();
                this.$router.push({ name: "login" });
            })
            .catch(err => {
                loading.close();
                if (err.response.status == 422) {
                    this.errors = err.response.data.errors;
                } else if (!err.response.data.success && err.response.status == 403) {
                    this.errors = {
                        email: [err.response.data.message],
                        password: true
                    }
                }
                console.log(err.response.data);
            });

        }
    },
};
</script>

