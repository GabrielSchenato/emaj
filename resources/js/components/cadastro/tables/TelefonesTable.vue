<template>
    <v-flex xs12>
        <v-card>
            <v-toolbar card color="white">
                <v-btn color="primary" dark @click="abrirForm">Adicionar
                    <v-icon right dark>add</v-icon>
                </v-btn>

                <telefone-dialog ref="telefoneDialog"></telefone-dialog>
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
                    :items="items"
                    :rows-per-page-items="[10,25,50,{text:'Todos','value':-1}]"
                    class="elevation-1"
                    item-key="id"
                    select-all
                    v-model="complex.selected"
                    rows-per-page-text="Linhas por página"
                    no-results-text="Nenhum registro correspondente encontrado"
                    no-data-text="Não há registros para serem exibidos."
                    disable-initial-sort
                    >
                    <template slot="items" slot-scope="props">
                        <td>
                        <v-checkbox primary hide-details v-model="props.selected"></v-checkbox>
                        </td>
                        <td>{{ props.item.id }}</td>
                        <td>{{ props.item.tipo }}</td>
                        <td>{{ props.item.descricao }}</td>
                        <td>{{ props.item.telefone }}</td>
                        <td>{{ props.item.created_at | formataData}}</td>
                        <td>{{ props.item.updated_at | formataData}}</td>
                        <td>
                        <v-btn depressed outline icon fab dark color="primary" small>
                            <v-icon @click="editItem(props.item)">edit</v-icon>
                        </v-btn>
                        <v-btn depressed outline icon fab dark color="pink" small>
                            <v-icon @click="deleteItem(props.item)">delete</v-icon>
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
    import TelefoneDialog from "@/components/cadastro/dialogs/TelefoneDialog.vue";

    export default {
        name: "telefones-table",
        components: {
            Confirm,
            TelefoneDialog
        },
        $_veeValidate: {
            validator: "new"
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
                            text: "ID",
                            value: "id"
                        },
                        {
                            text: "Tipo",
                            value: "tipo"
                        },
                        {
                            text: "Descrição",
                            value: "descricao"
                        },
                        {
                            text: "Telefone",
                            value: "telefone"
                        },
                        {
                            text: "Criado em",
                            value: "created_at"
                        },
                        {
                            text: "Atualizado em",
                            value: "updated_at"
                        },
                        {
                            text: "Ação",
                            value: "",
                            sortable: false
                        }
                    ]
                },
                items: [],
                telefoneIndex: -1
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
            editItem(item) {
                this.telefoneIndex = this.items.indexOf(item);
                this.telefoneItem = Object.assign({}, item);
                this.$refs.telefoneDialog
                        .open("Editar um telefone", this.telefoneItem, {
                            color: "blue"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.telefoneItem = Object.assign(
                                        {},
                                        this.$refs.telefoneDialog.getValues()
                                        );
                                this.save();
                            }
                        });
            },

            abrirForm() {
                this.$refs.telefoneDialog
                        .open(
                                "Adicionar um novo telefone",
                                {},
                                {
                                    color: "blue"
                                }
                        )
                        .then(confirm => {
                            if (confirm) {
                                this.telefoneItem = Object.assign(
                                        {},
                                        this.$refs.telefoneDialog.getValues()
                                        );
                                this.save();
                            }
                        });
            },

            deleteItem(item) {
                const index = this.items.indexOf(item);
                this.$refs.confirm
                        .open("Deletar", "Você tem certeza que deseja deletar este telefone?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.items.splice(index, 1);
                                if (item.id) {
                                    window.axios.delete('telefones/' + item.id).then(() => {
                                        window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    }).catch((resp) => {
                                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro!', timeout: 2000});
                                    });
                                }
                            }
                            this.$emit('input', this.items);
                        });
            },

            close() {
                this.dialogTelefone = false;
                setTimeout(() => {
                    this.telefoneItem = Object.assign({}, this.defaultItem);
                    this.telefoneIndex = -1;
                }, 300);
            },

            save() {
                if (this.telefoneIndex > -1) {
                    Object.assign(this.items[this.telefoneIndex], this.telefoneItem);
                } else {
                    this.items.push(this.telefoneItem);
                }
                this.close();
                this.$emit('input', this.items);
            }
        }
    };
</script>