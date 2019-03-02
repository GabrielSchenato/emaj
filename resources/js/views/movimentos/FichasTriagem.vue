<template>
  <div id="pageTable">
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex sm12>
          <h3>Fichas de Triagem Cadastradas no Sistema</h3>
        </v-flex>
        <v-flex lg12>
          <v-card>
            <v-toolbar card color="white">
              <v-btn color="primary" dark @click="abrirForm">Adicionar
                <v-icon right dark>add</v-icon>
              </v-btn>

              <ficha-triagem ref="fichatriagem"></ficha-triagem>
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
                  <td>{{ props.item.cliente }}</td>
                  <td>{{ props.item.partecontraria }}</td>
                  <td>{{ props.item.status }}</td>
                  <td>{{ props.item.data }}</td>
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
import { Items as FichasTriagem } from "@/config/fichastriagem";
import Confirm from "@/components/dialogs/Confirm.vue";
import FichaTriagem from "@/components/forms/movimentos/FichaTriagem.vue";

export default {
  components: {
    Confirm,
    FichaTriagem
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
          text: "Cliente",
          value: "cliente"
        },
        {
          text: "Parte Contrária",
          value: "partecontraria"
        },
        {
          text: "Status",
          value: "status"
        },
        {
          text: "Data",
          value: "data"
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
      cliente: "",
      partecontraria: "",
      status: "",
      data: ""
    },
    defaultItem: {
      cliente: "",
      partecontraria: "",
      status: "",
      data: ""
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
        ? "Adicionar uma nova ficha de triagem"
        : "Editar uma ficha de triagem";
    },
    initialize() {
      this.items = FichasTriagem;
    },
    editItem(item) {
      this.$refs.fichatriagem.step = 1;
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.$refs.fichatriagem
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
      this.$refs.fichatriagem
        .open(
          this.formTitle(),
          {},
          {
            color: "blue"
          }
        )
        .then(confirm => {
          if (confirm) {
            this.editedItem = Object.assign({}, this.$refs.fichatriagem.getValues());
            this.save();
          }
        });
    },

    deleteItem(item) {
      const index = this.items.indexOf(item);
      this.$refs.confirm
        .open(
          "Deletar",
          "Você tem certeza que deseja deletar esta ficha de triagem?",
          {
            color: "red"
          }
        )
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
