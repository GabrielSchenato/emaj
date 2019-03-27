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
            <v-flex xs12>
              <v-stepper v-model="step">
                <v-stepper-header>
                  <v-stepper-step step="1" :complete="step > 1" editable>Dados das Partes</v-stepper-step>
                  <v-divider></v-divider>
                  <v-stepper-step step="2" :complete="step > 2" :editable="step > 1">Informações</v-stepper-step>
                  <v-divider></v-divider>
                  <v-stepper-step step="3" :complete="step > 3" :editable="step > 2">Termo de Aceite</v-stepper-step>
                </v-stepper-header>
                <v-stepper-items>
                  <v-stepper-content step="1">
                    <v-card>
                      <v-card-text>
                        <v-card>
                          <v-card-text>
                            <form>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12 sm6 md6>
                                    <v-autocomplete
                                      label="Cliente*"
                                      :items="clientes"
                                      v-model="editedItem.cliente"
                                      item-text="nomecompleto"
                                      item-value="id"
                                      v-validate="'required'"
                                      :error-messages="errors.collect('cliente')"
                                      data-vv-name="cliente"
                                      required
                                      no-data-text="Nenhuma informação encontrada."
                                    ></v-autocomplete>
                                  </v-flex>

                                  <v-flex xs12 sm6 md6>
                                    <v-autocomplete
                                      label="Parte Contrária*"
                                      :items="clientes"
                                      v-model="editedItem.partecontraria"
                                      item-text="nomecompleto"
                                      item-value="id"
                                      v-validate="'required'"
                                      :error-messages="errors.collect('parte contrária')"
                                      data-vv-name="parte contrária"
                                      required
                                      no-data-text="Nenhuma informação encontrada."
                                    ></v-autocomplete>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </form>
                            <small>*Indica os campos que são obrigatórios</small>
                          </v-card-text>
                        </v-card>
                      </v-card-text>
                    </v-card>

                    <v-card-actions class="pt-0">
                      <v-spacer></v-spacer>
                      <v-btn color="primary" @click.native="validaDados(['cliente', 'parte contrária'], 2)">Continuar
                        <v-icon right dark>arrow_forward</v-icon>
                      </v-btn>
                    </v-card-actions>
                  </v-stepper-content>
                  <v-stepper-content step="2">
                    <v-card>
                      <v-card-text>
                        <v-card>
                          <v-card-text>
                            <form>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12 sm6 md6>
                                    <v-select
                                      :items="['Sim', 'Não']"
                                      label="Já foi atendido pelo escritório?*"
                                      v-model="editedItem.jafoiatendido"
                                      v-validate="'required'"
                                      :error-messages="errors.collect('já foi atendido pelo escritório')"
                                      data-vv-name="já foi atendido pelo escritório"
                                      required
                                    ></v-select>
                                  </v-flex>

                                  <v-flex xs12 sm6 md6>
                                    <v-autocomplete
                                      label="Tipo de Demanda*"
                                      :items="tiposdemandas"
                                      v-model="editedItem.tipodemanda"
                                      item-text="nome"
                                      item-value="id"
                                      v-validate="'required'"
                                      :error-messages="errors.collect('tipo de demanda')"
                                      data-vv-name="tipo de demanda"
                                      required
                                      no-data-text="Nenhuma informação encontrada."
                                    ></v-autocomplete>
                                  </v-flex>

                                  <v-flex xs12>
                                    <v-text-field
                                      v-model="editedItem.outrasinformacoes"
                                      label="Outras Informações"
                                    ></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </form>
                            <small>*Indica os campos que são obrigatórios</small>
                          </v-card-text>
                        </v-card>
                      </v-card-text>
                    </v-card>
                    <v-card-actions class="pt-0">
                      <v-spacer></v-spacer>
                      <v-btn color="primary" @click.native="validaDados(['já foi atendido pelo escritório', 'tipo de demanda'], 3)">Continuar
                        <v-icon right dark>arrow_forward</v-icon>
                      </v-btn>
                      <v-btn flat @click.native="step = 1">Voltar
                        <v-icon right dark >arrow_back</v-icon>
                      </v-btn>
                    </v-card-actions>
                  </v-stepper-content>
                  <v-stepper-content step="3">
                    <v-card>
                      <v-card-text>
                        <v-card>
                          <v-card-text>
                            <form>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12>
                                    <v-alert outline color="info" :value="true" icon="warning">
                                      <span class="headline text-uppercase">
                                        Declaro para os devidos fins que tenho ciência e estou de pleno
                                        acordo que serei atendido(a) por estagiário(s) do curso de direito
                                        da 8°, 9° e 10° fase, sob orientação de professor orientador.
                                      </span>
                                    </v-alert>
                                  </v-flex>
                                  <v-flex xs12>
                                    <v-checkbox
                                      v-model="editedItem.termoaceite"
                                      v-validate="'required'"
                                      :error-messages="errors.collect('termo de aceite')"
                                      data-vv-name="termo de aceite"
                                      required
                                    >
                                      <template v-slot:label>
                                        <div>Eu tenho ciência e aceito.*</div>
                                      </template>
                                    </v-checkbox>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </form>
                            <small>*Indica os campos que são obrigatórios</small>
                          </v-card-text>
                        </v-card>
                      </v-card-text>
                    </v-card>
                    <v-card-actions class="pt-0">
                      <v-spacer></v-spacer>
                      <v-btn color="primary" @click.native="validaDados(['termo de aceite'], 4)">Continuar
                        <v-icon right dark>arrow_forward</v-icon>
                      </v-btn>
                      <v-btn flat @click.native="step = 2">Voltar
                        <v-icon right dark>arrow_back</v-icon>
                      </v-btn>
                    </v-card-actions>
                  </v-stepper-content>

                  <v-stepper-content step="4">
                    <v-card>
                      <v-card-text>
                        <v-card>
                          <v-card-text>
                            <form>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12>
                                    <v-alert
                                      outline
                                      color="success"
                                      :value="true"
                                      icon="check_circle"
                                    >
                                      <span
                                        class="headline text-uppercase"
                                      >Processo realizado com sucesso, clique em salvar para gravar os dados.</span>
                                    </v-alert>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </form>
                          </v-card-text>
                        </v-card>
                      </v-card-text>
                    </v-card>
                    <v-card-actions class="pt-0">
                      <v-spacer></v-spacer>

                      <v-btn flat @click.native="step = 3">Voltar
                        <v-icon right dark>arrow_back</v-icon>
                      </v-btn>
                    </v-card-actions>
                  </v-stepper-content>
                </v-stepper-items>
              </v-stepper>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions class="pt-0">
        <v-spacer></v-spacer>
        <v-btn color="green" flat="flat" @click.native="save">Salvar
          <v-icon right dark>check</v-icon>
        </v-btn>
        <v-btn color="blue" flat="flat" @click.native="clear">Limpar
          <v-icon right dark>delete_sweep</v-icon>
        </v-btn>
        <v-btn color="red" flat="flat" @click.native="cancel">Cancelar
          <v-icon right dark>cancel</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { Items as Clientes } from "@/config/clientes";
import { Items as TiposDemandas } from "@/config/tiposdemandas";
import Vue from "vue";

export default {
  $_veeValidate: {
    validator: "new"
  },
  data: () => ({
    dialog: false,
    step: 1,
    resolve: null,
    reject: null,
    avatar: null,
    clientes: Clientes,
    tiposdemandas: TiposDemandas,
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
    }
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
    validaDados(names, step) {
      this.$validator.validateAll(names).then(valid => {
        if (valid) {
          this.step = step;
        }
      });
    },
    save() {
      this.$validator.validateAll().then(valid => {
        if (valid) {
          this.resolve(true);
          this.dialog = false;
        }
      });
    },
    cancel() {
      this.resolve(false);
      this.dialog = false;
    },
    clear() {
      this.editedItem.nomecompleto = "";
      this.$validator.reset();
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
    }
  }
};
</script>