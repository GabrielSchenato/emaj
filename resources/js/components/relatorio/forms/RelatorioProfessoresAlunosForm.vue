<template>
    <v-form @submit.prevent="gerar()">
        <v-card>
            <v-toolbar card prominent extended color="blue-grey darken-2" dark extension-height="15px">
                <v-toolbar-title class="headline">Relatório do Vínculo entre Professores e Alunos</v-toolbar-title>
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
                                v-model="relProfessoresAlunos.data_inicial"
                                @input="$emit('input', relProfessoresAlunos)"
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
                                v-model="relProfessoresAlunos.data_final"
                                @input="$emit('input', relProfessoresAlunos)"
                                >                                    
                            </data-field>
                        </v-flex>

                        <v-flex xs12 sm6 md8>   
                            <autocomplete-field
                                ref="autocompleteProfessor"
                                v-bind:errorMessages="errors.collect(optionsProfessor.name)"
                                :data-vv-name="optionsProfessor.name"
                                v-validate="{required: optionsProfessor.required }"
                                v-bind:options="optionsProfessor"
                                v-model="relProfessoresAlunos.professor_id"
                                @input="$emit('input', relProfessoresAlunos)"
                                ></autocomplete-field>
                        </v-flex>

                        <v-flex xs12 sm6 md8>   
                            <autocomplete-field
                                ref="autocompleteAluno"
                                v-bind:errorMessages="errors.collect(optionsAluno.name)"
                                :data-vv-name="optionsAluno.name"
                                v-validate="{required: optionsAluno.required }"
                                v-bind:options="optionsAluno"
                                v-model="relProfessoresAlunos.aluno_id"
                                @input="$emit('input', relProfessoresAlunos)"
                                ></autocomplete-field>
                        </v-flex>  

                        <select-ativo-field 
                            v-model="relProfessoresAlunos.ativo">                        
                        </select-ativo-field>

                    </v-layout>            
                </fieldset>

                <relatorio-configuracoes-form 
                    v-model="relProfessoresAlunos" 
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
        name: "relatorio-professores-alunos-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                relProfessoresAlunos: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsDataInicial() {
                return {
                    name: 'Data Inicial',
                    required: true,
                    max: this.relProfessoresAlunos.data_final
                };
            },
            optionsDataFinal() {
                return {
                    name: 'Data Final',
                    required: true,
                    min: this.relProfessoresAlunos.data_inicial

                };
            },
            optionsProfessor() {
                return {
                    field: 'professor_id',
                    required: false,
                    itemText: 'dados_usuario',
                    name: 'Professor',
                    url: 'relprofessoresalunos/autocomplete',
                    returnObject: true,
                    multiple: true,
                    cacheItems: true
                };
            },
            optionsAluno() {
                return {
                    field: 'aluno_id',
                    required: false,
                    itemText: 'dados_aluno',
                    name: 'Aluno',
                    url: 'relprofessoresalunos/autocomplete',
                    returnObject: true,
                    multiple: true,
                    cacheItems: true
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.relProfessoresAlunos = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            gerar() {
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.gerarImpressao(this.relProfessoresAlunos, "/relprofessoresalunos");
                    }
                });
            }
        }
    };
</script>