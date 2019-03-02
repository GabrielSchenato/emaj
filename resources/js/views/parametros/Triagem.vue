<template>
  <div id="pageTable">
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg12>
          <v-alert
            outline
            color="success"
            icon="check_circle"
            :value="salvo"
          >Parâmetros salvo com sucesso.</v-alert>

          <v-card>
            <v-toolbar card prominent extended color="primary" dark extension-height="15px">
              <v-toolbar-title class="headline">Parâmetros da Triagem</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-form ref="form" lazy-validation>
                <v-layout row wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="editedItem.renda"
                      v-validate="'required'"
                      :error-messages="errors.collect('renda')"
                      label="Renda*"
                      data-vv-name="renda"
                      required
                    >
                      <template v-slot:prepend>
                        <v-tooltip bottom light color="success">
                          <template v-slot:activator="{ on }">
                            <v-icon v-on="on">not_listed_location</v-icon>
                          </template>Utilizado para validar se a renda do cliente está dentro do requerido pelo EMAJ
                        </v-tooltip>
                      </template>
                    </v-text-field>
                  </v-flex>
                </v-layout>
              </v-form>
              <small>*Indica os campos que são obrigatórios</small>
            </v-card-text>
            <v-card-actions class="pt-0">
              <v-spacer></v-spacer>
              <v-btn color="green" flat="flat" @click.native="save">Salvar
                <v-icon right dark>check</v-icon>
              </v-btn>
              <v-btn color="blue" flat="flat" @click.native="clear">Limpar
                <v-icon right dark>delete_sweep</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Vue from "vue";
import VeeValidate from "vee-validate";
Vue.use(VeeValidate);
export default {
  $_veeValidate: {
    validator: "new"
  },
  data: () => ({
    salvo: null,
    editedItem: {
      renda: "1500,00"
    },
    defaultItem: {
      renda: "1500,00"
    }
  }),

  methods: {
    save() {
      this.$validator.validateAll().then(valid => {
        if (valid) {
          this.salvo = true;
        }
        setTimeout(() => {
          this.salvo = false;
        }, 2500);
      });
    },
    clear() {
      this.editedItem.renda = "";
      this.$validator.reset();
    }
  }
};
</script>
