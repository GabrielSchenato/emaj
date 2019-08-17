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
                            <protocolo-aluno-dialog
                                ref="protocoloAlunosDialog"
                                v-bind:idProtocolo="idProtocolo"
                                >
                            </protocolo-aluno-dialog>
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
                                :items="protocoloAlunos"
                                :pagination.sync="pagination" 
                                :total-items="totalProtocoloAlunos"
                                :rows-per-page-items="[10,25,50,100]"
                                class="elevation-1"
                                item-key="id"
                                rows-per-page-text="Linhas por página"
                                no-results-text="Nenhum registro correspondente encontrado"
                                no-data-text="Não há registros para serem exibidos."
                                :loading="loading"
                                >
                                <template slot="items" slot-scope="props">              
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.nome_aluno }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.nome_professor }}</td>
                                    <td v-bind:class="{ vermelho: !props.item.ativo }">{{ props.item.data_vinculo | formataData }}</td>
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
    import ProtocoloAlunoDialog from "@/components/cadastro/dialogs/ProtocoloAlunoDialog.vue";
    import moment from 'moment'

    export default {
        components: {
            Confirm,
            ProtocoloAlunoDialog
        },
        props: {
            idProtocolo: {
                accept: Number,
                required: true
            }
        },
        data: () => ({
                dialog: false,
                search: {},
                loading: false,
                pagination: {descending: true, sortBy: 'id'},
                protocoloAlunos: [],
                totalProtocoloAlunos: 0,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "Aluno",
                            value: "nome_aluno",
                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "Professor",
                            value: "nome_professor",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Data Vínculo",
                            value: "data_vinculo",
                            filterable: true,
                            type: 'datetime'
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
                this.$refs.protocoloAlunosDialog
                        .open(
                                'Adicionar um novo vínculo Aluno/Professor',
                                {
                                    ativo: true,
                                    data_vinculo: moment().format('YYYY-MM-DD')
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
                this.$store.dispatch("getProtocoloAluno", id).then(() => {
                    this.$refs.protocoloAlunosDialog
                            .open(
                                    'Editar vínculo Aluno/Professor',
                                    this.$store.state.protocoloalunos.protocoloAlunosView,
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
                        .open("Deletar", "Você tem certeza que deseja deletar esse vínculo Aluno/Professor?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeProtocoloAluno", item).then(() => {
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
                window.axios.get(`protocoloalunos${this.paginationTable(this.params)}&protocolo_id=${this.idProtocolo}`).then(response => {
                    this.protocoloAlunos = response.data.data;
                    this.totalProtocoloAlunos = response.data.total;
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