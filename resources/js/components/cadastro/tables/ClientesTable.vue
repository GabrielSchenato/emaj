<template>
    <v-flex xs12>
        <cliente-dialog ref="clienteDialog"></cliente-dialog>
        <v-card>
            <v-toolbar card color="white">
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
                    :items="items"
                    :rows-per-page-items="[10,25,50,{text:'Todos','value':-1}]"
                    class="elevation-1"
                    item-key="id"
                    rows-per-page-text="Linhas por página"
                    no-results-text="Nenhum registro correspondente encontrado"
                    no-data-text="Não há registros para serem exibidos."
                    disable-initial-sort
                    >
                    <template slot="items" slot-scope="props">
                        <td v-bind:class="{ vermelho: !props.item.protocolo.ativo }">{{ props.item.protocolo.cliente.dados_cliente }}</td>
                        <td v-bind:class="{ vermelho: !props.item.protocolo.ativo }">{{ props.item.professor ? props.item.professor.dados_usuario : 'Não informado' }}</td>
                        <td v-bind:class="{ vermelho: !props.item.protocolo.ativo }">{{ props.item.protocolo.protocolo }}</td>
                        <td v-bind:class="{ vermelho: !props.item.protocolo.ativo }">{{ props.item.protocolo.numero_processo }}</td>
                        <td v-bind:class="{ vermelho: !props.item.protocolo.ativo }">{{ props.item.protocolo.observacoes }}</td>
                        <td v-bind:class="{ vermelho: !props.item.protocolo.ativo }">{{ props.item.data_vinculo | formataData }}</td>
                        <td>
                        <v-btn depressed outline icon fab dark color="blue" small>
                            <v-icon @click="showCliente(props.item.protocolo.cliente.id)">visibility</v-icon>
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
</template>
<script>
    import Confirm from "@/components/dialogs/Confirm.vue";

    export default {
        name: "clientes-table",
        components: {
            Confirm
        },
        props: {
            value: {
                type: [Array]
            }
        },
        data() {
            return {
                search: "",
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "Cliente",
                            value: "protocolo.cliente.dados_cliente"
                        },
                        {
                            text: "Professor",
                            value: "professor.dados_usuario"
                        },
                        {
                            text: "Protocolo",
                            value: "protocolo.protocolo"
                        },
                        {
                            text: "N.º Processo",
                            value: "protocolo.numero_processo"
                        },
                        {
                            text: "Outras Informações",
                            value: "protocolo.observacoes"
                        },
                        {
                            text: "Data Vínculo",
                            value: "data_vinculo"
                        },
                        {
                            text: "Ação",
                            value: "",
                            sortable: false
                        }
                    ]
                },
                items: []
            };
        },
        created() {
            this.initialize();
        },
        watch: {
            value: {
                handler() {
                    this.items = this.value;
                },
                deep: true
            }
        },
        methods: {
            initialize() {
                this.items = this.value;
            },
            showCliente(id) {
                this.$store.dispatch("getCliente", id).then(() => {
                    this.$refs.clienteDialog
                            .open(
                                    'Editar Cliente',
                                    this.$store.state.cliente.clienteView,
                                    {
                                        color: "blue"
                                    }
                            );
                    this.$refs.clienteDialog.step = 5;
                });
            }
        }
    };
</script>