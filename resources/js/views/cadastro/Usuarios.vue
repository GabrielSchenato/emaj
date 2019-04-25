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
                                :items="usuarios.data"
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
                                    <td>
                                    <v-avatar size="32">
                                        <img :src="'data:image/jpeg;base64,' + props.item.avatar" alt>
                                    </v-avatar>
                                    </td>
                                    <td>{{ props.item.nome_completo }}</td>
                                    <td>{{ props.item.email }}</td>
                                    <td>{{ props.item.telefone }}</td>
                                    <td>{{ props.item.role | formataRole }}</td>
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
                            text: "Avatar",
                            value: "avatar",
                            sortable: false
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
                            text: "Telefone",
                            value: "telefone"
                        },
                        {
                            text: "Nível de Permissão",
                            value: "role"
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
                this.$refs.usuarioDialog
                        .open(
                                'Adicionar um novo usuário',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        );
            },

            editar(id) {
                this.$store.dispatch("getUsuario", id).then(() => {
                    let avatar = this.$store.state.usuario.usuarioView.avatar;
                    let usuario = Object.assign({}, this.$store.state.usuario.usuarioView);
                    usuario.avatar = {avatar};
                    this.$refs.usuarioDialog
                            .open(
                                    'Editar um usuário',
                                    usuario,
                                    {
                                        color: "blue"
                                    }
                            );
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
                                    this.loading = true;
                                    this.$store.dispatch("getUsuarios").then(() => {
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
            usuarios() {
                return this.$store.state.usuario.usuarioList;
            }

        },
        mounted() {
            this.loading = true;
            this.$store.dispatch("getUsuarios").then(() => {
                this.loading = false;
            });
        }
    };
</script>
