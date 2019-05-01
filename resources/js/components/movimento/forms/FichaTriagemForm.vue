<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    id="id"
                    v-model="fichaTriagem.id"
                    label="ID"
                    disabled
                    @input="$emit('input', fichaTriagem)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="numero_protocolo_id"
                    id="numero_protocolo_id"
                    v-model="protocolo"
                    label="Protocolo"
                    disabled
                    @input="$emit('input', fichaTriagem)"
                    ></v-text-field>
            </v-flex>
        </v-layout>

        <v-card class="mb-4">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Dados das Partes</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>                                      
                    <v-flex xs12 sm6 md6>   
                        <v-autocomplete
                            name="cliente_id"
                            id="cliente_id"
                            :items="clientes"
                            :filter="clientesFilter"
                            item-text="nome_completo"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Cliente*"
                            v-model="fichaTriagem.cliente_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('cliente')"
                            data-vv-name="cliente"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="parte_contraria_id"
                            id="parte_contraria_id"
                            :items="clientes"
                            :filter="clientesFilter"
                            item-text="nome_completo"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Parte Contrária*"
                            v-model="fichaTriagem.parte_contraria_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('parte contrária')"
                            data-vv-name="parte contrária"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md5>
                        <v-checkbox
                            name="ja_foi_atendido"
                            id="ja_foi_atendido"
                            v-model="fichaTriagem.ja_foi_atendido"
                            label="Já foi atendido pelo escritório?*"
                            @change="$emit('input', fichaTriagem)"
                            ></v-checkbox>
                    </v-flex>
                </v-layout>
            </v-card-text>       
        </v-card>

        <v-card class="mb-4">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Outras Informações</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>
                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="tipo_demanda_id"
                            id="tipo_demanda_id"
                            :items="tipoDemandas"
                            :filter="tipoDemandasFilter"
                            item-text="nome"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Tipo de Demanda*"
                            v-model="fichaTriagem.tipo_demanda_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('tipo de demanda')"
                            data-vv-name="tipo de demanda"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="tipo_status_id"
                            id="tipo_status_id"
                            :items="tipoStatus"
                            :filter="tipoStatusFilter"
                            item-text="nome"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Tipo de Status*"
                            v-model="fichaTriagem.tipo_status_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('tipo de status')"
                            data-vv-name="tipo de status"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="aluno_id"
                            id="aluno_id"
                            :items="alunos"
                            :filter="alunosFilter"
                            item-text="nome_completo"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Aluno"
                            v-model="fichaTriagem.aluno_id"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md12>
                        <v-text-field
                            name="outras_informacoes"
                            id="outras_informacoes"
                            v-model="fichaTriagem.outras_informacoes"
                            label="Outras Informações"
                            @input="$emit('input', fichaTriagem)"
                            ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>       
        </v-card>
    </v-form>
</template>
<script>
    export default {
        name: "ficha-triagem-form",
        $_veeValidate: {
            validator: "new"
        },
        props: {
            value: {
                type: [Object]
            },
        },
        data() {
            return {
                fichaTriagem: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                clientes: [],
                tipoDemandas: [],
                alunos: [],
                tipoStatus: []
            };
        },
        watch: {
            value: {
                handler() {
                    this.fichaTriagem = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            clientesFilter(item, queryText, itemText) {
                const textOne = item.nome_completo.toLowerCase();
                //const textTwo = item.abbr.toLowerCase();
                const searchText = queryText.toLowerCase();

                return textOne.indexOf(searchText) > -1 /*||
                 textTwo.indexOf(searchText) > -1*/;
            },
            tipoDemandasFilter(item, queryText, itemText) {
                const textOne = item.nome.toLowerCase();
                //const textTwo = item.abbr.toLowerCase();
                const searchText = queryText.toLowerCase();

                return textOne.indexOf(searchText) > -1 /*||
                 textTwo.indexOf(searchText) > -1*/;
            },
            alunosFilter(item, queryText, itemText) {
                const textOne = item.nome_completo.toLowerCase();
                //const textTwo = item.abbr.toLowerCase();
                const searchText = queryText.toLowerCase();

                return textOne.indexOf(searchText) > -1 /*||
                 textTwo.indexOf(searchText) > -1*/;
            },
            tipoStatusFilter(item, queryText, itemText) {
                const textOne = item.nome.toLowerCase();
                //const textTwo = item.abbr.toLowerCase();
                const searchText = queryText.toLowerCase();

                return textOne.indexOf(searchText) > -1 /*||
                 textTwo.indexOf(searchText) > -1*/;
            },
        },
        mounted() {
            window.axios.get('clientes/autocomplete').then(response => {
                this.clientes = response.data;
            });
            window.axios.get('tipodemandas/autocomplete').then(response => {
                this.tipoDemandas = response.data;
            });
            window.axios.get('tipostatus/autocomplete').then(response => {
                this.tipoStatus = response.data;
            });
            window.axios.get('usuarios/autocomplete').then(response => {
                this.alunos = response.data;
            });
        },
        computed: {
            protocolo() {
                if (this.fichaTriagem.numero_protocolo)
                    return this.fichaTriagem.numero_protocolo.protocolo;
            }
        }
    };
</script>