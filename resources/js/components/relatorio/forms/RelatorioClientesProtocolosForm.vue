<template>
    <v-form @submit.prevent="gerar()">
        <v-card>
            <v-toolbar card prominent extended color="blue-grey darken-2" dark extension-height="15px">
                <v-toolbar-title class="headline">Relatório de Clientes e Protocolos</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>

                <fieldset>
                    <legend>Filtros</legend>
                    <v-layout row wrap>
                        <v-flex xs12 sm6 md2>
                            <data-field
                                ref="dataInicial" 
                                v-bind:errorMessages="errors.collect(optionsDataInicial.name)"
                                :data-vv-name="optionsDataInicial.name"
                                v-validate="{required: optionsDataInicial.required }"
                                v-bind:options="optionsDataInicial"
                                v-model="relClientesProtoclos.data_inicial"
                                @input="$emit('input', relClientesProtoclos)"
                                >                                    
                            </data-field>
                        </v-flex>
                        <v-flex xs12 sm6 md2>
                            <data-field
                                ref="dataFinal" 
                                v-bind:errorMessages="errors.collect(optionsDataFinal.name)"
                                :data-vv-name="optionsDataFinal.name"
                                v-validate="{required: optionsDataFinal.required }"
                                v-bind:options="optionsDataFinal"
                                v-model="relClientesProtoclos.data_final"
                                @input="$emit('input', relClientesProtoclos)"
                                >                                    
                            </data-field>
                        </v-flex>

                        <v-flex xs12 sm6 md12>   
                            <autocomplete-field
                                ref="autocompleteCliente"
                                v-bind:errorMessages="errors.collect(optionsCliente.name)"
                                :data-vv-name="optionsCliente.name"
                                v-validate="{required: optionsCliente.required }"
                                v-bind:options="optionsCliente"
                                v-model="relClientesProtoclos.cliente_id"
                                @input="$emit('input', relClientesProtoclos)"
                                ></autocomplete-field>
                        </v-flex>

                        <select-ativo-field 
                            v-model="relClientesProtoclos.ativo">                        
                        </select-ativo-field>

                    </v-layout>            
                </fieldset>

                <relatorio-configuracoes-form 
                    v-model="relClientesProtoclos" 
                    v-bind:tipoRelatorio="false">                        
                </relatorio-configuracoes-form>


            </v-card-text>
            <v-divider light></v-divider>
            <v-card-actions class="pt-3"> 

                <v-btn color="blue-grey darken-4" large round @click.native="gerar" class="font-white">Gerar
                    <v-icon right>cloud_download</v-icon>
                </v-btn>

                <v-spacer></v-spacer>
                <ul>
                    <li><small><span class="required">*</span> <b>(Asterisco)</b> Indica os campos que são obrigatórios</small></li>
                </ul>  
            </v-card-actions>
        </v-card>
    </v-form>
</template>
<script>
    export default {
        name: "relatorio-clientes-protocolos-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                relClientesProtoclos: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsDataInicial() {
                return {
                    name: 'Data Inicial',
                    required: false,
                    max: this.relClientesProtoclos.data_final
                };
            },
            optionsDataFinal() {
                return {
                    name: 'Data Final',
                    required: false,
                    min: this.relClientesProtoclos.data_inicial

                };
            },
            optionsCliente() {
                return {
                    field: 'cliente_id',
                    required: false,
                    itemText: 'dados_cliente',
                    name: 'Cliente',
                    url: 'relclientesprotocolos/autocomplete',
                    returnObject: true,
                    multiple: true,
                    cacheItems: true
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.relClientesProtoclos = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            gerar() {
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.gerarImpressao(this.relClientesProtoclos, "/relclientesprotocolos");
                    }
                });
            }
        }
    };
</script>