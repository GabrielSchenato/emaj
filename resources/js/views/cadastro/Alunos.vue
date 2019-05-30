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
                                :items="alunos.data"
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
                            text: "E-mail",
                            value: "email"
                        },
                        {
                            text: "Celular",
                            value: "celular"
                        },
                        {
                            text: "Matricula",
                            value: "matricula"
                        },
                        {
                            text: "Ativo?",
                            value: "ativo"
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
                this.$refs.alunoDialog
                        .open(
                                'Adicionar um novo aluno',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        ).then(confirm => {
                            if (confirm)
                                this.$store.dispatch("getAlunos");
                        });
            },

            editar(id) {
                this.$store.dispatch("getAluno", id).then(() => {
                    this.$refs.alunoDialog
                            .open(
                                    'Editar um aluno',
                                    this.$store.state.aluno.alunoView,
                                    {
                                        color: "blue"
                                    }
                            ).then(confirm => {
                            if (confirm)
                                this.$store.dispatch("getAlunos");
                        });
                });
            },

            deletar(item) {
                this.$refs.confirm
                        .open("Deletar " + item.nome, "Você tem certeza que deseja deletar esse aluno?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeAluno", item).then(() => {
                                    this.loading = true;
                                    this.$store.dispatch("getAlunos").then(() => {
                                        this.loading = false;
                                        window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    });
                                }).catch((resp) => {
                                    let msgErro = '';
                                    if (resp.response.data.errors)
                                        msgErro = resp.response.data.errors
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                                });
                            }
                        });
            }
        },
        computed: {
            alunos() {
                return this.$store.state.aluno.alunoList;
            }

        },
        mounted() {
            this.loading = true;
            this.$store.dispatch("getAlunos").then(() => {
                this.loading = false;
            });
        }
    };
</script>
