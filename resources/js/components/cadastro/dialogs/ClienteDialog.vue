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
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="5"
                                                        :complete="step > 5 || informacoesPessoais.id != null"
                                                        :editable="step > 5 || informacoesPessoais.id != null"
                                                        >Protocolos
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

                                                    <v-stepper-content step="5" v-if="informacoesPessoais.id">
                                                        <v-card>
                                                            <v-card-text>
                                                                <protocolos-table
                                                                    v-bind:idCliente="informacoesPessoais.id"
                                                                    v-bind:nomeCliente="informacoesPessoais.nome_completo"
                                                                    v-bind:nomeRepresentadoAssistido="informacoesPessoais.representado_assistido"
                                                                    >
                                                                </protocolos-table>
                                                                
                                                                <ul>
                                                                    <li><small><b class="vermelho">Vermelho: </b>Indica os protocolos que foram arquivados/inativados</small></li>
                                                                    <li><small><b class="azul">Azul: </b>Destaca quando um protocolo possui uma Parte Contrária</small></li>
                                                                </ul>

                                                            </v-card-text>
                                                        </v-card>
                                                        <v-card-actions class="pt-0">
                                                            <v-spacer></v-spacer>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <v-btn color="blue-grey darken-1" dark @click.native="step = 4">
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
    import InformacoesPessoaisForm from "@/components/cadastro/forms/InformacoesPessoaisForm.vue";
    import EnderecoForm from "@/components/cadastro/forms/EnderecoForm.vue";
    import ComposicaoFamiliarForm from "@/components/cadastro/forms/ComposicaoFamiliarForm.vue";
    import TelefonesTable from "@/components/cadastro/tables/TelefonesTable.vue";
    import ProtocolosTable from "@/components/cadastro/tables/ProtocolosTable.vue";

    export default {
        name: "cliente-dialog",
        components: {
            InformacoesPessoaisForm,
            EnderecoForm,
            ComposicaoFamiliarForm,
            TelefonesTable,
            ProtocolosTable
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
                    required: this.required(),
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
                this.$refs.informacoesPessoaisForm.$validator.errors.clear();
                this.$refs.informacoesPessoaisForm.$refs.moneyRenda.$validator.errors.clear();
                this.$refs.enderecoForm.$validator.errors.clear();
                this.$refs.composicaoFamiliarForm.$validator.errors.clear();
                this.$refs.composicaoFamiliarForm.$refs.moneyValorPatrimonio.$validator.errors.clear();
                this.$refs.composicaoFamiliarForm.$refs.moneyRendaFamiliar.$validator.errors.clear();
                this.$refs.informacoesPessoaisForm.nacionalidades = item.nacionalidade ? [item.nacionalidade] : [{id: 7, nome: 'BRASILEIRO'}];
                this.informacoesPessoais = item;
                this.endereco = item.endereco ? item.endereco : {};
                this.composicaoFamiliar = item.composicao_familiar ? item.composicao_familiar : {};
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
                        this.addErrors(resp.response.data);
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
                        this.addErrors(resp.response.data);
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
            addErrors(data) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (data.errors.cliente) {
                    this.addErrorsCliente(data);
                }
                if (data.errors.endereco) {
                    this.addErrorsEndereco(data);
                }
                if (data.errors.composicao_familiar) {
                    this.addErrorsComposicaoFamiliar(data);
                }
            },
            validaTelefones() {
                if (this.required() && this.telefones.length == 0) {
                    this.step = 4;
                    this.erroTelefones = true;
                    throw 'É necessário inserir pelo menos um telefone!';
                }
                this.erroTelefones = false;
            },
            addErrorsCliente(data) {
                this.step = 1;
                this.erroInformacoesPessoais = true;
                if (data.errors.cliente.nome_completo) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'nome completo', msg: data.errors.cliente.nome_completo});
                }
                if (data.errors.cliente.cpf) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'CPF', msg: data.errors.cliente.cpf});
                }
                if (data.errors.cliente.rg) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'RG', msg: data.errors.cliente.rg});
                }
                if (data.errors.cliente.profissao) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'profissão', msg: data.errors.cliente.profissao});
                }
                if (data.errors.cliente.sexo) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'sexo', msg: data.errors.cliente.sexo});
                }
                if (data.errors.cliente.estado_civil) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'estado civil', msg: data.errors.cliente.estado_civil});
                }
                if (data.errors.cliente.email) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'e-mail', msg: data.errors.cliente.email});
                }
                if (data.errors.cliente.renda) {
                    this.$refs.informacoesPessoaisForm.$refs.moneyRenda.$validator.errors.add({field: 'renda', msg: data.errors.cliente.renda});
                }
                if (data.errors.cliente.local_trabalho) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'local de trabalho', msg: data.errors.cliente.local_trabalho});
                }
                if (data.errors.cliente.nacionalidade_id) {
                    this.$refs.informacoesPessoaisForm.$validator.errors.add({field: 'nacionalidade', msg: data.errors.cliente.nacionalidade_id});
                }

            },
            addErrorsEndereco(data) {
                this.step = 2;
                this.erroEndereco = true;
                if (data.errors.endereco.bairro) {
                    this.$refs.enderecoForm.$validator.errors.add({field: 'bairro', msg: data.errors.endereco.bairro});
                }
                if (data.errors.endereco.cep) {
                    this.$refs.enderecoForm.$validator.errors.add({field: 'CEP', msg: data.errors.endereco.cep});
                }
                if (data.errors.endereco.numero) {
                    this.$refs.enderecoForm.$validator.errors.add({field: 'número', msg: data.errors.endereco.numero});
                }
                if (data.errors.endereco.localidade) {
                    this.$refs.enderecoForm.$validator.errors.add({field: 'cidade', msg: data.errors.endereco.localidade});
                }
                if (data.errors.endereco.logradouro) {
                    this.$refs.enderecoForm.$validator.errors.add({field: 'logradouro', msg: data.errors.endereco.logradouro});
                }
                if (data.errors.endereco.uf) {
                    this.$refs.enderecoForm.$validator.errors.add({field: 'estado', msg: data.errors.endereco.uf});
                }

            },
            addErrorsComposicaoFamiliar(data) {
                this.step = 3;
                this.erroComposicaoFamiliar = true;
                if (data.errors.composicao_familiar.renda_familiar) {
                    this.$refs.composicaoFamiliarForm.$refs.moneyRendaFamiliar.$validator.errors.add({field: 'renda familiar', msg: data.errors.composicao_familiar.renda_familiar});
                }
                if (data.errors.composicao_familiar.casa) {
                    this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'casa', msg: data.errors.composicao_familiar.casa});
                }
                if (data.errors.composicao_familiar.outros_bens) {
                    this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'outros bens', msg: data.errors.composicao_familiar.outros_bens});
                }
                if (data.errors.composicao_familiar.dividas) {
                    this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'dívidas', msg: data.errors.composicao_familiar.dividas});
                }
                if (data.errors.composicao_familiar.despesas) {
                    this.$refs.composicaoFamiliarForm.$validator.errors.add({field: 'despesas', msg: data.errors.composicao_familiar.despesas});
                }
                if (data.errors.composicao_familiar.valor_patrimonio) {
                    this.$refs.composicaoFamiliarForm.$refs.moneyValorPatrimonio.$validator.errors.add({field: 'valor do patrimônio', msg: data.errors.composicao_familiar.valor_patrimonio});
                }

            }
        }
    };
</script>