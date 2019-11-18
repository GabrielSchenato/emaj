<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-form @submit.prevent="avaliacao.id != null ? update() : save()">
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-btn icon dark @click="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-container grid-list-md>
                        <avaliacao-form ref="avaliacaoForm" v-model="avaliacao"></avaliacao-form>
                    </v-container>
                </v-card-text>
                <v-card-actions class="pt-0">
                    <v-spacer></v-spacer>
                    <v-btn color="green" flat="flat" type="submit">
                        Salvar
                        <v-icon right dark>check</v-icon>
                    </v-btn>

                    <v-btn color="blue" flat="flat" @click.native="clear" :disabled="avaliacao.id != null">
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
    import AvaliacaoForm from "@/components/cadastro/forms/AvaliacaoForm.vue";
    export default {
        components: {
            AvaliacaoForm
        },
        data: () => ({
                avaliacao: {},
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
                this.$refs.avaliacaoForm.$validator.errors.clear();
                this.dialog = true;
                this.formTitle = title;
                this.avaliacao = item;
                this.$refs.avaliacaoForm.$refs.autocompleteProtocolos.values = item.protocolo ? [item] : [];
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.avaliacaoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newAvaliacao", this.avaliacao)
                                .then((resp) => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.avaliacao = {};
                                    this.formTitle = "Editar um Avaliação do Aluno";
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                    }
                });
            },
            update() {
                this.$refs.avaliacaoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateAvaliacao", this.avaliacao)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.avaliacao = {};
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
                this.$refs.avaliacaoForm.$validator.errors.clear();
            },
            clear() {
                this.avaliacao = {
                    aluno_id: this.avaliacao.aluno_id,
                    nome_aluno: this.avaliacao.nome_aluno
                };
                this.$refs.avaliacaoForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.protocolo_id) {
                    this.$refs.avaliacaoForm.$validator.errors.add({field: 'Protocolo', msg: resp.response.data.errors.protocolo_id});
                }
                if (resp.response.data.errors.data) {
                    this.$refs.avaliacaoForm.$validator.errors.add({field: 'Data', msg: resp.response.data.errors.data});
                }
                if (resp.response.data.errors.observacoes) {
                    this.$refs.avaliacaoForm.$validator.errors.add({field: 'Observações', msg: resp.response.data.errors.observacoes});
                }
            }
        }
    };
</script>