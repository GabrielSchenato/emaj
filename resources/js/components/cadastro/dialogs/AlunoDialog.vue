<template>
    <v-layout row justify-center>
        <v-dialog
            v-model="dialog"
            :max-width="options.width"
            @keydown.esc="cancel"
            v-bind:style="{ zIndex: options.zIndex }"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
            >
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-btn icon dark @click="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-card><v-form @submit.prevent="aluno.id != null ? update() : save()">
                            <v-toolbar card prominent extended color="primary" dark extension-height="15px">
                                <v-toolbar-title class="headline"></v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-card-text>

                                <v-container grid-list-md>
                                    <v-layout wrap>
                                        <v-flex xs12>
                                            <v-stepper v-model="step">
                                                <v-stepper-header>

                                                    <v-stepper-step 
                                                        step="1"
                                                        :complete="step > 1" 
                                                        editable
                                                        :rules="[() => !erroDadosAluno]"
                                                        >Dados do Aluno
                                                        <small v-if="erroDadosAluno">Existem erros, por favor verifique!</small>
                                                    </v-stepper-step>

                                                    <v-divider></v-divider>

                                                    <v-stepper-step
                                                        step="2"
                                                        :complete="aluno.id != null && aluno.ativo == true"
                                                        :editable="aluno.id != null && aluno.ativo == true"
                                                        edit-icon="fa fa-calendar"
                                                        >Períodos
                                                </v-stepper-step>

                                                <v-divider></v-divider>

                                                <v-stepper-step
                                                    step="3"
                                                    :complete="aluno.id != null && aluno.protocolo_alunos_professores && aluno.protocolo_alunos_professores.length > 0"
                                                    :editable="aluno.id != null && aluno.protocolo_alunos_professores && aluno.protocolo_alunos_professores.length > 0"
                                                    edit-icon="fa fa-users"
                                                    >Clientes
                                            </v-stepper-step>

                                            <v-divider></v-divider>

                                            <v-stepper-step
                                                step="4"
                                                :complete="aluno.id != null"
                                                :editable="aluno.id != null"
                                                edit-icon="playlist_add_check"
                                                >Observações
                                        </v-stepper-step>

                                        <v-divider></v-divider>

                                    </v-stepper-header>
                                    <v-stepper-items>
                                        <v-stepper-content step="1">
                                            <v-card>
                                                <v-card-text>
                                                    <v-card>
                                                        <v-card-text>
                                                            <v-container grid-list-md>
                                                                <v-layout wrap>

                                                                    <aluno-form 
                                                                        ref="alunoForm"
                                                                        v-model="aluno"
                                                                        ></aluno-form>

                                                                </v-layout>
                                                            </v-container>
                                                            <ul>
                                                                <li><small><span class="required">*</span> <b>(Asterisco)</b> Indica os campos que são obrigatórios</small></li>
                                                            </ul>   
                                                        </v-card-text>
                                                    </v-card>
                                                </v-card-text>
                                            </v-card>
                                        </v-stepper-content>
                                        <v-stepper-content step="2" v-if="aluno.id">
                                            <periodos-aluno-table 
                                                v-bind:idAluno="aluno.id"
                                                v-bind:nomeAluno="aluno.nome_completo"
                                                ></periodos-aluno-table>
                                        </v-stepper-content>
                                        <v-stepper-content step="3">
                                            <clientes-table v-model="aluno.protocolo_alunos_professores"></clientes-table>
                                            <small><b class="vermelho">Vermelho: </b>Indica os protocolos em que o aluno não está mais ativo</small>
                                        </v-stepper-content>
                                        <v-stepper-content step="4">
                                            <avaliacoes-table 
                                                v-model="aluno.avaliacoes" 
                                                v-bind:idAluno="aluno.id"
                                                v-bind:nomeAluno="aluno.nome_completo"
                                                >                                                        
                                            </avaliacoes-table>

                                            <ul>
                                                <li><small><b>Dica: </b>Clique na linha para expandir e visualizar mais informações</small></li>
                                            </ul>

                                        </v-stepper-content>
                                    </v-stepper-items>
                                </v-stepper>
                            </v-flex>
                        </v-layout>
                    </v-container>

                </v-card-text>
                <v-card-actions class="pt-0">
                    <v-spacer></v-spacer>

                    <v-btn color="green" flat="flat" type="submit">
                        Salvar
                        <v-icon right dark>check</v-icon>
                    </v-btn>

                    <v-btn color="blue" flat="flat" @click.native="clear" :disabled="aluno.id != null">
                           Limpar
                           <v-icon right dark>delete_sweep</v-icon>
                    </v-btn>

                    <v-btn color="red" flat="flat" @click.native="cancel">
                        Cancelar
                        <v-icon right dark>cancel</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-card-text>
</v-card>
</v-dialog>
</v-layout>
</template>

<script>
    import AlunoForm from "@/components/cadastro/forms/AlunoForm.vue";
    import PeriodosAlunoTable from "@/components/cadastro/tables/PeriodosAlunoTable.vue";
    import ClientesTable from "@/components/cadastro/tables/ClientesTable.vue";
    import AvaliacoesTable from "@/components/cadastro/tables/AvaliacoesTable.vue";

    export default {
        components: {
            AlunoForm,
            ClientesTable,
            AvaliacoesTable,
            PeriodosAlunoTable
        },
        data: () => ({
                aluno: {},
                dialog: false,
                resolve: null,
                reject: null,
                formTitle: null,
                erroDadosAluno: false,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 1000
                },
                step: 1
            }),
        methods: {
            open(title, item, options) {
                this.dialog = true;
                this.erroDadosAluno = false;
                this.formTitle = title;
                this.step = 1;
                this.aluno = item;
                this.$refs.alunoForm.$validator.errors.clear();
                this.$refs.alunoForm.$refs.autocompleteDisciplina.values = item.disciplina ? [item.disciplina] : [];
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            getFormData() {
                const formData = new FormData();
                if (this.aluno.id) {
                    formData.append('id', this.aluno.id);
                    formData.append('_method', 'PUT');
                }
                if (this.aluno.nome_completo) {
                    formData.append('nome_completo', this.aluno.nome_completo);
                }
                if (this.aluno.disciplina_id) {
                    formData.append('disciplina_id', this.aluno.disciplina_id);
                }
                if (this.aluno.celular) {
                    formData.append('celular', this.aluno.celular);
                }
                if (this.aluno.telefone) {
                    formData.append('telefone', this.aluno.telefone);
                }
                if (this.aluno.observacoes) {
                    formData.append('observacoes', this.aluno.observacoes);
                }
                if (this.aluno.matricula) {
                    formData.append('matricula', this.aluno.matricula);
                }
                if (this.aluno.email) {
                    formData.append('email', this.aluno.email);
                }
                formData.append('ativo', this.aluno.ativo ? 1 : 0);
                if (this.aluno.imageFile) {
                    formData.append('image_url', this.aluno.imageFile);
                }
                if (this.aluno.avatar_id) {
                    formData.append('avatar_id', this.aluno.avatar_id);
                }
                return formData;
            },
            save() {
                this.$refs.alunoForm.erroAvatar = null;
                this.$refs.alunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newAluno", this.getFormData())
                                .then((resp) => {
                                    this.resolve(true);
                                    this.aluno = resp.data;
                                    this.step = 2;
                                    this.erroDadosAluno = false;
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                        return;
                    }
                    this.erroDadosAluno = true;
                });
            },
            update() {
                this.$refs.alunoForm.erroAvatar = null;
                this.$refs.alunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateAluno", this.getFormData())
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.aluno = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                        return;
                    }
                    this.erroDadosAluno = true;
                });
            },
            cancel() {
                this.resolve(false);
                this.dialog = false;
                this.$refs.alunoForm.aluno = {};
                this.$refs.alunoForm.$validator.errors.clear();
            },
            clear() {
                this.aluno = {};
                this.$refs.alunoForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome_completo) {
                    this.$refs.alunoForm.$validator.errors.add({field: 'Nome Completo', msg: resp.response.data.errors.nome_completo});
                }
                if (resp.response.data.errors.email) {
                    this.$refs.alunoForm.$validator.errors.add({field: 'E-mail', msg: resp.response.data.errors.email});
                }
                if (resp.response.data.errors.disciplina_id) {
                    this.$refs.alunoForm.$validator.errors.add({field: 'Disciplina', msg: resp.response.data.errors.disciplina_id});
                }
                if (resp.response.data.errors.image_url) {
                    this.$refs.alunoForm.erroAvatar = resp.response.data.errors.image_url[0];
                }
            }
        }
    };
</script>