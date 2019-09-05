<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-form @submit.prevent="usuario.id != null ? update() : save()">
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-container grid-list-md>
                        <usuario-form ref="usuarioForm" v-model="usuario"></usuario-form>
                    </v-container>
                    <ul>
                        <li><small><span class="required">*</span> <b>(Asterisco)</b> Indica os campos que são obrigatórios</small></li>
                    </ul>   
                </v-card-text>
                <v-card-actions class="pt-0">
                    <v-spacer></v-spacer>
                    <v-btn color="green" flat="flat"  type="submit">
                        Salvar
                        <v-icon right dark>check</v-icon>
                    </v-btn>

                    <v-btn color="blue" flat="flat" @click.native="clear" :disabled="usuario.id != null">
                           Limpar
                           <v-icon right dark>delete_sweep</v-icon>
                    </v-btn>
                    <v-btn color="red" flat="flat" @click.native="cancel">
                        Cancelar
                        <v-icon right dark>cancel</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>

<script>
    import UsuarioForm from "@/components/cadastro/forms/UsuarioForm.vue";
    export default {
        components: {
            UsuarioForm
        },
        data: () => ({
                usuario: {},
                dialog: false,
                resolve: null,
                reject: null,
                formTitle: null,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 1000
                }
            }),
        methods: {
            open(title, item, options) {
                this.$refs.usuarioForm.$validator.errors.clear();
                this.dialog = true;
                this.formTitle = title;
                this.usuario = item;
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            getFormData() {
                const formData = new FormData();
                if (this.usuario.id) {
                    formData.append('id', this.usuario.id);
                    formData.append('_method', 'PUT');
                }
                formData.append('nome_completo', this.usuario.nome_completo);
                formData.append('email', this.usuario.email);
                formData.append('telefone', this.usuario.telefone);
                formData.append('ativo', this.usuario.ativo ? 1 : 0);
                formData.append('professor', this.usuario.professor ? 1 : 0);
                formData.append('role', this.usuario.role);
                if (this.usuario.password) {
                    formData.append('password', this.usuario.password);
                }
                if (this.usuario.password_confirmation) {
                    formData.append('password_confirmation', this.usuario.password_confirmation);
                }
                if (this.usuario.avatar && this.usuario.avatar.imageFile) {
                    formData.append('image_url', this.usuario.avatar.imageFile);
                }
                return formData;
            },
            save() {
                this.$refs.usuarioForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newUsuario", this.getFormData())
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.usuario = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                    }
                });
            },
            update() {
                this.$refs.usuarioForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateUsuario", this.getFormData())
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.usuario = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                    }
                });
            },
            cancel() {
                this.resolve(false);
                this.dialog = false;
                this.$refs.usuarioForm.usuario = {};
                this.$refs.usuarioForm.$validator.errors.clear();
            },
            clear() {
                this.usuario = {};
                this.$refs.usuarioForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome_completo) {
                    this.$refs.usuarioForm.$validator.errors.add({field: 'Nome Completo', msg: resp.response.data.errors.nome_completo});
                }
                if (resp.response.data.errors.email) {
                    this.$refs.usuarioForm.$validator.errors.add({field: 'E-mail', msg: resp.response.data.errors.email});
                }
                if (resp.response.data.errors.password) {
                    this.$refs.usuarioForm.$validator.errors.add({field: 'Senha', msg: resp.response.data.errors.password});
                }
                if (resp.response.data.errors.role) {
                    this.$refs.usuarioForm.$validator.errors.add({field: 'Nível de Permissão', msg: resp.response.data.errors.role});
                }
                if (resp.response.data.errors.telefone) {
                    this.$refs.usuarioForm.$validator.errors.add({field: 'Telefone', msg: resp.response.data.errors.telefone});
                }
            }
        }
    };
</script>