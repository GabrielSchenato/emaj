<template>
    <v-form @submit.prevent="gerar()">
        <v-card>
            <v-toolbar card prominent extended color="blue-grey darken-2" dark extension-height="15px">
                <v-toolbar-title class="headline">Relatório de Dias e Períodos dos Alunos</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>

                <fieldset>
                    <legend>Filtros</legend>
                    <v-layout row wrap>

                        <v-flex xs12 sm6 md12>   
                            <autocomplete-field
                                ref="autocompletePeriodo"
                                v-bind:errorMessages="errors.collect(optionsPeriodo.name)"
                                :data-vv-name="optionsPeriodo.name"
                                v-validate="{required: optionsPeriodo.required }"
                                v-bind:options="optionsPeriodo"
                                v-model="relDiasPeriodosAlunos.dia_periodo_id"
                                @input="$emit('input', relDiasPeriodosAlunos)"
                                ></autocomplete-field>
                        </v-flex>

                        <v-flex xs12 sm6 md12>   
                            <autocomplete-field
                                ref="autocompleteDisciplina"
                                v-bind:errorMessages="errors.collect(optionsDisciplina.name)"
                                :data-vv-name="optionsDisciplina.name"
                                v-validate="{required: optionsDisciplina.required }"
                                v-bind:options="optionsDisciplina"
                                v-model="relDiasPeriodosAlunos.disciplina_id"
                                @input="$emit('input', relDiasPeriodosAlunos)"
                                ></autocomplete-field>
                        </v-flex>  

                        <v-flex xs12 sm6 md12>   
                            <autocomplete-field
                                ref="autocompleteAluno"
                                v-bind:errorMessages="errors.collect(optionsAluno.name)"
                                :data-vv-name="optionsAluno.name"
                                v-validate="{required: optionsAluno.required }"
                                v-bind:options="optionsAluno"
                                v-model="relDiasPeriodosAlunos.aluno_id"
                                @input="$emit('input', relDiasPeriodosAlunos)"
                                ></autocomplete-field>
                        </v-flex>  

                    </v-layout>            
                </fieldset>

                <relatorio-configuracoes-form 
                    v-model="relDiasPeriodosAlunos" 
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
        name: "relatorio-dias-periodos-alunos-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                relDiasPeriodosAlunos: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsPeriodo() {
                return {
                    field: 'dia_periodo_id',
                    required: false,
                    itemText: 'dados_dia_periodo',
                    name: 'Período',
                    url: 'reldiasperiodosalunos/autocomplete',
                    returnObject: true,
                    multiple: true,
                    cacheItems: true
                };
            },
            optionsDisciplina() {
                return {
                    field: 'disciplina_id',
                    required: false,
                    itemText: 'dados_disciplina',
                    name: 'Disciplina',
                    url: 'reldiasperiodosalunos/autocomplete',
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
                    url: 'reldiasperiodosalunos/autocomplete',
                    returnObject: true,
                    multiple: true,
                    cacheItems: true
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.relDiasPeriodosAlunos = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            gerar() {
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.gerarImpressao(this.relDiasPeriodosAlunos, "/reldiasperiodosalunos");
                    }
                });
            }
        }
    };
</script>