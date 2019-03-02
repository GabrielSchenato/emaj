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
          >Perfil salvo com sucesso.</v-alert>

          <v-card>
            <v-toolbar card prominent extended color="primary" dark extension-height="15px">
              <v-toolbar-title class="headline">Atualizar Dados do Perfil</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-form ref="form" lazy-validation>
                <v-layout row wrap>
                  <v-flex xs12 md8>
                    <v-form>
                      <v-container py-0>
                        <v-layout wrap>
                          <v-flex xs12 md8>
                            <v-text-field
                              v-model="editedItem.nomecompleto"
                              v-validate="'required'"
                              :error-messages="errors.collect('nome completo')"
                              label="Nome Completo*"
                              data-vv-name="nome completo"
                              required
                            ></v-text-field>
                          </v-flex>
                          <v-flex xs12 md4>
                            <v-text-field
                              v-model="editedItem.telefone"
                              v-validate="'required'"
                              :error-messages="errors.collect('telefone')"
                              label="Telefone*"
                              data-vv-name="telefone"
                              required
                              type="number"
                            ></v-text-field>
                          </v-flex>

                          <v-flex xs12 md12>
                            <v-text-field
                              v-model="editedItem.email"
                              v-validate="'required'"
                              :error-messages="errors.collect('e-mail')"
                              label="E-mail*"
                              data-vv-name="e-mail"
                              required
                              type="email"
                            ></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm6 md5>
                            <v-text-field
                              v-model="editedItem.senha"
                              v-validate="'required'"
                              :error-messages="errors.collect('senha')"
                              label="Senha*"
                              data-vv-name="senha"
                              required
                              type="password"
                            ></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm6 md5>
                            <v-text-field
                              v-model="editedItem.confirmarsenha"
                              v-validate="'required'"
                              :error-messages="errors.collect('confirmar senha')"
                              label="Confirmar Senha*"
                              data-vv-name="confirmar senha"
                              required
                              type="password"
                            ></v-text-field>
                          </v-flex>
                        </v-layout>
                      </v-container>
                    </v-form>
                  </v-flex>
                  <v-flex xs12 md4>
                    <image-input v-model="avatar" slot="offset" class="mx-auto d-block" size="130">
                      <div slot="activator">
                        <v-avatar
                          v-ripple
                          v-if="editedItem.avatar && avatar === null"
                          slot="offset"
                          class="mx-auto d-block"
                          size="130"
                        >
                          <img :src="editedItem.avatar" alt="avatar">
                        </v-avatar>
                        <v-avatar
                          v-ripple
                          v-else-if="!avatar"
                          slot="offset"
                          class="mx-auto d-block"
                          size="130"
                        >
                          <span>Click para adicionar um avatar</span>
                        </v-avatar>
                        <v-avatar v-ripple v-else slot="offset" class="mx-auto d-block" size="130">
                          <img :src="avatar.imageURL" alt="avatar">
                        </v-avatar>
                      </div>
                    </image-input>

                    <v-card-text class="text-xs-center">
                      <h6 class="body-2 category text-gray font-weight-thin mb-3">Administrador</h6>
                      <h4 class="card-title font-weight-light">Gabriel Schenato</h4>
                    </v-card-text>
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
import ImageInput from "@/components/ImageInput.vue";

Vue.use(VeeValidate);

export default {
  components: {
    ImageInput: ImageInput
  },
  $_veeValidate: {
    validator: "new"
  },
  data: () => ({
    salvo: null,
    avatar: null,
    editedItem: {
      avatar:
        "https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg",
      nomecompleto: "Gabriel Schenato",
      telefone: 99999999,
      email: "gabriel@uniplaclages.edu.br"
    },
    defaultItem: {
      nomecompleto: "",
      telefone: "",
      email: ""
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
