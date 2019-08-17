<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>                
                <v-flex lg12>
                    <v-card>
                        <v-toolbar card color="white">
                            <v-btn color="primary" @click="adicionar">Adicionar
                                <v-icon right dark>add</v-icon>
                            </v-btn>
                            <protocolo-dialog
                                ref="protocoloDialog"
                                v-bind:idCliente="idCliente"
                                v-bind:nomeCliente="nomeCliente"
                                v-bind:nomeRepresentadoAssistido="nomeRepresentadoAssistido"
                                >
                            </protocolo-dialog>
                            <confirm ref="confirm"></confirm>
                            <v-divider class="mx-2" inset vertical></v-divider>
                            <filter-form
                                ref="filterForm" 
                                v-bind:options="complex.headers"
                                v-model="search"
                                >                                    
                            </filter-form>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text class="pa-0">
                            <v-data-table
                                :headers="complex.headers"
                                :items="protocolos"
                                :pagination.sync="pagination" 
                                :total-items="totalProtocolos"
                                :rows-per-page-items="[10,25,50,100]"
                                class="elevation-1"
                                item-key="id"
                                rows-per-page-text="Linhas por página"
                                no-results-text="Nenhum registro correspondente encontrado"
                                no-data-text="Não há registros para serem exibidos."
                                :loading="loading"
                                >
                                <template slot="items" slot-scope="props">                                       
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.protocolo }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.numero_processo }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo, azul: props.item.nome_parte_contraria != null && props.item.ativo }">{{ props.item.nome_parte_contraria }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.nome_tipo_demanda }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.status }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.ativo | formataAtivo }}</td>
                                    <td>
                                    <v-btn depressed outline icon fab dark color="primary" small>
                                        <v-icon @click="editar(props.item.id)">edit</v-icon>
                                    </v-btn>
                                    <v-btn depressed outline icon fab dark color="pink" small>
                                        <v-icon @click="deletar(props.item)">delete</v-icon>
                                    </v-btn>
                                    </td>
                                </template>
                                <template
                                    slot="pageText"
                                    slot-scope="props"
                                    >Mostrando {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}</template>
                            </v-data-table>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import Confirm from "@/components/dialogs/Confirm.vue";
    import ProtocoloDialog from "@/components/cadastro/dialogs/ProtocoloDialog.vue";

    export default {
        components: {
            Confirm,
            ProtocoloDialog
        },
        props: {
            idCliente: {
                accept: Number,
                required: true
            },
            nomeCliente: {
                accept: String,
                required: true
            },
            nomeRepresentadoAssistido: {
                accept: String
            }
        },
        data: () => ({
                dialog: false,
                search: {},
                loading: false,
                pagination: {descending: true, sortBy: 'id'},
                protocolos: [],
                totalProtocolos: 0,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "Protocolo",
                            value: "protocolo",
                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "N.º Processo",
                            value: "numero_processo",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Parte Contrária",
                            value: "nome_parte_contraria",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Tipo de Demanda",
                            value: "nome_tipo_demanda",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Status",
                            value: "status",
                            filterable: true,
                            type: 'combo',
                            options: [{text: 'Ajuizado', value: 'Ajuizado'}, {text: 'Não Ajuizado', value: 'Não Ajuizado'}]
                        },
                        {
                            text: "Ativo?",
                            value: "ativo",
                            filterable: true,
                            type: 'combo',
                            options: [{text: 'Sim', value: 1}, {text: 'Não', value: 0}]
                        },
                        {
                            text: "Ação",
                            value: "",
                            sortable: false
                        }
                    ]
                }
            }),
        watch: {
            params: {
                handler() {
                    this.getData();
                },
                deep: true
            }
        },
        methods: {
            adicionar() {
                this.$refs.protocoloDialog
                        .open(
                                'Adicionar um novo Protocolo',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        ).then(confirm => {
                    if (confirm)
                        this.getData();
                });
            },

            editar(id) {
                this.$refs.protocoloDialog.protocolo = {};
                this.$store.dispatch("getProtocolo", id).then(() => {
                    this.$refs.protocoloDialog
                            .open(
                                    'Editar um Protocolo',
                                    this.$store.state.protocolo.protocoloView,
                                    {
                                        color: "blue"
                                    }
                            ).then(confirm => {
                        if (confirm)
                            this.getData();
                    });
                });
            },

            deletar(item) {
                this.$refs.confirm
                        .open("Deletar", "Você tem certeza que deseja deletar esse Protocolo?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeProtocolo", item).then(() => {
                                    this.getData();
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                                    let msgErro = '';
                                    if (resp.response.data.errors)
                                        msgErro = resp.response.data.errors;
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                                });
                            }
                        });
            },
            getData() {
                this.loading = true;
                window.axios.get(`protocolos${this.paginationTable(this.params)}&cliente_id=${this.idCliente}`).then(response => {
                    this.protocolos = response.data.data;
                    this.totalProtocolos = response.data.total;
                    this.loading = false;
                }).catch((resp) => {
                    this.loading = false;
                    let msgErro = '';
                    if (resp.response.data.errors)
                        msgErro = resp.response.data.errors;
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                }).finally(() => (this.loading = false));
            }
        },
        computed: {
            params(nv) {
                return {
                    ...this.pagination,
                    query: this.search
                };
            }
        }
    };
</script>