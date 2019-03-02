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
            <v-flex xs10 offset-xs5>
              <image-input v-model="avatar">
                <div slot="activator">
                  <v-avatar size="150px" v-ripple v-if="editedItem.avatar" class="mb-3">
                    <img :src="editedItem.avatar" alt="avatar">
                  </v-avatar>
                  <v-avatar size="150px" v-ripple v-else-if="!avatar" class="grey lighten-3 mb-3">
                    <span>Click para adicionar um avatar</span>
                  </v-avatar>
                  <v-avatar size="150px" v-ripple v-else class="mb-3">
                    <img :src="avatar.imageURL" alt="avatar">
                  </v-avatar>
                </div>
              </image-input>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.nome" label="Nome"></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.sobrenome" label="Sobrenome"></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.email" label="E-mail"></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.telefone" label="Telefone"></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-autocomplete
                label="Nível de Permissão"
                :items="permissoes"
                v-model="editedItem.permissao"
                item-text="nome"
                item-value="id"
              ></v-autocomplete>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field v-model="editedItem.senha" type="password" label="Senha"></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
              <v-text-field
                v-model="editedItem.confirmarsenha"
                type="password"
                label="Confirmar Senha"
              ></v-text-field>
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
import ImageInput from "@/components/ImageInput.vue";

export default {
  components: {
    ImageInput: ImageInput
  },
  data: () => ({
    dialog: false,
    resolve: null,
    reject: null,
    avatar: null,
    permissoes: [
      {
        nome: "Administrator",
        id: 1
      },
      {
        nome: "Secretária",
        id: 2
      },
      {
        nome: "Aluno",
        id: 3
      }
    ],
    editedItem: {
    avatar: "",
      nome: "",
      sobrenome: "",
      email: "",
      telefone: "",
      permissao: ""
    },
    formTitle: null,
    options: {
      color: "primary",
      width: 1000,
      zIndex: 1000
    }
  }),
  watch: {
    search(val) {
      val && this.querySelections(val);
    },
  },
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
              this.avatar = null;
      this.resolve(true);
      this.dialog = false;
    },
    cancel() {
      this.resolve(false);
      this.dialog = false;
      this.avatar = null;
    },
    querySelections(v) {
      this.loading = true;
      // Simulated ajax query
      setTimeout(() => {
        this.permissoes = this.permissoes.filter(e => {
          return (
            (e.nome || "").toLowerCase().indexOf((v || "").toLowerCase()) > -1
          );
        });
        this.loading = false;
      }, 500);
    },
  }
};
</script>