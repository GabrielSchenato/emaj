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
                                :items="fichaTriagens"
                                :pagination.sync="pagination" 
                                :total-items="totalFichaTriagens"
                                :rows-per-page-items="[10,25,50,100]"
                                class="elevation-1"
                                item-key="id"
                                rows-per-page-text="Linhas por página"
                                no-results-text="Nenhum registro correspondente encontrado"
                                no-data-text="Não há registros para serem exibidos."
                                :loading="loading"
                                >
                                <template slot="items" slot-scope="props">
                                    <td>{{ props.item.protocolo }}</td>
                                    <td>{{ props.item.numero_processo }}</td>
                                    <td>{{ props.item.nome_cliente }}</td>
                                    <td>{{ props.item.nome_parte_contraria }}</td>
                                    <td>{{ props.item.nome_tipo_demanda }}</td>
                                    <td>{{ props.item.status }}</td>
                                    <td>{{ props.item.nome_aluno }}</td>
                                    <td>{{ props.item.ativo | formataAtivo }}</td>
                                    <td>

                                    <v-speed-dial
                                        direction="left"
                                        open-on-hover
                                        transition="slide-y-reverse-transition"
                                        >
                                        <template v-slot:activator>
                                            <v-btn
                                                color="blue darken-2"
                                                depressed
                                                outline
                                                icon
                                                fab
                                                dark
                                                small
                                                >
                                                <v-icon>menu</v-icon>
                                                <v-icon>close</v-icon>
                                            </v-btn>
                                        </template>

                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn depressed icon fab dark color="primary" small v-if="$auth.check(['admin', 'secretaria'])" v-on="on">
                                                    <v-icon
                                                        @click="imprimirFichaTriagem(
                                                        {
                                                        cliente_id: props.item.cliente_id,
                                                        parte_contraria_id: props.item.parte_contraria_id,
                                                        ficha_triagem_id: props.item.id
                                                        }
                                                        )"
                                                        >print
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Imprimir</span>
                                        </v-tooltip>

                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn depressed icon fab dark color="primary" small v-if="$auth.check(['admin', 'secretaria'])" v-on="on">
                                                    <v-icon @click="editar(props.item.id)">edit</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Editar</span>
                                        </v-tooltip>

                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn depressed icon fab dark color="pink" small v-if="$auth.check(['admin', 'secretaria'])" v-on="on">
                                                    <v-icon @click="deletar(props.item)">delete</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Deletar</span>
                                        </v-tooltip>

                                    </v-speed-dial>

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
    import FilterForm from "@/components/FilterForm";

    export default {
        components: {
            Confirm,
            FichaTriagemDialog,
            FilterForm
        },

        data: () => ({
                dialog: false,
                search: {},
                loading: false,
                parametrosTriagem: true,
                pagination: {descending: true},
                fichaTriagens: [],
                totalFichaTriagens: 0,
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "Protocolo",
                            value: "protocolo",
                            filterable: true,
                            type: 'text',
                            initial: true
                        },
                        {
                            text: "N.º Processo",
                            value: "numero_processo",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Cliente",
                            value: "nome_cliente",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Parte Contrária",
                            value: "nome_parte_contraria",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Tipo de Demanda",
                            value: "nome_tipo_demanda",
                            filterable: true,
                            type: 'text'
                        },
                        {
                            text: "Status",
                            value: "status",
                            filterable: true,
                            type: 'combo',
                            options: [{text: 'Ajuizado', value: 'Ajuizado'}, {text: 'Não Ajuizado', value: 'Não Ajuizado'}]
                        },
                        {
                            text: "Aluno",
                            value: "nome_aluno",
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
                this.$refs.fichaTriagemDialog
                        .open(
                                'Adicionar uma nova Ficha de Triagem',
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
                this.$store.dispatch("getFichaTriagem", id).then(() => {
                    this.$refs.fichaTriagemDialog
                            .open(
                                    'Editar uma Ficha de Triagem',
                                    this.$store.state.fichatriagem.fichaTriagemView,
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
                        .open("Deletar", "Você tem certeza que deseja deletar essa Ficha de Triagem?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeFichaTriagem", item).then(() => {
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
            imprimirFichaTriagem(object) {
                let data = {...object, ...{formato: "pdf"}};
                this.gerarImpressao(data, "/fichatriagens/imprimir-ficha-triagem");
            },
            getData() {
                this.loading = true;
                this.$store.dispatch("getFichaTriagens", this.paginationTable(this.params)).then(() => {
                    this.fichaTriagens = this.$store.state.fichatriagem.fichaTriagemList.data;
                    this.totalFichaTriagens = this.$store.state.fichatriagem.fichaTriagemList.total;
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
        },
        mounted() {
            if (this.$store.state.parametrostriagem.parametrosTriagemView.id != null)
                return;

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
