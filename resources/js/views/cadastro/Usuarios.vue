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
                            <usuario-dialog ref="usuarioDialog"></usuario-dialog>
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
                                :items="usuarios"
                                :pagination.sync="pagination" 
                                :total-items="totalUsuarios"
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
                                    <v-avatar size="32">
                                        <img :src="props.item.avatar_url" alt>
                                    </v-avatar>
                                    </td>
                                    <td>{{ props.item.nome_completo }}</td>
                                    <td>{{ props.item.email }}</td>
                                    <td>{{ props.item.telefone }}</td>
                                    <td>{{ props.item.role | formataRole }}</td>
                                    <td>{{ props.item.professor | formataAtivo }}</td>
                                    <td>{{ props.item.ativo | formataAtivo }}</td>
                                    <td>
                                    <v-btn 
                                        depressed outline icon fab dark
                                        color="primary"
                                        small
                                        :disabled="props.item.id == $auth.user().id">
                                        <v-icon @click="editar(props.item.id)">edit</v-icon>
                                    </v-btn>
                                    <v-btn 
                                        depressed outline icon fab dark 
                                        color="pink"
                                        small
                                        :disabled="props.item.id == $auth.user().id || (props.item.role == 'admin' && $auth.user().role == 'secretaria')">
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
    import UsuarioDialog from "@/components/cadastro/dialogs/UsuarioDialog.vue";

    export default {
        components: {
            Confirm,
            UsuarioDialog
        },

        data: () => ({
                dialog: false,
                search: {},
                loading: true,
                pagination: {descending: true},
                usuarios: [],
                totalUsuarios: 0,
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
                            text: "Telefone",
                            value: "telefone",
                            filterable: true,
                            type: 'text',
                            mask: '(##) #####-####'
                        },
                        {
                            text: "Nível de Permissão",
                            value: "role",
                            filterable: true,
                            type: 'combo',
                            options: [{text: 'Administrador', value: 'admin'}, {text: 'Secretária', value: 'secretaria'}]
                        },
                        {
                            text: "Professor?",
                            value: "professor",
                            filterable: true,
                            type: 'combo',
                            options: [{text: 'Sim', value: 1}, {text: 'Não', value: 0}]
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
                this.$refs.usuarioDialog
                        .open(
                                'Adicionar um novo Usuário',
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
                this.$store.dispatch("getUsuario", id).then(() => {
                    let avatar = this.$store.state.usuario.usuarioView.avatar;
                    let usuario = Object.assign({}, this.$store.state.usuario.usuarioView);
                    usuario.avatar = {avatar};
                    this.$refs.usuarioDialog
                            .open(
                                    'Editar um Usuário',
                                    usuario,
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
                        .open("Deletar " + item.nome_completo, "Você tem certeza que deseja deletar esse usuário?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeUsuario", item).then(() => {
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    this.getData();
                                }).catch((resp) => {
                                    let msgErro = '';
                                    if (resp.response.data.errors)
                                        msgErro = resp.response.data.errors
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                                });
                            }
                        });
            },
            getData() {
                this.loading = true;
                this.$store.dispatch("getUsuarios", this.paginationTable(this.params)).then(() => {
                    this.usuarios = this.$store.state.usuario.usuarioList.data;
                    this.totalUsuarios = this.$store.state.usuario.usuarioList.total;
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
