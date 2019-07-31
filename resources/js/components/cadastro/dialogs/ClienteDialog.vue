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
                                                    <v-stepper-step 
                                                        step="1"
                                                        :complete="step > 1" editable
                                                        :rules="[() => !erroInformacoesPessoais]"
                                                        >Dados do Cliente
                                                        <small v-if="erroInformacoesPessoais">Existem erros, por favor verifique!</small>
                                                    </v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="2"
                                                        :complete="step > 2 || informacoesPessoais.id != null"
                                                        :editable="step > 2 || informacoesPessoais.id != null"
                                                        :rules="[() => !erroEndereco]"
                                                        >Endereço
                                                        <small v-if="erroEndereco">Existem erros, por favor verifique!</small>
                                                    </v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="3"
                                                        :complete="step > 3 || informacoesPessoais.id != null"
                                                        :editable="step > 3 || informacoesPessoais.id != null"
                                                        :rules="[() => !erroComposicaoFamiliar]"
                                                        >Composição Familiar
                                                        <small v-if="erroComposicaoFamiliar">Existem erros, por favor verifique!</small>
                                                    </v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="4"
                                                        :complete="step > 4 || informacoesPessoais.id != null"
                                                        :editable="step > 4 || informacoesPessoais.id != null"
                                                        :rules="[() => !erroTelefones]"
                                                        >Telefones
                                                        <small v-if="erroTelefones">Existem erros, por favor verifique!</small>
                                                    </v-stepper-step>
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
                                                            <v-btn color="blue" :dark="informacoesPessoais.id == null" @click.native="informacoesPessoaisClear" :disabled="informacoesPessoais.id != null">
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
                                                                                        >                                                                                
                                                                                    </endereco-form>
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
                                                            <v-btn color="blue" :dark="informacoesPessoais.id == null" @click.native="enderecoClear" :disabled="endereco.id != null">
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
                                                            <v-btn color="blue" :dark="informacoesPessoais.id == null" @click.native="composicaoFamiliarClear" :disabled="composicaoFamiliar.id != null">
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
                erroInformacoesPessoais: false,
                erroEndereco: false,
                erroComposicaoFamiliar: false,
                erroTelefones: false,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 500
                }
            }),
        methods: {
            getConfig() {
                return {
                    required: !this.required(),
                    asterisco: this.asterisco()
                };
            },
            required() {
                if (this.informacoesPessoais.parte_contraria) {
                    return false;
                } else if (this.informacoesPessoais.pre_atendimento) {
                    return false;
                }
                return true;
            },
            asterisco() {
                if (this.informacoesPessoais.parte_contraria) {
                    return '';
                } else if (this.informacoesPessoais.pre_atendimento) {
                    return '';
                }
                return '*';
            },
            informacoesPessoaisContinue() {
                let isValidForm = true;
                this.$refs.informacoesPessoaisForm.$refs.moneyRenda.required = this.getConfig().required;
                this.$refs.informacoesPessoaisForm.$validator
                        .validateAll()
                        .then(valid => {
                            isValidForm = valid;
                            this.$refs.informacoesPessoaisForm.$refs.moneyRenda.$validator.validate('renda')
                                    .then(isValidRenda => {

                                        if (!isValidForm || !isValidRenda)
                                            return;

                                        this.step = 2;
                                        this.erroInformacoesPessoais = false;
                                    });

                        });
            },
            enderecoContinue() {
                this.$refs.enderecoForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.step = 3;
                        this.erroEndereco = false;
                    }
                });
            },
            composicaoFamiliarContinue() {
                let isValidForm = true;
                let isValidValorPatrimonio = true;

                this.$refs.composicaoFamiliarForm.$refs.moneyValorPatrimonio.required = this.getConfig().required;
                this.$refs.composicaoFamiliarForm.$refs.moneyRendaFamiliar.required = this.getConfig().required;
                this.$refs.composicaoFamiliarForm.$validator.validateAll().then(valid => {
                    isValidForm = valid;

                    this.$refs.composicaoFamiliarForm.$refs.moneyValorPatrimonio.$validator.validate('valor do patrimônio')
                            .then(valid => {
                                isValidValorPatrimonio = valid;
                                this.$refs.composicaoFamiliarForm.$refs.moneyRendaFamiliar.$validator.validate('renda familiar')
                                        .then(isValidRendaFamiliar => {
                                            if (!isValidForm || !isValidValorPatrimonio || !isValidRendaFamiliar)
                                                return;
                                            this.step = 4;
                                            this.erroComposicaoFamiliar = false;
                                        });
                            });
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
                this.erroInformacoesPessoais = false;
                this.erroEndereco = false;
                this.erroComposicaoFamiliar = false;
                this.erroTelefones = false;
                this.$refs.informacoesPessoaisForm.$validator.reset();
                this.$refs.informacoesPessoaisForm.$refs.moneyRenda.$validator.reset();
                this.$refs.enderecoForm.$validator.reset();
                this.$refs.composicaoFamiliarForm.$validator.reset();
                this.$refs.composicaoFamiliarForm.$refs.moneyValorPatrimonio.$validator.reset();
                this.$refs.composicaoFamiliarForm.$refs.moneyRendaFamiliar.$validator.reset();
                this.$refs.informacoesPessoaisForm.nacionalidades = item.nacionalidade ? [item.nacionalidade] : [{id: 7, nome: 'Brasileiro'}];
                this.informacoesPessoais = item;
                this.endereco = item.endereco;
                this.composicaoFamiliar = item.composicao_familiar;
                this.telefones = item.telefones;
                this.step = 1;
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                try {
                    this.validaTelefones();
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
                    this.validaTelefones();
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
                                window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                            }).catch((resp) => {
                        this.addErrors(resp);
                    });
                } catch (e) {
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! ' + e, timeout: 3000});
                }
            },
            cancel() {
                this.erroInformacoesPessoais = false;
                this.erroEndereco = false;
                this.erroComposicaoFamiliar = false;
                this.erroTelefones = false;
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
                if (resp.response.data.errors) {
                    this.step = 1;
                    this.erroInformacoesPessoais = true;
                    if (resp.response.data.errors.nome_completo) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'nome completo', msg: resp.response.data.errors.nome_completo});
                    }
                    if (resp.response.data.errors.cpf) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'CPF', msg: resp.response.data.errors.cpf});
                    }
                    if (resp.response.data.errors.rg) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'RG', msg: resp.response.data.errors.rg});
                    }
                    if (resp.response.data.errors.profissao) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'profissão', msg: resp.response.data.errors.profissao});
                    }
                    if (resp.response.data.errors.sexo) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'Sexo', msg: resp.response.data.errors.sexo});
                    }
                    if (resp.response.data.errors.estado_civil) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'estado civil', msg: resp.response.data.errors.estado_civil});
                    }
                    if (resp.response.data.errors.email) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'e-mail', msg: resp.response.data.errors.email});
                    }
                    if (resp.response.data.errors.renda) {
                        this.$refs.informacoesPessoaisForm.$refs.moneyRenda.$validator.errors.add({field: 'renda', msg: resp.response.data.errors.renda});
                    }
                    if (resp.response.data.errors.local_trabalho) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'local de trabalho', msg: resp.response.data.errors.local_trabalho});
                    }
                    if (resp.response.data.errors.nacionalidade_id) {
                        this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'nacionalidade', msg: resp.response.data.errors.nacionalidade_id});
                    }
                }

                if (resp.response.data.errors) {
                    this.step = 2;
                    this.erroEndereco = true;
                    if (resp.response.data.errors.bairro) {
                        this.$refs.enderecoForm.$validator.errors.add({field: 'bairro', msg: resp.response.data.errors.bairro});
                    }
                    if (resp.response.data.errors.cep) {
                        this.$refs.enderecoForm.$validator.errors.add({field: 'CEP', msg: resp.response.data.errors.cep});
                    }
                    if (resp.response.data.errors.numero) {
                        this.$refs.enderecoForm.$validator.errors.add({field: 'número', msg: resp.response.data.errors.numero});
                    }
                    if (resp.response.data.errors.localidade) {
                        this.$refs.enderecoForm.$validator.errors.add({field: 'cidade', msg: resp.response.data.errors.localidade});
                    }
                    if (resp.response.data.errors.logradouro) {
                        this.$refs.enderecoForm.$validator.errors.add({field: 'logradouro', msg: resp.response.data.errors.logradouro});
                    }
                    if (resp.response.data.errors.uf) {
                        this.$refs.enderecoForm.$validator.errors.add({field: 'estado', msg: resp.response.data.errors.uf});
                    }
                }

                if (resp.response.data.errors) {
                    this.step = 3;
                    this.erroComposicaoFamiliar = true;
                    if (resp.response.data.errors.renda_familiar) {
                        this.$refs.composicaoFamiliarForm.$refs.moneyRendaFamiliar.$validator.errors.add({field: 'renda familiar', msg: resp.response.data.errors.renda_familiar});
                    }
                    if (resp.response.data.errors.casa) {
                        this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'casa', msg: resp.response.data.errors.casa});
                    }
                    if (resp.response.data.errors.outros_bens) {
                        this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'outros bens', msg: resp.response.data.errors.outros_bens});
                    }
                    if (resp.response.data.errors.dividas) {
                        this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'dívidas', msg: resp.response.data.errors.dividas});
                    }
                    if (resp.response.data.errors.despesas) {
                        this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'despesas', msg: resp.response.data.errors.despesas});
                    }
                    if (resp.response.data.errors.valor_patrimonio) {
                        this.$refs.composicaoFamiliarForm.$refs.moneyValorPatrimonio.$validator.errors.add({field: 'valor do patrimônio', msg: resp.response.data.errors.valor_patrimonio});
                    }
                }
            },
            validaTelefones() {

                if (this.required() && this.telefones.length == 0) {
                    this.step = 4;
                    this.erroTelefones = true;
                    throw 'É necessário inserir pelo menos um telefone!';
                }
                this.erroTelefones = false;
            }
        }
    };
</script>