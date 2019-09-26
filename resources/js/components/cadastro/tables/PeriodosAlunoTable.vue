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
                            <periodo-aluno-dialog
                                ref="periodoAlunoDialog"
                                v-bind:idAluno="idAluno"
                                v-bind:nomeAluno="nomeAluno"
                                >
                            </periodo-aluno-dialog>
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
                                :items="periodosAluno"
                                :pagination.sync="pagination" 
                                :total-items="totalPeriodosAluno"
                                :rows-per-page-items="[10,25,50,100]"
                                class="elevation-1"
                                item-key="id"
                                rows-per-page-text="Linhas por página"
                                no-results-text="Nenhum registro correspondente encontrado"
                                no-data-text="Não há registros para serem exibidos."
                                :loading="loading"
                                >
                                <template slot="items" slot-scope="props">                                       
                                    <td>
                                        {{ props.item.dados_dia_periodo_aluno }}
                                    </td>
                                    <td>
                                        {{ props.item.created_at | formataDataHora }}
                                    </td>
                                    <td>   
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-btn depressed outline icon fab dark color="pink" small v-on="on">
                                                <v-icon @click="deletar(props.item)">delete</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Deletar</span>
                                    </v-tooltip>

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
    import PeriodoAlunoDialog from "@/components/cadastro/dialogs/PeriodoAlunoDialog.vue";

    export default {
        components: {
            Confirm,
            PeriodoAlunoDialog
        },
        props: {
            idAluno: {
                accept: Number,
                required: true
            },
            nomeAluno: {
                accept: String,
                required: true
            }
        },
        data: () => ({
                dialog: false,
                search: {},
                loading: false,
                pagination: {descending: false, sortBy: 'dia_periodo_id'},
                periodosAluno: [],
                totalPeriodosAluno: 0,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "Período",
                            value: "dia_periodo_id",
                            filterable: true,
                            type: 'text',
                            initial: true
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

                this.$refs.periodoAlunoDialog
                        .open(
                                'Adicionar um novo Período para o Aluno',
                                {
                                    nome_aluno: this.nomeAluno,
                                    aluno_id: this.idAluno
                                },
                                {
                                    color: "blue"
                                }
                        ).then(confirm => {
                    if (confirm)
                        this.getData();
                });

            },
            deletar(item) {
                this.$refs.confirm
                        .open("Deletar", "Você tem certeza que deseja deletar esse período do Aluno?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removePeriodoAluno", item).then(() => {
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
                window.axios.get(`diaperiodoalunos${this.paginationTable(this.params)}&aluno_id=${this.idAluno}`).then(response => {
                    this.periodosAluno = response.data.data;
                    this.totalPeriodosAluno = response.data.total;
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