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
                            <aluno-dialog ref="alunoDialog"></aluno-dialog>
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
                                :items="alunos"
                                :pagination.sync="pagination" 
                                :total-items="totalAlunos"
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
                                    <td>
                                    <v-avatar size="32" v-if='props.item.avatar'>
                                        <img :src="props.item.avatar.avatar_url" alt>
                                    </v-avatar>
                                    </td>
                                    <td>{{ props.item.nome_completo }}</td>
                                    <td>{{ props.item.email }}</td>
                                    <td>{{ props.item.celular }}</td>
                                    <td>{{ props.item.matricula }}</td>
                                    <td>{{ props.item.ativo | formataAtivo }}</td>
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
    import AlunoDialog from "@/components/cadastro/dialogs/AlunoDialog.vue";

    export default {
        components: {
            Confirm,
            AlunoDialog
        },

        data: () => ({
                dialog: false,
                search: {},
                loading: true,
                pagination: {descending: true},
                alunos: [],
                totalAlunos: 0,
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
                            text: "Avatar",
                            value: "avatar",
                            sortable: false
                        },
                        {
                            text: "Nome Completo",
                            value: "nome_completo",
                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "E-mail",
                            value: "email",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Celular",
                            value: "celular",
                            filterable: true,
                            type: 'text',
                            mask: '(##) #####-####'
                        },
                        {
                            text: "Matricula",
                            value: "matricula",
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
                this.$refs.alunoDialog
                        .open(
                                'Adicionar um novo Aluno',
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
                this.$refs.alunoDialog.aluno = {};
                this.$store.dispatch("getAluno", id).then(() => {
                    this.$refs.alunoDialog
                            .open(
                                    'Editar um Aluno',
                                    this.$store.state.aluno.alunoView,
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
                        .open("Deletar " + item.nome_completo, "Você tem certeza que deseja deletar esse Aluno?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeAluno", item).then(() => {
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
                this.$store.dispatch("getAlunos", this.paginationTable(this.params)).then(() => {
                    this.alunos = this.$store.state.aluno.alunoList.data;
                    this.totalAlunos = this.$store.state.aluno.alunoList.total;
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
