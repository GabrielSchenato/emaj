<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-card>
            <v-toolbar dark :color="options.color" dense flat>
                       <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-container grid-list-md>
                    <tipo-status-form ref="tipoStatusForm" v-model="tipoStatus"></tipo-status-form>
                </v-container>
            </v-card-text>
            <v-card-actions class="pt-0">
                <v-spacer></v-spacer>
                <v-btn color="green" flat="flat" @click.native="tipoStatus.id != null ? update() : save()">
                    Salvar
                    <v-icon right dark>check</v-icon>
                </v-btn>

                <v-btn color="blue" flat="flat" @click.native="clear">
                    Limpar
                    <v-icon right dark>delete_sweep</v-icon>
                </v-btn>
                <v-btn color="red" flat="flat" @click.native="cancel">
                    Cancelar
                    <v-icon right dark>cancel</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import TipoStatusForm from "@/components/cadastro/forms/TipoStatusForm.vue";
    export default {
        components: {
            TipoStatusForm
        },
        data: () => ({
                tipoStatus: {},
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
                this.dialog = true;
                this.formTitle = title;
                this.tipoStatus = item;
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.tipoStatusForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newTipoStatus", this.tipoStatus)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.tipoStatus = {};
                                    this.$store.dispatch("getTipoStatusAll");
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });


                    }
                });
            },
            update() {
                this.$refs.tipoStatusForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateTipoStatus", this.tipoStatus)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.tipoStatus = {};
                                    this.$store.dispatch("getTipoStatusAll");
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
            },
            clear() {
                this.tipoStatus = {};
                this.$refs.tipoStatusForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome) {
                    this.$refs.tipoStatusForm.$validator.errors.add({field: 'nome', msg: resp.response.data.errors.nome});
                }
            }
        }
    };
</script>