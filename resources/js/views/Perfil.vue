<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <v-card>
                        <v-toolbar card prominent extended color="primary" dark extension-height="15px">
                            <v-toolbar-title class="headline">Atualizar Dados do Perfil</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <v-form ref="form" lazy-validation>
                                <v-layout row wrap>
                                    <v-flex xs12 md8>
                                        <v-form>
                                            <v-container py-0>
                                                <v-layout wrap>
                                                    <v-flex xs12 md8>
                                                        <v-text-field
                                                            name="nome_completo"
                                                            id="nome_completo"
                                                            v-model="usuario.nome_completo"
                                                            v-validate="'required'"
                                                            :error-messages="errors.collect('nome completo')"
                                                            label="Nome Completo*"
                                                            data-vv-name="nome completo"
                                                            required
                                                            ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 md4>
                                                        <v-text-field
                                                            name="telefone"
                                                            id="telefone"
                                                            v-model="usuario.telefone"
                                                            v-validate="'required'"
                                                            :error-messages="errors.collect('telefone')"
                                                            label="Telefone*"
                                                            data-vv-name="telefone"
                                                            required
                                                            ></v-text-field>
                                                    </v-flex>

                                                    <v-flex xs12 md12>
                                                        <v-text-field
                                                            name="email"
                                                            id="email"
                                                            v-model="usuario.email"
                                                            v-validate="'required'"
                                                            :error-messages="errors.collect('e-mail')"
                                                            label="E-mail*"
                                                            data-vv-name="e-mail"
                                                            required
                                                            type="email"
                                                            ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 sm6 md5>
                                                        <v-text-field
                                                            name="password"
                                                            id="password"
                                                            v-model="usuario.password"
                                                            v-validate="'required'"
                                                            :error-messages="errors.collect('senha')"
                                                            label="Senha*"
                                                            data-vv-name="senha"
                                                            required
                                                            type="password"
                                                            ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 sm6 md5>
                                                        <v-text-field
                                                            name="password_confirmation"
                                                            id="password_confirmation"
                                                            v-model="usuario.password_confirmation"
                                                            v-validate="'required'"
                                                            :error-messages="errors.collect('confirmar senha')"
                                                            label="Confirmar Senha*"
                                                            data-vv-name="confirmar senha"
                                                            required
                                                            type="password"
                                                            ></v-text-field>
                                                    </v-flex>
                                                </v-layout>
                                            </v-container>
                                        </v-form>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <image-input v-model="usuario.avatar" slot="offset" class="mx-auto d-block" size="130">
                                            <div slot="activator">
                                                <v-avatar
                                                    v-ripple
                                                    v-if="usuario.avatar && getAvatar"
                                                    slot="offset"
                                                    class="mx-auto d-block"
                                                    size="130"
                                                    >
                                                    <img :src="getAvatar" alt="avatar">
                                                </v-avatar>
                                                <v-avatar
                                                    v-ripple
                                                    v-else-if="!avatar"
                                                    slot="offset"
                                                    class="mx-auto d-block"
                                                    size="130"
                                                    >
                                                    <span>Click para adicionar um avatar</span>
                                                </v-avatar>
                                                <v-avatar v-ripple v-else slot="offset" class="mx-auto d-block" size="130">
                                                    <img :src="usuario.avatar.imageURL" alt="avatar">
                                                </v-avatar>
                                            </div>
                                        </image-input>

                                        <v-card-text class="text-xs-center">
                                            <h6 class="body-2 category text-gray font-weight-thin mb-3">{{ $auth.user().role | formataRole }}</h6>
                                            <h4 class="card-title font-weight-light">{{ $auth.user().nome_completo }}</h4>
                                        </v-card-text>
                                    </v-flex>
                                </v-layout>
                            </v-form>
                            <small>*Indica os campos que são obrigatórios</small>
                        </v-card-text>
                        <v-card-actions class="pt-0">
                            <v-spacer></v-spacer>
                            <v-btn color="green" flat="flat" @click.native="save">Salvar
                                <v-icon right dark>check</v-icon>
                            </v-btn>
                            <v-btn color="blue" flat="flat" @click.native="clear">Limpar
                                <v-icon right dark>delete_sweep</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import ImageInput from "@/components/ImageInput.vue";
    export default {
        components: {
            ImageInput: ImageInput
        },
        $_veeValidate: {
            validator: "new"
        },
        data: () => ({
                avatar: null,
                usuario: {}
            }),
        created() {
            if (this.$auth.ready()) {
                let avatar = this.$auth.user().avatar;
                avatar = {avatar};
                this.usuario = {
                    id: this.$auth.user().id,
                    avatar: avatar,
                    nome_completo: this.$auth.user().nome_completo,
                    telefone: this.$auth.user().telefone,
                    email: this.$auth.user().email,
                    role: this.$auth.user().role
                };
            }
        },
        computed: {
            getAvatar() {
                if (this.usuario.avatar.imageURL)
                    return this.usuario.avatar.imageURL;
                if(this.usuario.avatar.avatar && this.usuario.avatar)
                    return 'data:image/jpeg;base64,' + this.usuario.avatar.avatar;
                return null;
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
            clear() {
                this.usuario = {};
                this.$validator.errors.clear();
            },
            getFormData() {
                const formData = new FormData();
                formData.append('id', this.usuario.id);
                formData.append('_method', 'PUT');
                formData.append('nome_completo', this.usuario.nome_completo);
                formData.append('email', this.usuario.email);
                formData.append('role', this.usuario.role);
                formData.append('telefone', this.usuario.telefone);
                formData.append('password', this.usuario.password);
                formData.append('password_confirmation', this.usuario.password_confirmation);
                if (this.usuario.avatar.imageFile) {
                    formData.append('image_url', this.usuario.avatar.imageFile);
                }
                return formData;
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome_completo) {
                    this.$validator.errors.add({field: 'nome_completo', msg: resp.response.data.errors.nome_completo});
                }
                if (resp.response.data.errors.email) {
                    this.$validator.errors.add({field: 'e-mail', msg: resp.response.data.errors.email});
                }
                if (resp.response.data.errors.password) {
                    this.$validator.errors.add({field: 'senha', msg: resp.response.data.errors.password});
                }
                if (resp.response.data.errors.telefone) {
                    this.$validator.errors.add({field: 'telefone', msg: resp.response.data.errors.telefone});
                }
            }
        }
    };
</script>
