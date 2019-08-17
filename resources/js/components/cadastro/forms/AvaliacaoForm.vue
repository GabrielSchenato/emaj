<template>
    <div>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    v-model="avaliacao.id"
                    label="ID"
                    disabled
                    @input="$emit('input', avaliacao)"
                    ></v-text-field>
            </v-flex>
            <v-flex xs12 sm6 md10>
                <v-text-field
                    name="nome_aluno"
                    v-model="avaliacao.nome_aluno"
                    label="Aluno"
                    disabled
                    @input="$emit('input', avaliacao)"
                    ></v-text-field>
            </v-flex>
        </v-layout>

        <v-card class="mb-4">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Dados da Observação</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>                                      
                    <v-flex xs12 sm6 md12>
                        <autocomplete-field
                            ref="autocompleteProtocolos"
                            v-bind:errorMessages="errors.collect(optionsProtocolo.name)"
                            :data-vv-name="optionsProtocolo.name"
                            v-validate="{required: optionsProtocolo.required }"
                            v-bind:options="optionsProtocolo"
                            v-model="avaliacao.protocolo_id"
                            @input="$emit('input', avaliacao)"
                            ></autocomplete-field>
                    </v-flex>
                    <v-flex xs12 sm6 md12>   
                        <data-field
                            ref="data" 
                            v-bind:errorMessages="errors.collect(optionsData.name)"
                            :data-vv-name="optionsData.name"
                            v-validate="{required: optionsData.required }"
                            v-bind:options="optionsData"
                            v-model="avaliacao.data"
                            @input="$emit('input', avaliacao)"
                            >                                    
                        </data-field>                        
                    </v-flex>
                    <v-flex xs12 sm6 md12>   
                        <v-textarea
                            name="observacoes"
                            box
                            label="Observações*"
                            auto-grow
                            v-model="avaliacao.observacoes"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('Observações')"
                            data-vv-name="Observações"
                            clearable
                            @input="$emit('input', avaliacao)"
                            ></v-textarea>
                    </v-flex>

                </v-layout>
            </v-card-text>       
        </v-card>

        <v-card class="mb-4" v-if="avaliacao.id != null">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Anexos <small class="font-weight-bold font-italic font">(Tamanho máximo permitido: 10MB)</small></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn fab dark color="blue-grey darken-1" @click.native="$refs.avaliacaoArquivoForm.abreTelaAdicionarArquivo">
                        <v-icon dark>add</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>
                    <avaliacao-arquivo-form ref="avaliacaoArquivoForm" :idAvaliacao="avaliacao.id" :arquivos="avaliacao.avaliacao_arquivos"></avaliacao-arquivo-form>
                </v-layout>
            </v-card-text>       
        </v-card>
        <small>*Indica os campos que são obrigatórios</small>
    </div>
</template>
<script>
    import moment from 'moment'
    import AvaliacaoArquivoForm from "@/components/cadastro/forms/AvaliacaoArquivoForm.vue";
    export default {
        name: "avaliacao-form",
        components: {
            AvaliacaoArquivoForm
        },
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                avaliacao: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsProtocolo() {
                return {
                    field: 'protocolo_id',
                    required: false,
                    itemText: 'protocolo.dados_protocolo',
                    name: 'Protocolo',
                    url: 'alunos/autocomplete',
                    otherParams: {
                        aluno_id: this.avaliacao.aluno_id
                    }
                };
            },
            optionsData() {
                return {
                    name: 'Data',
                    required: true,
                    max: moment().format('YYYY-MM-DD')
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.avaliacao = Object.assign({}, this.value);
                },
                deep: true
            }
        }
    };
</script>