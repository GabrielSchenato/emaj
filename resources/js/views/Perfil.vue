<template>
    <v-container grid-list-xl fluid>
        <v-layout row wrap>
            <v-flex lg12>
                <v-form @submit.prevent="save()">
                    <v-card>
                        <v-toolbar card prominent extended color="primary" dark extension-height="15px">
                            <v-toolbar-title class="headline">Atualizar Dados do Perfil</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>                        
                            <v-layout row wrap>
                                <v-flex xs12 md8>
                                    <v-container py-0>
                                        <v-layout wrap>
                                            <v-flex xs12 md8>
                                                <v-text-field
                                                    v-model="usuario.nome_completo"
                                                    v-validate="'required'"
                                                    :error-messages="errors.collect('Nome Completo')"
                                                    data-vv-name="Nome Completo"
                                                    >
                                                    <template v-slot:label>
                                                        Nome Completo<span class="required">*</span>
                                                    </template>
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex xs12 md4>
                                                <v-text-field
                                                    v-model="usuario.telefone"
                                                    v-validate="'required'"
                                                    :error-messages="errors.collect('Telefone')"
                                                    data-vv-name="Telefone" 
                                                    >
                                                    <template v-slot:label>
                                                        Telefone<span class="required">*</span>
                                                    </template>
                                                </v-text-field>
                                            </v-flex>

                                            <v-flex xs12 md12>
                                                <v-text-field
                                                    v-model="usuario.email"
                                                    v-validate="'required'"
                                                    :error-messages="errors.collect('E-mail')"
                                                    data-vv-name="E-mail"
                                                    type="email"
                                                    >
                                                    <template v-slot:label>
                                                        E-mail<span class="required">*</span>
                                                    </template>
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md5>
                                                <v-text-field
                                                    v-model="usuario.password"
                                                    v-validate="'required'"
                                                    :error-messages="errors.collect('Senha')"
                                                    data-vv-name="Senha"
                                                    type="password"
                                                    >
                                                    <template v-slot:label>
                                                        Senha<span class="required">*</span>
                                                    </template>  
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md5>
                                                <v-text-field
                                                    v-model="usuario.password_confirmation"
                                                    v-validate="'required'"
                                                    :error-messages="errors.collect('Confirmar Senha')"
                                                    data-vv-name="Confirmar Senha"
                                                    type="password"
                                                    >
                                                    <template v-slot:label>
                                                        Confirmar Senha<span class="required">*</span>
                                                    </template>  
                                                </v-text-field>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <image-input v-model="usuario" slot="offset" class="mx-auto d-block" size="130">
                                        <div slot="activator">

                                            <v-avatar v-if="usuario.imageURL != null" v-ripple slot="offset" class="mx-auto d-block" size="130">
                                                <img :src="usuario.imageURL" alt="avatar">
                                            </v-avatar>

                                            <v-avatar v-else-if="usuario.avatar_url == null" v-ripple slot="offset" class="mx-auto d-block" size="130">
                                                <span>Click para adicionar um avatar</span>
                                            </v-avatar>

                                            <v-avatar v-else v-ripple slot="offset" class="mx-auto d-block" size="130">
                                                <img :src="usuario.avatar_url" alt="avatar">
                                            </v-avatar>

                                        </div>
                                    </image-input>

                                    <v-card-text class="text-xs-center">
                                        <h6 class="body-2 category text-gray font-weight-thin mb-3">{{ $auth.user().role | formataRole }}</h6>
                                        <h4 class="card-title font-weight-light">{{ $auth.user().nome_completo }}</h4>
                                    </v-card-text>
                                </v-flex>
                            </v-layout>
                            <ul>
                                <li><small><span class="required">*</span> <b>(Asterisco)</b> Indica os campos que são obrigatórios</small></li>
                            </ul>   
                        </v-card-text>
                        <v-card-actions class="pt-0">
                            <v-spacer></v-spacer>
                            <v-btn color="green" flat="flat" type="submit">Salvar
                                <v-icon right dark>check</v-icon>
                            </v-btn>
                        </v-card-actions>                        
                    </v-card>
                </v-form>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data: () => ({
                usuario: {}
            }),
        created() {
            if (this.$auth.ready()) {
                this.usuario = {
                    id: this.$auth.user().id,
                    avatar: this.$auth.user().avatar,
                    avatar_url: this.$auth.user().avatar_url,
                    nome_completo: this.$auth.user().nome_completo,
                    telefone: this.$auth.user().telefone,
                    email: this.$auth.user().email
                };
            }
        },
        methods: {
            save() {
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        window.axios.post('auth/user/' + this.usuario.id, this.getFormData(), {headers: {"content-type": "multipart/form-data"}}).then((response) => {
                            this.$auth.user(response.data);
                            window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                            this.usuario.password = '';
                            this.usuario.password_confirmation = '';
                        }).catch((resp) => {
                            this.addErrors(resp);
                        });

                    }
                });
            },
            getFormData() {
                const formData = new FormData();
                formData.append('id', this.usuario.id);
                formData.append('_method', 'PUT');
                formData.append('nome_completo', this.usuario.nome_completo);
                formData.append('email', this.usuario.email);
                formData.append('telefone', this.usuario.telefone);
                formData.append('password', this.usuario.password);
                formData.append('password_confirmation', this.usuario.password_confirmation);
                if (this.usuario.imageFile) {
                    formData.append('image_url', this.usuario.imageFile);
                }
                return formData;
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome_completo) {
                    this.$validator.errors.add({field: 'Nome Completo', msg: resp.response.data.errors.nome_completo});
                }
                if (resp.response.data.errors.email) {
                    this.$validator.errors.add({field: 'E-mail', msg: resp.response.data.errors.email});
                }
                if (resp.response.data.errors.password) {
                    this.$validator.errors.add({field: 'Senha', msg: resp.response.data.errors.password});
                }
                if (resp.response.data.errors.telefone) {
                    this.$validator.errors.add({field: 'Telefone', msg: resp.response.data.errors.telefone});
                }
            }
        }
    };
</script>
