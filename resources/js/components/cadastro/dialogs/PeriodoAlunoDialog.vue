<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-form @submit.prevent="save()">
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>

                <v-card-text>
                    <v-container grid-list-md>
                        <periodo-aluno-form ref="periodoAlunoForm" v-model="periodoAluno"></periodo-aluno-form>
                    </v-container>
                    <ul>
                        <li><small><span class="required">*</span> <b>(Asterisco)</b> Indica os campos que são obrigatórios</small></li>
                    </ul>   
                </v-card-text>
                <v-card-actions class="pt-0">
                    <v-spacer></v-spacer>
                    <v-btn color="green" flat="flat" type="submit">
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
        </v-form>
    </v-dialog>
</template>

<script>
    import PeriodoAlunoForm from "@/components/cadastro/forms/PeriodoAlunoForm.vue";

    export default {
        components: {
            PeriodoAlunoForm
        },
        data: () => ({
                periodoAluno: {},
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
                this.periodoAluno = item;
                this.$refs.periodoAlunoForm.$validator.errors.clear();
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.periodoAlunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newPeriodoAluno", this.periodoAluno)
                                .then((resp) => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
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
                let nomeAluno = this.periodoAluno.nome_aluno;
                let idAluno = this.periodoAluno.aluno_id;
                this.periodoAluno = {nome_aluno: nomeAluno, aluno_id: idAluno};
                this.$refs.periodoAlunoForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.dia_periodo_id) {
                    this.$refs.periodoAlunoForm.$validator.errors.add({field: 'Período', msg: resp.response.data.errors.dia_periodo_id});
                }
            }
        }
    };
</script>