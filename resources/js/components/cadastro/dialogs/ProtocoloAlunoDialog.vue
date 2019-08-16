<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-form @submit.prevent="protocoloAluno.id != null ? update() : save()">
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>

                <v-card-text>
                    <v-container grid-list-md>
                        <protocolo-aluno-form ref="protocoloAlunoForm" v-model="protocoloAluno"></protocolo-aluno-form>
                    </v-container>
                    <small>*Indica os campos que são obrigatórios</small>
                </v-card-text>
                <v-card-actions class="pt-0">
                    <v-spacer></v-spacer>
                    <v-btn color="green" flat="flat" type="submit">
                        Salvar
                        <v-icon right dark>check</v-icon>
                    </v-btn>

                    <v-btn color="blue" flat="flat" @click.native="clear" :disabled="protocoloAluno.id != null">
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
    import ProtocoloAlunoForm from "@/components/cadastro/forms/ProtocoloAlunoForm.vue";

    export default {
        components: {
            ProtocoloAlunoForm
        },
        props: {
            idProtocolo: {
                accept: Number,
                required: true
            }
        },
        data: () => ({
                protocoloAluno: {},
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
                this.protocoloAluno = item;
                this.$refs.protocoloAlunoForm.$refs.autocompleteAluno.values = item.aluno ? [item.aluno] : [];
                this.$refs.protocoloAlunoForm.$refs.autocompleteProfessor.values = item.professor ? [item.professor] : [];
                this.$refs.protocoloAlunoForm.$validator.reset();
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.protocoloAlunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newProtocoloAluno", {
                                    ...this.protocoloAluno,
                                    ...{
                                            protocolo_id: this.idProtocolo
                                    }
                                })
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.protocoloAluno = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                    }
                });
            },
            update() {
                this.$refs.protocoloAlunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateProtocoloAluno", this.protocoloAluno)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.protocoloAluno = {};
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
                this.protocoloAluno = {};
                this.$refs.protocoloAlunoForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.aluno_id) {
                    this.$refs.protocoloAlunoForm.$validator.errors.add({field: 'Aluno', msg: resp.response.data.errors.aluno_id});
                }
                if (resp.response.data.errors.professor_id) {
                    this.$refs.protocoloAlunoForm.$validator.errors.add({field: 'Professor', msg: resp.response.data.errors.professor_id});
                }
                if (resp.response.data.errors.data_vinculo) {
                    this.$refs.protocoloAlunoForm.$validator.errors.add({field: 'Data Vínculo', msg: resp.response.data.errors.data_vinculo});
                }
            }
        }
    };
</script>