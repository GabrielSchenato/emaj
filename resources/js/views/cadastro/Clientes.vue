<template>
  <div id="pageTable">
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex sm12>
          <h3>Clientes Cadastrados no Sistema</h3>
        </v-flex>
        <v-flex lg12>
          <v-card>
            <v-toolbar card color="white">
              <v-btn color="primary" dark @click="abrirForm">Adicionar
                <v-icon right dark>add</v-icon>
              </v-btn>

              <cliente-dialog ref="clienteDialog"></cliente-dialog>
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
              >
                <template slot="items" slot-scope="props">
                  <td>
                    <v-checkbox primary hide-details v-model="props.selected"></v-checkbox>
                  </td>
                  <td>{{ props.item.id }}</td>
                  <td>{{ props.item.nomecompleto }}</td>
                  <td>{{ props.item.cpf }}</td>
                  <td>{{ props.item.rg }}</td>
                  <td>{{ props.item.profissao }}</td>
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
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import { Items as Clientes } from "@/config/clientes";
import Confirm from "@/components/dialogs/Confirm.vue";
import ClienteDialog from "@/components/cadastro/dialogs/ClienteDialog.vue";

export default {
  components: {
    Confirm,
    ClienteDialog
  },

  data: () => ({
    dialog: false,
    search: "",
    complex: {
      selected: [],
      headers: [
        {
          text: "ID",
          value: "id"
        },
        {
          text: "Nome",
          value: "nomecompleto"
        },
        {
          text: "CPF",
          value: "cpf"
        },
        {
          text: "RG",
          value: "rg"
        },
        {
          text: "Profissão",
          value: "profissao"
        },
        {
          text: "Ação",
          value: "",
          sortable: false
        }
      ]
    },
    items: [],
    editedIndex: -1,
    editedItem: {
      nomecompleto: "",
      cpf: "",
      rg: "",
      profissao: ""
    },
    defaultItem: {
      nomecompleto: "",
      cpf: "",
      rg: "",
      profissao: ""
    }
  }),
  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    formTitle() {
      return this.editedIndex === -1
        ? "Adicionar um novo cliente"
        : "Editar um cliente";
    },
    initialize() {
      this.items = Clientes;
    },
    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.$refs.clienteDialog
        .open(this.formTitle(), this.editedItem, {
          color: "blue"
        })
        .then(confirm => {
          if (confirm) {
            this.save();
          }
        });
    },

    abrirForm() {
      this.$refs.clienteDialog
        .open(
          this.formTitle(),
          {},
          {
            color: "blue"
          }
        )
        .then(confirm => {
          if (confirm) {
            this.editedItem = Object.assign({}, this.$refs.clienteDialog.getValues());
            this.save();
          }
        });
    },

    deleteItem(item) {
      const index = this.items.indexOf(item);
      this.$refs.confirm
        .open("Deletar", "Você tem certeza que deseja deletar este cliente?", {
          color: "red"
        })
        .then(confirm => {
          if (confirm) this.items.splice(index, 1);
        });
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.items[this.editedIndex], this.editedItem);
      } else {
        this.items.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
