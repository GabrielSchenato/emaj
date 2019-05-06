<template>
    <v-app id="login" class="primary">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4 lg4>
                        <v-form @submit.prevent="login()">
                            <v-card class="elevation-1 pa-3" id="painel">
                                <v-card-text>
                                    <div class="layout column align-center">
                                        <a href="/"><img src="/images/logo_emaj_preto.png" alt="EMAJ" width="400" height="200"></a>
                                        <h1 class="flex my-4 primary--text">ACESSAR O PAINEL</h1>
                                    </div>
                                        <v-text-field
                                            append-icon="person"
                                            name="login"
                                            label="E-mail"
                                            type="email"
                                            v-model="credentials.email"
                                            :error="error_messages.email > 0"
                                            :error-messages="error_messages.email"
                                            ></v-text-field>
                                        <v-text-field
                                            append-icon="lock"
                                            name="password"
                                            label="Senha"
                                            id="password"
                                            type="password"
                                            v-model="credentials.password"
                                            :error="error_messages.password > 0"
                                            :error-messages="error_messages.password"
                                            ></v-text-field>
                                </v-card-text>
                                <v-card-actions>
                                    <!-- <a href>Esqueceu sua senha?</a>-->
                                    <v-spacer></v-spacer>
                                    <v-btn outline color="indigo" href="/">
                                        Voltar
                                        <v-icon right dark>keyboard_backspace</v-icon>
                                    </v-btn>
                                    <v-btn outline block color="primary" type="submit" :loading="loading">
                                        Entrar
                                        <v-icon right dark>keyboard_tab</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        data: () => ({
                loading: false,
                credentials: {},
                error_messages: {}
            }),

        methods: {
            login() {
                this.error_messages = {}
                this.loading = true;
                var redirect = this.$auth.redirect()
                var app = this
                this.$auth.login({
                    data: this.credentials,
                    success: function () {
                        // handle redirection
                        //const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'dashboard'
                        //this.$router.push({name: redirectTo})
                        this.$router.push('/dashboard')
                    },
                    error: function (resp) {
                        this.error_messages = resp.response.data.errors;
                        let msg = resp.response.data.errors.message ? resp.response.data.errors.message : 'Por favor, verifique as informações!';
                        window.getApp.$emit("APP_ERROR", {msg: msg});
                        this.loading = false;
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    };
</script>
<style scoped lang="css">
    #login {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        content: "";
        z-index: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)),
            url("/images/bg_1.jpg");
    }

    #painel {
        /*background: linear-gradient(rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0.45));
        color: white;*/
        opacity: 0.7;
    }
</style>
