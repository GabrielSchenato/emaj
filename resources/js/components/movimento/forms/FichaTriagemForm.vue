<template>
    <v-form>
        <cliente-dialog ref="clienteDialog"></cliente-dialog>
        <tipo-demanda-dialog ref="tipoDemandaDialog"></tipo-demanda-dialog>
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
                    name="protocolo"
                    id="protocolo"
                    v-model="fichaTriagem.protocolo"
                    label="Protocolo*"
                    mask="#####/##"
                    return-masked-value
                    :error-messages="errors.collect('protocolo')"
                    data-vv-name="protocolo"
                    v-validate="{required: true }"
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
                            item-text="nome_completo"
                            :search-input.sync="autocompleteClientes"
                            :loading="loadingClientes"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            autofocus
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Cliente*"
                            v-model="fichaTriagem.cliente_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('cliente')"
                            data-vv-name="cliente"
                            @input="$emit('input', fichaTriagem)"
                            :prepend-icon="fichaTriagem.cliente_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.cliente_id != null ? editarCliente(fichaTriagem.cliente_id) : criarCliente()"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="parte_contraria_id"
                            id="parte_contraria_id"
                            :items="parteContrarias"
                            :search-input.sync="autocompleteParteContrarias"
                            :loading="loadingParteContrarias"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            item-text="nome_completo"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Parte Contrária"
                            v-model="fichaTriagem.parte_contraria_id"
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
                            :search-input.sync="autocompleteTipoDemandas"
                            :loading="loadingTipoDemandas"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            item-text="nome"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Tipo de Demanda"
                            v-model="fichaTriagem.tipo_demanda_id"
                            v-validate="{required: false }"
                            :error-messages="errors.collect('tipo de demanda')"
                            data-vv-name="tipo de demanda"
                            @input="$emit('input', fichaTriagem)"
                            :prepend-icon="fichaTriagem.tipo_demanda_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.tipo_demanda_id != null ? editarTipoDemanda(fichaTriagem.tipo_demanda_id) : criarTipoDemanda()"
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
                            label="Tipo de Status"
                            v-model="fichaTriagem.tipo_status_id"
                            v-validate="{required: false }"
                            :error-messages="errors.collect('tipo de status')"
                            data-vv-name="tipo de status"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>            
                        <v-text-field
                            name="nome_aluno"
                            id="nome_aluno"
                            label="Aluno"
                            v-model="fichaTriagem.nome_aluno"
                            @input="$emit('input', fichaTriagem)"
                            ></v-text-field>
                    </v-flex>
                    
                    <v-flex xs12 sm6 md6>            
                        <v-text-field
                            name="nome_professor"
                            id="nome_professor"
                            label="Professor"
                            v-model="fichaTriagem.nome_professor"
                            @input="$emit('input', fichaTriagem)"
                            ></v-text-field>
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
        <small>*Indica os campos que são obrigatórios</small>
    </v-form>
</template>
<script>
    import ClienteDialog from "@/components/cadastro/dialogs/ClienteDialog.vue";
    import TipoDemandaDialog from "@/components/cadastro/dialogs/TipoDemandaDialog.vue";
    export default {
        name: "ficha-triagem-form",
        components: {
            ClienteDialog,
            TipoDemandaDialog
        },
        $_veeValidate: {
            validator: "new"
        },
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                fichaTriagem: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                clientes: [],
                parteContrarias: [],
                tipoDemandas: [],
                tipoStatus: [],
                loadingClientes: false,
                autocompleteClientes: null,
                loadingParteContrarias: false,
                autocompleteParteContrarias: null,
                loadingTipoDemandas: false,
                autocompleteTipoDemandas: null
            };
        },
        watch: {
            value: {
                handler() {
                    this.fichaTriagem = Object.assign({}, this.value);
                },
                deep: true
            },
            autocompleteClientes(busca) {
                if (this.fichaTriagem.cliente_id && busca.length <= 1)
                {
                    this.fichaTriagem.cliente_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingClientes)
                        return;

                    if (this.fichaTriagem.cliente_id)
                        return;

                    this.loadingClientes = true;
                    window.axios.get('clientes/autocomplete?query=' + busca).then(response => {
                        this.clientes = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingClientes = false));
                }

            },
            autocompleteParteContrarias(busca) {
                if (this.fichaTriagem.parte_contraria_id && busca.length <= 1)
                {
                    this.fichaTriagem.cliente_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingParteContrarias)
                        return;

                    if (this.fichaTriagem.parte_contraria_id)
                        return;

                    this.loadingParteContrarias = true;
                    window.axios.get('clientes/autocomplete?query=' + busca).then(response => {
                        this.parteContrarias = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingParteContrarias = false));
                }

            },
            autocompleteTipoDemandas(busca) {
                if (this.fichaTriagem.tipo_demanda_id && busca.length <= 1)
                {
                    this.fichaTriagem.tipo_demanda_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingTipoDemandas)
                        return;

                    if (this.fichaTriagem.tipo_demanda_id)
                        return;

                    this.loadingTipoDemandas = true;
                    window.axios.get('tipodemandas/autocomplete?query=' + busca).then(response => {
                        this.tipoDemandas = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingTipoDemandas = false));
                }

            }
        },
        methods: {
            tipoStatusFilter(item, queryText, itemText) {
                const textOne = item.nome.toLowerCase();
                //const textTwo = item.abbr.toLowerCase();
                const searchText = queryText.toLowerCase();

                return textOne.indexOf(searchText) > -1 /*||
                 textTwo.indexOf(searchText) > -1*/;
            },
            criarCliente() {
                this.$refs.clienteDialog
                        .open(
                                'Adicionar um novo cliente',
                                {
                                    informacoesPessoais: {
                                        ativo: true
                                    },
                                    endereco: {},
                                    composicaoFamiliar: {},
                                    telefones: []
                                },
                                {
                                    color: "blue"
                                }
                        );
            },
            editarCliente(id) {
                this.$store.dispatch("getCliente", id).then(() => {
                    this.$refs.clienteDialog
                            .open(
                                    'Editar cliente',
                                    this.$store.state.cliente.clienteView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            },
            criarTipoDemanda() {
                this.$refs.tipoDemandaDialog
                        .open(
                                'Adicionar um novo tipo de demanda',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        );
            },

            editarTipoDemanda(id) {
                this.$store.dispatch("getTipoDemanda", id).then(() => {
                    this.$refs.tipoDemandaDialog
                            .open(
                                    'Editar um tipo de demanda',
                                    this.$store.state.tipodemanda.tipoDemandaView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            }
        },
        mounted() {
            window.axios.get('tipostatus/autocomplete').then(response => {
                this.tipoStatus = response.data;
            });
        }
    };
</script>