<template>
  <v-layout row justify-center>
    <v-dialog
      v-model="dialog"
      :max-width="options.width"
      @keydown.esc="cancel"
      v-bind:style="{ zIndex: options.zIndex }"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <v-card>
        <v-toolbar dark :color="options.color" dense flat>
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-card>
            <v-toolbar card prominent extended color="primary" dark extension-height="15px">
              <v-toolbar-title class="headline">Dados do cliente</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <form>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.nomecompleto"
                        v-validate="'required'"
                        :error-messages="errors.collect('nome completo')"
                        label="Nome Completo*"
                        data-vv-name="nome completo"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.representado_assistido"
                        v-validate="'required'"
                        :error-messages="errors.collect('representado assistido')"
                        label="Representado/Assistido"
                        data-vv-name="representado_assistido"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.cpf"
                        v-validate="'required'"
                        :error-messages="errors.collect('CPF')"
                        label="CPF*"
                        data-vv-name="CPF"
                        required
                        type="number"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md2>
                      <v-text-field
                        v-model="editedItem.rg"
                        v-validate="'required'"
                        :error-messages="errors.collect('RG')"
                        label="RG*"
                        data-vv-name="CPF"
                        required
                        type="number"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.profissao"
                        v-validate="'required'"
                        :error-messages="errors.collect('profissão')"
                        label="Profissão*"
                        data-vv-name="profissão"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md2>
                      <v-select
                        :items="['Masculino', 'Feminino']"
                        label="Sexo*"
                        v-model="editedItem.sexo"
                        v-validate="'required'"
                        :error-messages="errors.collect('sexo')"
                        data-vv-name="sexo"
                        required
                      ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-select
                        :items="['Solteiro', 'Casado', 'Separado', 'Divorciado', 'Viúvo']"
                        label="Estado Civil*"
                        v-model="editedItem.estadocivil"
                        v-validate="'required'"
                        :error-messages="errors.collect('estado civil')"
                        data-vv-name="estado civil"
                        required
                      ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md2>
                      <v-select
                        :items="['Brasileiro', 'Argentino']"
                        label="Nacionalidade*"
                        v-model="editedItem.nacionalidade"
                        v-validate="'required'"
                        :error-messages="errors.collect('nacionalidade')"
                        data-vv-name="nacionalidade"
                        required
                      ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.email"
                        label="E-mail"
                        :error-messages="errors.collect('e-mail')"
                        type="email"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md2>
                      <v-text-field
                        v-model="editedItem.renda"
                        label="Renda*"
                        v-validate="'required'"
                        :error-messages="errors.collect('renda')"
                        data-vv-name="renda"
                        required
                        type="number"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.localtrabalho"
                        label="Local de Trabalho*"
                        v-validate="'required'"
                        :error-messages="errors.collect('local de trabalho')"
                        data-vv-name="local de trabalho"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-text-field
                        v-model="editedItem.enderecolocaltrabalho"
                        label="Endereço do Local de Trabalho"
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12>
                      <v-divider></v-divider>
                      <v-subheader class="headline">Endereço</v-subheader>
                      <v-alert
                        type="warning"
                        :value="naoLocalizado"
                      >CEP não encontrado, tente novamente!</v-alert>
                    </v-flex>

                    <v-flex xs12 sm6 md2>
                      <v-text-field
                        v-model="cep"
                        v-validate="'required'"
                        :error-messages="errors.collect('CEP')"
                        label="CEP*"
                        data-vv-name="CEP"
                        required
                        mask="#####-###"
                        @keyup="buscar"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="endereco.logradouro"
                        v-validate="'required'"
                        :error-messages="errors.collect('logradouro')"
                        label="Logradouro*"
                        data-vv-name="logradouro"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md1>
                      <v-text-field
                        v-model="endereco.numero"
                        v-validate="'required'"
                        :error-messages="errors.collect('número')"
                        label="Número*"
                        data-vv-name="número"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md5>
                      <v-text-field
                        v-model="endereco.complemento"
                        label="Complemento"
                        data-vv-name="complemento"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="endereco.bairro"
                        v-validate="'required'"
                        :error-messages="errors.collect('bairro')"
                        label="Bairro*"
                        data-vv-name="bairro"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="endereco.localidade"
                        v-validate="'required'"
                        :error-messages="errors.collect('cidade')"
                        label="Cidade*"
                        data-vv-name="cidade"
                        required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md1>
                      <v-text-field
                        v-model="endereco.uf"
                        v-validate="'required'"
                        :error-messages="errors.collect('estado')"
                        label="Estado*"
                        data-vv-name="estado"
                        required
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12>
                      <v-divider></v-divider>
                      <v-subheader class="headline">Telefones</v-subheader>
                    </v-flex>

                    <v-flex xs12>
                      <v-card>
                        <v-toolbar card color="white">
                          <v-btn color="primary" dark @click="abrirForm">Adicionar
                            <v-icon right dark>add</v-icon>
                          </v-btn>

                          <telefone ref="telefone"></telefone>
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
                              <td>{{ props.item.tipo }}</td>
                              <td>{{ props.item.descricao }}</td>
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

                    <v-flex xs12>
                      <v-divider></v-divider>
                      <v-subheader class="headline">Composição Familiar</v-subheader>
                    </v-flex>

                    <v-flex xs12 sm6 md2>
                      <v-text-field
                        v-model="editedItem.rendafamiliar"
                        label="Renda Familiar*"
                        v-validate="'required'"
                        :error-messages="errors.collect('renda familiar')"
                        data-vv-name="renda familiar"
                        required
                        type="number"
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md2>
                      <v-select
                        :items="['Alugada', 'Própria', 'Cedida']"
                        label="Casa*"
                        v-model="editedItem.casa"
                        v-validate="'required'"
                        :error-messages="errors.collect('casa')"
                        data-vv-name="casa"
                        required
                      ></v-select>
                    </v-flex>

                    <v-flex xs12 sm6 md1>
                      <v-layout align-center class="ma-0">
                        <v-checkbox
                          v-model="editedItem.carro"
                          hide-details
                          class="shrink mr-2"
                          label="Carro"
                        ></v-checkbox>
                      </v-layout>
                    </v-flex>

                    <v-flex xs12 sm6 md2>
                      <v-text-field
                        label="Marca"
                        v-model="editedItem.marca"
                        :disabled="!editedItem.carro"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md1>
                      <v-text-field
                        label="Ano"
                        v-model="editedItem.ano"
                        :disabled="!editedItem.carro"
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md1>
                      <v-layout align-center class="ma-0">
                        <v-checkbox
                          v-model="editedItem.moto"
                          hide-details
                          class="shrink mr-2"
                          label="Moto"
                        ></v-checkbox>
                      </v-layout>
                    </v-flex>

                    <v-flex xs12 sm6 md2>
                      <v-text-field
                        label="Marca"
                        v-model="editedItem.marca"
                        :disabled="!editedItem.moto"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md1>
                      <v-text-field
                        label="Ano"
                        v-model="editedItem.ano"
                        :disabled="!editedItem.moto"
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.outrosbens"
                        label="Outros Bens*"
                        v-validate="'required'"
                        :error-messages="errors.collect('outros bens')"
                        data-vv-name="outros bens"
                        required
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.dividas"
                        label="Dívidas*"
                        v-validate="'required'"
                        :error-messages="errors.collect('dívidas')"
                        data-vv-name="dívidas"
                        required
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.despesas"
                        label="Despesas*"
                        v-validate="'required'"
                        :error-messages="errors.collect('despesas')"
                        data-vv-name="despesas"
                        required
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field
                        v-model="editedItem.valorpatrimonio"
                        label="Valor do Patrimônio*"
                        v-validate="'required'"
                        :error-messages="errors.collect('valor do patrimônio')"
                        data-vv-name="valor do patrimônio"
                        required
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6 md8>
                      <v-text-field v-model="editedItem.observacoes" label="Observações"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-container>
              </form>
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
              <v-btn color="red" flat="flat" @click.native="cancel">Cancelar
                <v-icon right dark>cancel</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
import { Items as Telefones } from "@/config/telefones";
import Vue from "vue";
import VeeValidate from "vee-validate";
import Confirm from "@/components/dialogs/Confirm.vue";
import Telefone from "@/components/forms/cadastros/Telefone.vue";

Vue.use(VeeValidate);

export default {
  components: {
    Confirm,
    Telefone
  },
  $_veeValidate: {
    validator: "new"
  },
  data: () => ({
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
    telefoneIndex: -1,
    telefoneIndex: {
      tipo: "",
      descricao: "",
      numero: ""
    },
    defaultItem: {
      tipo: "",
      descricao: "",
      numero: ""
    },
    dialogTelefone: false,
    dialog: false,
    resolve: null,
    reject: null,
    naoLocalizado: false,
    cep: "",
    endereco: {},
    editedItem: {
      nomecompleto: "",
      cpf: "",
      rg: "",
      profissao: ""
    },
    formTitle: null,
    options: {
      color: "primary",
      width: 1000,
      zIndex: 1000
    }
  }),
  created() {
    this.initialize();
  },
  methods: {
    getValues() {
      return this.editedItem;
    },
    initialize() {
      this.items = Telefones;
    },
    telefoneFormTitle() {
      return this.editedIndex === -1
        ? "Adicionar um novo telefone"
        : "Editar um telefone";
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
    buscar: function() {
      this.naoLocalizado = false;

      if (/^[0-9]{5}[0-9]{3}$/.test(this.cep)) {
        $.getJSON("https://viacep.com.br/ws/" + this.cep + "/json/", function(
          endereco
        ) {
          if (endereco.erro) {
            this.endereco = {};
            this.naoLocalizado = true;
            return;
          }
          this.endereco = endereco;
        });
      }
    },
    editItem(item) {
      this.telefoneIndex = this.items.indexOf(item);
      this.telefoneItem = Object.assign({}, item);
      this.$refs.telefone
        .open(this.telefoneFormTitle(), this.telefoneItem, {
          color: "blue"
        })
        .then(confirm => {
          if (confirm) {
            this.save();
          }
        });
    },

    abrirForm() {
      this.$refs.telefone
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
              this.$refs.telefone.getValues()
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