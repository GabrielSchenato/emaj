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
        >
          <template slot="items" slot-scope="props">
            <td>
              <v-checkbox primary hide-details v-model="props.selected"></v-checkbox>
            </td>
            <td>{{ props.item.id }}</td>
            <td>{{ props.item.tipo }}</td>
            <td>{{ props.item.descricao }}</td>
            <td>{{ props.item.ddd }}</td>
            <td>{{ props.item.numero }}</td>
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
import { Items as Telefones } from "@/config/telefones";
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
            text: "DDD",
            value: "ddd"
          },
          {
            text: "Número",
            value: "numero"
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
  methods: {
    initialize() {
      this.items = Telefones;
    },
    telefoneFormTitle() {
      return this.editedIndex === -1
        ? "Adicionar um novo telefone"
        : "Editar um telefone";
    },
    editItem(item) {
      this.telefoneIndex = this.items.indexOf(item);
      this.telefoneItem = Object.assign({}, item);
      this.$refs.telefoneDialog
        .open(this.telefoneFormTitle(), this.telefoneItem, {
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
          this.telefoneFormTitle(),
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
          if (confirm) this.items.splice(index, 1);
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
    }
  }
};
</script>