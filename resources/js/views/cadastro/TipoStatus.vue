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
                            <tipo-status-dialog ref="tipoStatusDialog"></tipo-status-dialog>
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
                                :items="tipostatus.data"
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
                                    <td>{{ props.item.nome }}</td>
                                    <td>{{ props.item.ativo | formataAtivo }}</td>
                                    <td>{{ props.item.created_at | formataData }}</td>
                                    <td>{{ props.item.updated_at | formataData }}</td>
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
    import TipoStatusDialog from "@/components/cadastro/dialogs/TipoStatusDialog.vue";

    export default {
        components: {
            Confirm,
            TipoStatusDialog
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
                            text: "Nome",
                            value: "nome"
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
                            text: "Editado em",
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
                this.$refs.tipoStatusDialog
                        .open(
                                'Adicionar um novo tipo de status',
                                {ativo:true},
                                {
                                    color: "blue"
                                }
                        );
            },

            editar(id) {
                this.$store.dispatch("getTipoStatus", id).then(() => {
                    this.$refs.tipoStatusDialog
                            .open(
                                    'Editar um tipo de status',
                                    this.$store.state.tipostatus.tipoStatusView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            },

            deletar(item) {
                this.$refs.confirm
                        .open("Deletar " + item.nome, "Você tem certeza que deseja deletar esse tipo de status?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeTipoStatus", item).then(() => {
                                    this.loading = true;
                                    this.$store.dispatch("getTipoStatusAll").then(() => {
                                        this.loading = false;
                                        window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    });
                                }).catch((resp) => {
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                                });
                            }
                        });
            }
        },
        computed: {
            tipostatus() {
                return this.$store.state.tipostatus.tipoStatusList;
            }

        },
        mounted() {
            this.loading = true;
            this.$store.dispatch("getTipoStatusAll").then(() => {
                this.loading = false;
            });
        }
    };
</script>
