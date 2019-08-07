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
                <v-toolbar-title class="subheading">Dados da Avaliação</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>                                      
                    <v-flex xs12 sm6 md12>   
                        <v-autocomplete
                            name="ficha_triagem_id"
                            :items="fichaTriagens"
                            item-text="dados_ficha_triagem"
                            :search-input.sync="autocompleteFichaTriagens"
                            :loading="loadingFichaTriagens"
                            hide-no-data
                            clearable
                            dense
                            placeholder="Comece a digitar para pesquisar"
                            autofocus
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Ficha de Triagem*"
                            v-model="avaliacao.ficha_triagem_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('Ficha de Triagem')"
                            data-vv-name="Ficha de Triagem"
                            @input="$emit('input', avaliacao)"
                            ></v-autocomplete>
                    </v-flex>
                    <v-flex xs12 sm6 md12>   
                        <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            :nudge-right="40"      
                            lazy
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="290px"
                            >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    :value="data"
                                    label="Data*"
                                    readonly
                                    clearable
                                    v-on="on"
                                    @click:clear="clearData()"
                                    v-validate="{required: true }"
                                    :error-messages="errors.collect('Data')"
                                    data-vv-name="Data"
                                    ></v-text-field>
                            </template>
                            <v-date-picker 
                                v-model="avaliacao.data"
                                no-title scrollable
                                locale="pt-br"
                                :max="max"
                                @input="$emit('input', avaliacao); menu = false">
                            </v-date-picker>
                        </v-menu>
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
                avaliacao: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                fichaTriagens: [],
                loadingFichaTriagens: false,
                autocompleteFichaTriagens: null,
                menu: false,
                max: moment().format('YYYY-MM-DD')
            };
        },
        computed: {
            data() {
                return this.avaliacao.data ? moment(this.avaliacao.data).format('L') : '';
            }
        },
        watch: {
            value: {
                handler() {
                    this.avaliacao = Object.assign({}, this.value);
                },
                deep: true
            },
            autocompleteFichaTriagens: _.debounce(
                    function autocompleteFichaTriagens(busca) {
                        if (this.avaliacao.ficha_triagem_id && busca.length <= 1)
                        {
                            this.avaliacao.ficha_triagem_id = null;
                        }
                        if (busca) {
                            if (this.loadingFichaTriagens)
                                return;

                            if (this.avaliacao.ficha_triagem_id)
                                return;

                            this.loadingFichaTriagens = true;
                            window.axios.get(`alunos/autocomplete?aluno_id=${this.avaliacao.aluno_id}&ficha_triagem=${busca.replace(' ', '%20')}`).then(response => {
                                this.fichaTriagens = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingFichaTriagens = false));
                        }

                    },
                    500,
                    )
        },
        methods: {
            clearData() {
                this.avaliacao.data = null;
                this.$emit('input', this.avaliacao);
            }
        }
    };
</script>