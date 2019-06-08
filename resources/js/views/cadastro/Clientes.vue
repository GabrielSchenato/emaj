<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <v-card>
                        <v-toolbar card color="white">
                            <v-btn color="primary" dark @click="adicionar">Adicionar
                                <v-icon right dark>add</v-icon>
                            </v-btn>
                            <cliente-dialog ref="clienteDialog"></cliente-dialog>
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
                                :items="clientes"
                                :pagination.sync="pagination"
                                :total-items="totalClientes"
                                :rows-per-page-items="[10,25,50,100]"
                                class="elevation-1"
                                item-key="id"
                                select-all
                                v-model="complex.selected"
                                rows-per-page-text="Linhas por página"
                                no-results-text="Nenhum registro correspondente encontrado"
                                no-data-text="Não há registros para serem exibidos."
                                :loading="loading"
                                >
                                <template slot="items" slot-scope="props">
                                    <td>
                                    <v-checkbox primary hide-details v-model="props.selected"></v-checkbox>
                                    </td>
                                    <td>{{ props.item.id }}</td>
                                    <td>{{ props.item.nome_completo }}</td>
                                    <td>{{ props.item.cpf }}</td>
                                    <td>{{ props.item.rg }}</td>
                                    <td>{{ props.item.renda | formataMoeda}}</td>
                                    <td>{{ props.item.representado_assistido }}</td>
                                    <td>{{ props.item.ativo | formataAtivo}}</td>
                                    <td>{{ props.item.created_at | formataData }}</td>
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
    import ClienteDialog from "@/components/cadastro/dialogs/ClienteDialog.vue";
    import FilterForm from "@/components/FilterForm";

    export default {
        components: {
            Confirm,
            ClienteDialog,
            FilterForm
        },

        data: () => ({
                dialog: false,
                search: {},
                loading: true,
                pagination: {descending: true},
                clientes: [],
                totalClientes: 0,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "ID",
                            value: "id",
                            filterable: true,
                            type: 'number'
                        },
                        {
                            text: "Nome Completo",
                            value: "nome_completo",

                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "CPF",
                            value: "cpf",
                            filterable: true,
                            type: 'text',
                            initial: true,
                            mask: '###.###.###-##'
                        },
                        {
                            text: "RG",
                            value: "rg",
                            filterable: true,
                            type: 'text',
                            initial: true,
                            mask: '#.###.###'
                        },
                        {
                            text: "Renda",
                            value: "renda",
                            filterable: true,
                            type: 'money',
                            initial: true
                        },
                        {
                            text: "Representado/Assistido",
                            value: "representado_assistido",
                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "Ativo?",
                            value: "ativo",
                            filterable: true,
                            type: 'combo',
                            options: [{text: 'Sim', value: 1}, {text: 'Não', value: 0}]
                        },
                        {
                            text: "Criado em",
                            value: "created_at",
                            filterable: true,
                            type: 'datetime'
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
                this.$refs.clienteDialog
                        .open(
                                'Adicionar um novo Cliente',
                                {
                                    informacoesPessoais: {
                                        ativo: true,
                                        nacionalidade_id: 7
                                    },
                                    endereco: {},
                                    composicaoFamiliar: {},
                                    telefones: []
                                },
                                {
                                    color: "blue"
                                }
                        ).then(confirm => {
                    if (confirm)
                        this.getData();
                });
            },
            editar(id) {
                this.$store.dispatch("getCliente", id).then(() => {
                    this.$refs.clienteDialog
                            .open(
                                    'Editar Cliente',
                                    this.$store.state.cliente.clienteView,
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
                        .open("Deletar " + item.nome_completo, "Você tem certeza que deseja deletar esse Cliente?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeCliente", item).then(() => {
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    this.getData();
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
                this.$store.dispatch("getClientes", this.paginationTable(this.params)).then(() => {
                    this.clientes = this.$store.state.cliente.clienteList.data;
                    this.totalClientes = this.$store.state.cliente.clienteList.total;
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
