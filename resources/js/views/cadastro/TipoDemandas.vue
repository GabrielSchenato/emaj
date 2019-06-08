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
                            <tipo-demanda-dialog ref="tipoDemandaDialog"></tipo-demanda-dialog>
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
                                :items="tipoDemandas"
                                :pagination.sync="pagination" 
                                :total-items="totalTipodemandas"
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
                                    <td>{{ props.item.nome }}</td>
                                    <td>{{ props.item.descricao }}</td>
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
    import TipoDemandaDialog from "@/components/cadastro/dialogs/TipoDemandaDialog.vue";
    import FilterForm from "@/components/FilterForm";

    export default {
        components: {
            Confirm,
            TipoDemandaDialog,
            FilterForm
        },

        data: () => ({
                dialog: false,
                search: {},
                loading: true,
                pagination: {descending: true},
                tipoDemandas: [],
                totalTipodemandas: 0,
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
                            text: "Nome",
                            value: "nome",
                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "Descrição",
                            value: "descricao",
                            filterable: true,
                            type: 'text'
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
                            text: "Editado em",
                            value: "updated_at",
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
                this.$refs.tipoDemandaDialog
                        .open(
                                'Adicionar um novo Tipo de Demanda',
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
                this.$store.dispatch("getTipoDemanda", id).then(() => {
                    this.$refs.tipoDemandaDialog
                            .open(
                                    'Editar um Tipo de Demanda',
                                    this.$store.state.tipodemanda.tipoDemandaView,
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
                        .open("Deletar " + item.nome, "Você tem certeza que deseja deletar esse Tipo de Demanda?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeTipoDemanda", item).then(() => {
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
                this.$store.dispatch("getTipoDemandas", this.paginationTable(this.params)).then(() => {
                    this.tipoDemandas = this.$store.state.tipodemanda.tipoDemandaList.data;
                    this.totalTipodemandas = this.$store.state.tipodemanda.tipoDemandaList.total;
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
