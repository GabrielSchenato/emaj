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
                                                        >Dados do Aluno
                                                    </v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="2"
                                                        :complete="aluno.id != null && aluno.protocolo_alunos_professores.length > 0"
                                                        :editable="aluno.id != null && aluno.protocolo_alunos_professores.length > 0"
                                                        edit-icon="fa fa-users"
                                                        >Clientes
                                                </v-stepper-step>
                                                <v-divider></v-divider>
                                                <v-stepper-step
                                                    step="3"
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
                                                                <small>*Indica os campos que são obrigatórios</small>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-card-text>
                                                </v-card>
                                            </v-stepper-content>
                                            <v-stepper-content step="2">
                                                <clientes-table v-model="aluno.protocolo_alunos_professores"></clientes-table>
                                                <small><b class="vermelho">Vermelho: </b>Indica os processos que foram arquivados/inativados</small>
                                            </v-stepper-content>
                                            <v-stepper-content step="3">
                                                <avaliacoes-table 
                                                    v-model="aluno.avaliacoes" 
                                                    v-bind:idAluno="aluno.id"
                                                    v-bind:nomeAluno="aluno.nome_completo"
                                                    >                                                        
                                                </avaliacoes-table>

                                                <ul>
                                                    <li><small><b class="vermelho">Vermelho: </b>Indica os protocolos que foram arquivados/inativados</small></li>
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
    import ClientesTable from "@/components/cadastro/tables/ClientesTable.vue";
    import AvaliacoesTable from "@/components/cadastro/tables/AvaliacoesTable.vue";

    export default {
        components: {
            AlunoForm,
            ClientesTable,
            AvaliacoesTable
        },
        data: () => ({
                aluno: {},
                dialog: false,
                resolve: null,
                reject: null,
                formTitle: null,
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
                this.formTitle = title;
                this.step = 1;
                this.aluno = item;
                this.$refs.alunoForm.$validator.errors.clear();
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.alunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newAluno", this.aluno)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.aluno = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });


                    }
                });
            },
            update() {
                this.$refs.alunoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateAluno", this.aluno)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.aluno = {};
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
                this.aluno = {};
                this.$refs.alunoForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome_completo) {
                    this.$refs.alunoForm.$validator.errors.add({field: 'nome completo', msg: resp.response.data.errors.nome_completo});
                }
                if (resp.response.data.errors.email) {
                    this.$refs.alunoForm.$validator.errors.add({field: 'e-mail', msg: resp.response.data.errors.email});
                }
            }
        }
    };
</script>