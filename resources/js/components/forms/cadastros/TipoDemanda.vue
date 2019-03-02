<template>
  <v-dialog
    v-model="dialog"
    :max-width="options.width"
    @keydown.esc="cancel"
    v-bind:style="{ zIndex: options.zIndex }"
  >
    <v-card>
      <v-toolbar dark :color="options.color" dense flat>
        <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <v-container grid-list-md>
          <v-layout wrap>
            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.nome" label="Nome"></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.descricao" label="Sobrenome"></v-text-field>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions class="pt-0">
        <v-spacer></v-spacer>
        <v-btn color="green" flat="flat" @click.native="save">Salvar
          <v-icon right dark>check</v-icon>
        </v-btn>
        <v-btn color="red" flat="flat" @click.native="cancel">Cancelar
          <v-icon right dark>cancel</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    resolve: null,
    reject: null,
    editedItem: {
      nome: "",
      descricao: ""
    },
    formTitle: null,
    options: {
      color: "primary",
      width: 1000,
      zIndex: 1000
    }
  }),
  methods: {
    getValues() {
      return this.editedItem;
    },
    open(title, item, options) {
      this.dialog = true;
      this.formTitle = title;
      this.editedItem = item;
      this.options = Object.assign(this.options, options);
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
        this.reject = reject;
      });
    },
    save() {
      this.resolve(true);
      this.dialog = false;
    },
    cancel() {
      this.resolve(false);
      this.dialog = false;
    }
  }
};
</script>