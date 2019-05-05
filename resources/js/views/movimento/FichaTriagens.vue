<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <v-card>
                        <v-toolbar card color="white">
                            <v-btn color="primary" :dark="parametrosTriagem" @click="adicionar" :disabled="!parametrosTriagem" v-if="$auth.check(['admin', 'secretaria'])">Adicionar
                                <v-icon right dark>add</v-icon>
                            </v-btn>
                            <ficha-triagem-dialog ref="fichaTriagemDialog"></ficha-triagem-dialog>
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
                                :items="fichatriagens.data"
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
                                    <td>{{ props.item.numero_protocolo.protocolo }}</td>
                                    <td>{{ props.item.cliente.nome_completo }}</td>
                                    <td>{{ props.item.parte_contraria.nome_completo }}</td>
                                    <td>{{ props.item.tipo_demanda.nome }}</td>
                                    <td>{{ props.item.tipo_status.nome }}</td>
                                    <td>{{ props.item.created_at | formataData }}</td>
                                    <td>{{ props.item.updated_at | formataData }}</td>
                                    <td>
                                    <v-btn depressed outline icon fab dark color="primary" small v-if="$auth.check(['admin', 'secretaria'])">
                                        <v-icon @click="gerarImpressao(props.item.id)">print</v-icon>
                                    </v-btn>
                                    <v-btn depressed outline icon fab dark color="primary" small v-if="$auth.check(['admin', 'secretaria'])">
                                        <v-icon @click="editar(props.item.id)">edit</v-icon>
                                    </v-btn>
                                    <v-btn depressed outline icon fab dark color="pink" small v-if="$auth.check(['admin', 'secretaria'])">
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
    import FichaTriagemDialog from "@/components/movimento/dialogs/FichaTriagemDialog.vue";

    export default {
        components: {
            Confirm,
            FichaTriagemDialog
        },

        data: () => ({
                dialog: false,
                search: "",
                loading: false,
                parametrosTriagem: true,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "ID",
                            value: "id"
                        },
                        {
                            text: "Protocolo",
                            value: "numero_protocolo.protocolo"
                        },
                        {
                            text: "Cliente",
                            value: "cliente.nome_completo"
                        },
                        {
                            text: "Parte Contrária",
                            value: "parte_contraria.nome_completo"
                        },
                        {
                            text: "Tipo de Demanda",
                            value: "tipo_demanda.nome"
                        },
                        {
                            text: "Status",
                            value: "tipo_status.nome"
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
                this.$refs.fichaTriagemDialog
                        .open(
                                'Adicionar uma nova ficha de triagem',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        );
            },

            editar(id) {
                this.$store.dispatch("getFichaTriagem", id).then(() => {
                    this.$refs.fichaTriagemDialog
                            .open(
                                    'Editar uma ficha de triagem',
                                    this.$store.state.fichatriagem.fichaTriagemView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            },

            deletar(item) {
                this.$refs.confirm
                        .open("Deletar", "Você tem certeza que deseja deletar essa ficha de triagem?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeFichaTriagem", item).then(() => {
                                    this.loading = true;
                                    this.$store.dispatch("getFichaTriagens").then(() => {
                                        this.loading = false;
                                        window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    });
                                }).catch((resp) => {
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                                });
                            }
                        });
            },
            gerarImpressao(id) {
                window.axios({
                            url: "/fichatriagens/impressao",
                            method: "POST",
                            responseType: "blob",
                            data: {formato: 'pdf', id: id}
                        })
                        .then(response => {
                            const blob = new Blob([response.data], {
                                type: response.data.type
                            });
                            const url = window.URL.createObjectURL(blob);
                            const link = document.createElement("a");
                            link.href = url;
                            const contentDisposition =
                                    response.headers["content-disposition"];
                            let fileName = "unknown";
                            if (contentDisposition) {
                                fileName = this.getFileNameFromHttpResponse(
                                        contentDisposition
                                        );
                            }
                            link.setAttribute("download", fileName);
                            document.body.appendChild(link);
                            link.click();
                            link.remove();
                            window.URL.revokeObjectURL(url);
                        });
            },
            getFileNameFromHttpResponse(contentDisposition) {
                var result = contentDisposition
                        .split(";")[1]
                        .trim()
                        .split("=")[1];
                return result.replace(/"/g, "");
            }
        },
        computed: {
            fichatriagens() {
                return this.$store.state.fichatriagem.fichaTriagemList;
            }

        },
        mounted() {
            this.loading = true;
            this.$store.dispatch("getFichaTriagens").then(() => {
                this.loading = false;
            });

            this.$store.dispatch("getParametrosTriagem").then(() => {
                let parametros = Object.assign({}, this.$store.state.parametrostriagem.parametrosTriagemView);
                if (!parametros.id) {
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Os parâmetros da triagem não foram definidos!', timeout: 3500});
                    this.parametrosTriagem = false;
                }

            }).catch((resp) => {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
            });
        }
    };
</script>
