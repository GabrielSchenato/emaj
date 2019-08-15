<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-form @submit.prevent="fichaTriagem.id != null ? update() : save()">
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-container grid-list-md>{{ fichaTriagem }}
                        <ficha-triagem-form ref="fichaTriagemForm" v-model="fichaTriagem"></ficha-triagem-form>
                    </v-container>
                </v-card-text>
                <v-card-actions class="pt-0">
                    <v-spacer></v-spacer>
                    <v-btn color="green" flat="flat" type="submit">
                        Salvar
                        <v-icon right dark>check</v-icon>
                    </v-btn>

                    <v-btn color="blue" flat="flat" @click.native="clear" :disabled="fichaTriagem.id != null">
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
    import FichaTriagemForm from "@/components/movimento/forms/FichaTriagemForm.vue";
    export default {
        components: {
            FichaTriagemForm
        },
        data: () => ({
                fichaTriagem: {},
                dialog: false,
                resolve: null,
                reject: null,
                formTitle: null,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 500
                }
            }),
        methods: {
            open(title, item, options) {
                this.$refs.fichaTriagemForm.$validator.reset();
                this.dialog = true;
                this.formTitle = title;
                this.fichaTriagem = item;
                this.$refs.fichaTriagemForm.$refs.autocompleteCliente.values = item.cliente ? [item.cliente] : [];
                this.$refs.fichaTriagemForm.$refs.autocompleteParteContraria.values = item.parte_contraria ? [item.parte_contraria] : [];
                this.$refs.fichaTriagemForm.$refs.autocompleteTipoDemanda.values = item.tipo_demanda ? [item.tipo_demanda] : [];
                this.$refs.fichaTriagemForm.$refs.autocompleteAluno.values = item.aluno ? [item.aluno] : [];
                this.$refs.fichaTriagemForm.$refs.autocompleteProfessor.values = item.professor ? [item.professor] : [];
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.fichaTriagemForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newFichaTriagem", this.fichaTriagem)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.fichaTriagem = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp.response.data);
                        });


                    }
                });
            },
            update() {
                this.$refs.fichaTriagemForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateFichaTriagem", this.fichaTriagem)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.fichaTriagem = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp.response.data);
                        });
                    }
                });
            },
            cancel() {
                this.resolve(false);
                this.dialog = false;
                this.$refs.fichaTriagemForm.$validator.errors.clear();
            },
            clear() {
                this.fichaTriagem = {};
                this.$refs.fichaTriagemForm.$validator.errors.clear();
            },
            addErrors(data) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (data.errors.protocolo) {
                    this.$refs.fichaTriagemForm.$validator.errors.add({field: 'protocolo', msg: data.errors.protocolo});
                }
                if (data.errors.cliente_id) {
                    this.$refs.fichaTriagemForm.$validator.errors.add({field: 'Cliente', msg: data.errors.cliente_id});
                }
                if (data.errors.parte_contraria_id) {
                    this.$refs.fichaTriagemForm.$validator.errors.add({field: 'Parte Contrária', msg: data.errors.parte_contraria_id});
                }
                if (data.errors.tipo_demanda_id) {
                    this.$refs.fichaTriagemForm.$validator.errors.add({field: 'Tipo de Demanda', msg: data.errors.tipo_demanda_id});
                }
            }
        }
    };
</script>