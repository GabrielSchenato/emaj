<template>
  <v-form>
    <v-flex xs12>
      <v-alert type="warning" :value="naoLocalizado">CEP não encontrado, tente novamente!</v-alert>
    </v-flex>

    <v-layout wrap>
      <v-flex xs12 sm6 md1>
        <v-text-field
          name="id"
          id="id"
          v-model="endereco.id"
          label="ID"
          disabled
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md2>
        <v-text-field
          name="cep"
          id="cep"
          v-model="endereco.cep"
          v-validate="'required'"
          :error-messages="errors.collect('CEP')"
          label="CEP*"
          data-vv-name="CEP"
          required
          mask="#####-###"
          @keyup="buscar"
          @input="$emit('input', endereco)"
          :disabled="buscandoCep"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="logradouro"
          id="logradouro"
          v-model="endereco.logradouro"
          v-validate="'required'"
          :error-messages="errors.collect('logradouro')"
          label="Logradouro*"
          data-vv-name="logradouro"
          required
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md4>
        <v-text-field
          name="complemento"
          id="complemento"
          v-model="endereco.complemento"
          label="Complemento"
          data-vv-name="complemento"
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="bairro"
          id="bairro"
          v-model="endereco.bairro"
          v-validate="'required'"
          :error-messages="errors.collect('bairro')"
          label="Bairro*"
          data-vv-name="bairro"
          required
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="localidade"
          id="localidade"
          v-model="endereco.localidade"
          v-validate="'required'"
          :error-messages="errors.collect('cidade')"
          label="Cidade*"
          data-vv-name="cidade"
          required
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md1>
        <v-text-field
          name="uf"
          id="uf"
          v-model="endereco.uf"
          v-validate="'required'"
          :error-messages="errors.collect('estado')"
          label="Estado*"
          data-vv-name="estado"
          required
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="endereco_local_trabalho"
          id="endereco_local_trabalho"
          v-model="endereco.endereco_local_trabalho"
          label="Endereço do Local de Trabalho"
          @input="$emit('input', endereco)"
        ></v-text-field>
      </v-flex>
    </v-layout>
  </v-form>
</template>
<script>
export default {
  name: "endereco-form",
  $_veeValidate: {
    validator: "new"
  },
  props: {
    value: {
      type: [Object]
    }
  },
  data() {
    return {
      endereco: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
      naoLocalizado: false,
      buscandoCep: false
    };
  },
  watch: {
    value: {
      handler() {
        this.endereco = Object.assign({}, this.value);
      },
      deep: true
    }
  },
  methods: {
    buscar: function() {
      if (/^[0-9]{5}[0-9]{3}$/.test(this.endereco.cep)) {
        var self = this;
        self.naoLocalizado = false;
        self.buscandoCep = true;

        $.getJSON(
          "https://viacep.com.br/ws/" + this.endereco.cep + "/json/",
          function(endereco) {
            if (endereco.erro) {
              self.naoLocalizado = true;
              self.endereco = {};
              self.buscandoCep = false;
              return;
            }
            self.endereco = endereco;
          }
        );
        self.buscandoCep = false;
      }
    }
  }
};
</script>