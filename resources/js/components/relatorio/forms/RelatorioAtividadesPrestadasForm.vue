<template>
    <v-card>
        <v-toolbar card prominent extended color="blue-grey darken-2" dark extension-height="15px">
            <v-toolbar-title class="headline">Relatório das Atividades Prestadas pelo Escritório Modelo</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>

            <v-form> 
                <div>
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
                                    v-model="relAtividadesPrestadas.data_inicial"
                                    @input="$emit('input', relAtividadesPrestadas)"
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
                                    v-model="relAtividadesPrestadas.data_final"
                                    @input="$emit('input', relAtividadesPrestadas)"
                                    >                                    
                                </data-field>
                            </v-flex>

                            <v-flex xs12 sm6 md8>   
                                <autocomplete-field
                                    ref="autocompleteTipoDemanda"
                                    v-bind:errorMessages="errors.collect(optionsTipoDemanda.name)"
                                    :data-vv-name="optionsTipoDemanda.name"
                                    v-validate="{required: optionsTipoDemanda.required }"
                                    v-bind:options="optionsTipoDemanda"
                                    v-model="relAtividadesPrestadas.tipo_demanda_id"
                                    @input="$emit('input', relAtividadesPrestadas)"
                                    ></autocomplete-field>
                            </v-flex>  

                        </v-layout>            
                    </fieldset>
                </div>
                <relatorio-configuracoes-form 
                    v-model="relAtividadesPrestadas" 
                    v-bind:tipoRelatorio="true">                        
                </relatorio-configuracoes-form>
            </v-form>

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
</template>
<script>
    export default {
        name: "relatorio-atividades-prestadas-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                relAtividadesPrestadas: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsDataInicial() {
                return {
                    name: 'Data Inicial',
                    required: true,
                    max: this.relAtividadesPrestadas.data_final
                };
            },
            optionsDataFinal() {
                return {
                    name: 'Data Final',
                    required: true,
                    min: this.relAtividadesPrestadas.data_inicial

                };
            },
            optionsTipoDemanda() {
                return {
                    field: 'tipo_demanda_id',
                    required: false,
                    itemText: 'dados_tipo_demanda',
                    name: 'Tipo de Demanda',
                    url: 'relatividadesprestadas/autocomplete',
                    returnObject: true,
                    multiple: true,
                    cacheItems: true
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.relAtividadesPrestadas = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            gerar() {
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.gerarImpressao(this.relAtividadesPrestadas, "/relatividadesprestadas");
                    }
                });
            }
        }
    };
</script>