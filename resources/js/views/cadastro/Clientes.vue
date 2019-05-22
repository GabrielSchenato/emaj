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
                            <v-text-field
                                flat
                                clearable
                                solo
                                prepend-icon="search"
                                placeholder="Buscar..."
                                v-model="search"
                                hide-details
                                class="hidden-sm-and-down"
                                ></v-text-field>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text class="pa-0">
                            <v-data-table
                                :headers="complex.headers"
                                :search="search"
                                :items="clientes.data"
                                :rows-per-page-items="[10,25,50,{text:'Todos','value':-1}]"
                                class="elevation-1"
                                item-key="id"
                                select-all
                                v-model="complex.selected"
                                rows-per-page-text="Linhas por página"
                                no-results-text="Nenhum registro correspondente encontrado"
                                no-data-text="Não há registros para serem exibidos."
                                disable-initial-sort
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
                                    <td>{{ props.item.ativo | formataAtivo}}</td>
                                    <td>{{ props.item.created_at | formataData}}</td>
                                    <td>{{ props.item.updated_at | formataData}}</td>
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

    export default {
        components: {
            Confirm,
            ClienteDialog
        },

        data: () => ({
                dialog: false,
                search: "",
                loading: false,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "ID",
                            value: "id"
                        },
                        {
                            text: "Nome Completo",
                            value: "nome_completo"
                        },
                        {
                            text: "CPF",
                            value: "cpf"
                        },
                        {
                            text: "RG",
                            value: "rg"
                        },
                        {
                            text: "Renda",
                            value: "renda"
                        },
                        {
                            text: "Ativo?",
                            value: "ativo"
                        },
                        {
                            text: "Criado em",
                            value: "created_at"
                        },
                        {
                            text: "Atualizado em",
                            value: "updated_at"
                        },
                        {
                            text: "Ação",
                            value: "",
                            sortable: false
                        }
                    ]
                }
            }),
        methods: {
            adicionar() {
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

            editar(id) {
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

            deletar(item) {
                this.$refs.confirm
                        .open("Deletar " + item.nome_completo, "Você tem certeza que deseja deletar esse cliente?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeCliente", item).then(() => {
                                    this.loading = true;
                                    this.$store.dispatch("getClientes").then(() => {
                                        this.loading = false;
                                        window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    });
                                }).catch((resp) => {
                                    let msgErro = '';
                                    if(resp.response.data.errors)
                                        msgErro = resp.response.data.errors
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                                });
                            }
                        });
            }
        },
        computed: {
            clientes() {
                return this.$store.state.cliente.clienteList;
            }

        },
        mounted() {
            this.loading = true;
            this.$store.dispatch("getClientes").then(() => {
                this.loading = false;
            });
        }
    };
</script>
