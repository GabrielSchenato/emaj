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
                    <v-card>
                        <v-toolbar card prominent extended color="primary" dark extension-height="15px">
                            <v-toolbar-title class="headline"></v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <form>
                                <v-container grid-list-md>
                                    <v-layout wrap>
                                        <v-flex xs12>
                                            <v-stepper v-model="step">
                                                <v-stepper-header>
                                                    <v-stepper-step step="1" :complete="step > 1" editable>Dados do Cliente</v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="2"
                                                        :complete="step > 2 || informacoesPessoais.id != null"
                                                        :editable="step > 2 || informacoesPessoais.id != null"
                                                        >Endereço</v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="3"
                                                        :complete="step > 3 || informacoesPessoais.id != null"
                                                        :editable="step > 3 || informacoesPessoais.id != null"
                                                        >Composição Familiar</v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="4"
                                                        :complete="step > 4 || informacoesPessoais.id != null"
                                                        :editable="step > 4 || informacoesPessoais.id != null"
                                                        >Telefones</v-stepper-step>
                                                </v-stepper-header>
                                                <v-stepper-items>
                                                    <v-stepper-content step="1">
                                                        <v-card>
                                                            <v-card-text>
                                                                <v-card>
                                                                    <v-card-text>
                                                                        <v-container grid-list-md>
                                                                            <v-layout wrap>
                                                                                <informacoes-pessoais-form
                                                                                    ref="informacoesPessoaisForm"
                                                                                    v-model="informacoesPessoais"
                                                                                    :getConfig="getConfig"
                                                                                    ></informacoes-pessoais-form>
                                                                            </v-layout>
                                                                        </v-container>
                                                                        <small>*Indica os campos que são obrigatórios</small>
                                                                    </v-card-text>
                                                                </v-card>
                                                            </v-card-text>
                                                        </v-card>
                                                        <v-card-actions class="pt-0">
                                                            <v-spacer></v-spacer>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <v-btn color="blue" dark @click.native="informacoesPessoaisClear" :disabled="informacoesPessoais.id != null">
                                                                Limpar
                                                                <v-icon right dark>delete_sweep</v-icon>
                                                            </v-btn>
                                                            <v-btn color="primary" @click.native="informacoesPessoaisContinue">
                                                                Continuar
                                                                <v-icon right dark>arrow_forward</v-icon>
                                                            </v-btn>
                                                        </v-card-actions>
                                                    </v-stepper-content>
                                                    <v-stepper-content step="2">
                                                        <v-card>
                                                            <v-card-text>
                                                                <v-card>
                                                                    <v-card-text>
                                                                        <form>
                                                                            <v-container grid-list-md>
                                                                                <v-layout wrap>
                                                                                    <endereco-form
                                                                                        ref="enderecoForm"
                                                                                        v-model="endereco"    
                                                                                        :getConfig="getConfig"
                                                                                        >                                                                                </endereco-form>
                                                                                </v-layout>
                                                                            </v-container>
                                                                        </form>
                                                                        <small>*Indica os campos que são obrigatórios</small>
                                                                    </v-card-text>
                                                                </v-card>
                                                            </v-card-text>
                                                        </v-card>
                                                        <v-card-actions class="pt-0">
                                                            <v-spacer></v-spacer>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <v-btn color="blue" dark @click.native="enderecoClear" :disabled="endereco.id != null">
                                                                Limpar
                                                                <v-icon right dark>delete_sweep</v-icon>
                                                            </v-btn>
                                                            <v-btn color="blue-grey darken-1" dark @click.native="step = 1">
                                                                Voltar
                                                                <v-icon right dark>arrow_back</v-icon>
                                                            </v-btn>
                                                            <v-btn color="primary" @click.native="enderecoContinue">
                                                                Continuar
                                                                <v-icon right dark>arrow_forward</v-icon>
                                                            </v-btn>
                                                        </v-card-actions>
                                                    </v-stepper-content>
                                                    <v-stepper-content step="3">
                                                        <v-card>
                                                            <v-card-text>
                                                                <v-card>
                                                                    <v-card-text>
                                                                        <form>
                                                                            <v-container grid-list-md>
                                                                                <v-layout wrap>
                                                                                    <composicao-familiar-form
                                                                                        ref="composicaoFamiliarForm"
                                                                                        v-model="composicaoFamiliar"
                                                                                        :getConfig="getConfig"
                                                                                        ></composicao-familiar-form>
                                                                                </v-layout>
                                                                            </v-container>
                                                                        </form>
                                                                        <small>*Indica os campos que são obrigatórios</small>
                                                                    </v-card-text>
                                                                </v-card>
                                                            </v-card-text>
                                                        </v-card>
                                                        <v-card-actions class="pt-0">
                                                            <v-spacer></v-spacer>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <v-btn color="blue" dark @click.native="composicaoFamiliarClear" :disabled="composicaoFamiliar.id != null">
                                                                Limpar
                                                                <v-icon right dark>delete_sweep</v-icon>
                                                            </v-btn>
                                                            <v-btn color="blue-grey darken-1" dark @click.native="step = 2">
                                                                Voltar
                                                                <v-icon right dark>arrow_back</v-icon>
                                                            </v-btn>
                                                            <v-btn color="primary" @click.native="composicaoFamiliarContinue">
                                                                Continuar
                                                                <v-icon right dark>arrow_forward</v-icon>
                                                            </v-btn>
                                                        </v-card-actions>
                                                    </v-stepper-content>

                                                    <v-stepper-content step="4">
                                                        <v-card>
                                                            <v-card-text>
                                                                <v-card>
                                                                    <v-card-text>
                                                                        <form>
                                                                            <v-container grid-list-md>
                                                                                <v-layout wrap>
                                                                                    <telefones-table v-model="telefones"></telefones-table>
                                                                                </v-layout>
                                                                            </v-container>
                                                                        </form>
                                                                    </v-card-text>
                                                                </v-card>
                                                            </v-card-text>
                                                        </v-card>
                                                        <v-card-actions class="pt-0">
                                                            <v-spacer></v-spacer>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <v-btn color="blue-grey darken-1" dark @click.native="step = 3">
                                                                Voltar
                                                                <v-icon right dark>arrow_back</v-icon>
                                                            </v-btn>
                                                        </v-card-actions>
                                                    </v-stepper-content>
                                                </v-stepper-items>
                                            </v-stepper>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </form>
                        </v-card-text>
                        <v-card-actions class="pt-0">
                            <v-spacer></v-spacer>

                            <v-btn color="green" flat="flat" @click.native="informacoesPessoais.id != null ? update() : save()" :disabled="step != 4 && informacoesPessoais.id == null">
                                   Salvar
                                   <v-icon right dark>check</v-icon>
                            </v-btn>

                            <v-btn color="red" flat="flat" @click.native="cancel">
                                Cancelar
                                <v-icon right dark>cancel</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    import Vue from "vue";
    import VeeValidate from "vee-validate";
    import InformacoesPessoaisForm from "@/components/cadastro/forms/InformacoesPessoaisForm.vue";
    import EnderecoForm from "@/components/cadastro/forms/EnderecoForm.vue";
    import ComposicaoFamiliarForm from "@/components/cadastro/forms/ComposicaoFamiliarForm.vue";
    import TelefonesTable from "@/components/cadastro/tables/TelefonesTable.vue";

    Vue.use(VeeValidate);

    export default {
        name: "cliente-dialog",
        components: {
            InformacoesPessoaisForm,
            EnderecoForm,
            ComposicaoFamiliarForm,
            TelefonesTable
        },
        $_veeValidate: {
            validator: "new"
        },
        data: () => ({
                informacoesPessoais: {},
                endereco: {},
                composicaoFamiliar: {},
                telefones: [],
                dialog: false,
                resolve: null,
                reject: null,
                step: 1,
                formTitle: null,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 500
                }
            }),
        methods: {
            getConfig() {
                return {
                    required: !this.informacoesPessoais.parte_contraria,
                    asterisco: this.informacoesPessoais.parte_contraria ? '' : '*'
                };
            },
            informacoesPessoaisContinue() {
                this.$refs.informacoesPessoaisForm.$validator
                        .validateAll()
                        .then(valid => {
                            if (valid) {
                                this.step = 2;
                            }
                        });
            },
            enderecoContinue() {
                this.$refs.enderecoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.step = 3;
                    }
                });
            },
            composicaoFamiliarContinue() {
                this.$refs.composicaoFamiliarForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.step = 4;
                    }
                });
            },
            informacoesPessoaisClear() {
                this.informacoesPessoais = {};
                this.$refs.informacoesPessoaisForm.$validator.errors.clear();
            },
            enderecoClear() {
                this.endereco = {};
                this.$refs.enderecoForm.$validator.errors.clear();
            },
            composicaoFamiliarClear() {
                this.composicaoFamiliar = {};
                this.$refs.composicaoFamiliarForm.$validator.errors.clear();
            },
            open(title, item, options) {
                this.dialog = true;
                this.formTitle = title;
                this.$refs.informacoesPessoaisForm.$validator.errors.clear();
                this.$refs.enderecoForm.$validator.errors.clear();
                this.$refs.composicaoFamiliarForm.$validator.errors.clear();
                this.informacoesPessoais = item.informacoesPessoais;
                this.endereco = item.endereco;
                this.composicaoFamiliar = item.composicaoFamiliar;
                this.telefones = item.telefones;
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                try {
                    this.validaDados();
                    let dados = {
                        informacoesPessoais: this.informacoesPessoais,
                        endereco: this.endereco,
                        composicaoFamiliar: this.composicaoFamiliar,
                        telefones: this.telefones
                    };

                    this.$store
                            .dispatch("newCliente", dados)
                            .then(() => {
                                this.resolve(true);
                                this.dialog = false;
                                this.informacoesPessoais = {};
                                this.endereco = {};
                                this.composicaoFamiliar = {};
                                this.telefones = [];
                                this.step = 1;
                                this.$store.dispatch("getClientes");
                                window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                            }).catch((resp) => {
                        this.addErrors(resp);
                    });
                } catch (e) {
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! ' + e, timeout: 3000});
                }
            },
            update() {
                try {
                    this.validaDados();
                    let dados = {
                        informacoesPessoais: this.informacoesPessoais,
                        endereco: this.endereco,
                        composicaoFamiliar: this.composicaoFamiliar,
                        telefones: this.telefones
                    };
                    this.$store
                            .dispatch("updateCliente", dados)
                            .then(() => {
                                this.resolve(true);
                                this.dialog = false;
                                this.informacoesPessoais = {};
                                this.endereco = {};
                                this.composicaoFamiliar = {};
                                this.telefones = [];
                                this.step = 1;
                                this.$store.dispatch("getClientes");
                                window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                            }).catch((resp) => {
                        this.addErrors(resp);
                    });
                } catch (e) {
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! ' + e, timeout: 3000});
                }
            },
            cancel() {
                this.informacoesPessoais = {};
                this.endereco = {};
                this.composicaoFamiliar = {};
                this.telefones = [];
                this.step = 1;
                this.resolve(false);
                this.dialog = false;
                this.$refs.informacoesPessoaisForm.$validator.errors.clear();
                this.$refs.enderecoForm.$validator.errors.clear();
                this.$refs.composicaoFamiliarForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.nome) {
                    this.$refs.tipoDemandaForm.$validator.errors.add({field: 'nome', msg: resp.response.data.errors.nome});
                }
                if (resp.response.data.errors.descricao) {
                    this.$refs.tipoDemandaForm.$validator.errors.add({field: 'descrição', msg: resp.response.data.errors.descricao});
                }
            },
            validaDados() {
                this.$refs.informacoesPessoaisForm.$validator
                        .validateAll()
                        .then(valid => {
                            if (!valid) {
                                throw 'Verifique os dados na seção Dados do Cliente!';
                            }
                        });

                this.$refs.enderecoForm.$validator.validateAll().then(valid => {
                    if (!valid) {
                        throw 'Verifique os dados na seção Endereço!';
                    }
                });

                this.$refs.composicaoFamiliarForm.$validator.validateAll().then(valid => {
                    if (!valid) {
                        throw 'Verifique os dados na seção Composição Familiar!';
                    }
                });
                
                if (this.informacoesPessoais.parte_contraria == 0 && this.telefones.length == 0) {
                    throw 'É necessário inserir pelo menos um telefone!';
                }
            }
        }
    };
</script>