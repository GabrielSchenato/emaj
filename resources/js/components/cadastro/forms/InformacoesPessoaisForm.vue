<template>
  <v-form>
    <v-layout wrap>
      <v-flex xs12 sm6 md1>
        <v-text-field
          name="id"
          id="id"
          v-model="informacoesPessoais.id"
          label="ID"
          disabled
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md6>
        <v-text-field
          name="nome_completo"
          id="nome_completo"
          v-model="informacoesPessoais.nome_completo"
          v-validate="'required'"
          :error-messages="errors.collect('nome completo')"
          label="Nome Completo*"
          data-vv-name="nome completo"
          required
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="representado_assistido"
          id="representado_assistido"
          v-model="informacoesPessoais.representado_assistido"
          label="Representado/Assistido"
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md3>
        <v-text-field
          name="cpf"
          id="cpf"
          v-model="informacoesPessoais.cpf"
          v-validate="'required'"
          :error-messages="errors.collect('CPF')"
          label="CPF*"
          data-vv-name="CPF"
          required
          type="number"
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md2>
        <v-text-field
          name="rg"
          id="rg"
          v-model="informacoesPessoais.rg"
          v-validate="'required'"
          :error-messages="errors.collect('RG')"
          label="RG*"
          data-vv-name="RG"
          required
          type="number"
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="profissao"
          id="profissao"
          v-model="informacoesPessoais.profissao"
          v-validate="'required'"
          :error-messages="errors.collect('profissão')"
          label="Profissão*"
          data-vv-name="profissão"
          required
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md2>
        <v-select
          name="sexo"
          id="sexo"
          :items="['Masculino', 'Feminino']"
          label="Sexo*"
          v-model="informacoesPessoais.sexo"
          v-validate="'required'"
          :error-messages="errors.collect('sexo')"
          data-vv-name="sexo"
          required
          @input="$emit('input', informacoesPessoais)"
        ></v-select>
      </v-flex>

      <v-flex xs12 sm6 md2>
        <v-select
          name="estado_civil"
          id="estado_civil"
          :items="['Solteiro', 'Casado', 'Separado', 'Divorciado', 'Viúvo']"
          label="Estado Civil*"
          v-model="informacoesPessoais.estado_civil"
          v-validate="'required'"
          :error-messages="errors.collect('estado civil')"
          data-vv-name="estado civil"
          required
          @input="$emit('input', informacoesPessoais)"
        ></v-select>
      </v-flex>

      <v-flex xs12 sm6 md3>
        <v-select
          name="nacionalidade"
          id="nacionalidade"
          :items="['Brasileiro', 'Argentino']"
          label="Nacionalidade*"
          v-model="informacoesPessoais.nacionalidade"
          v-validate="'required'"
          :error-messages="errors.collect('nacionalidade')"
          data-vv-name="nacionalidade"
          required
          @input="$emit('input', informacoesPessoais)"
        ></v-select>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="email"
          id="email"
          v-model="informacoesPessoais.email"
          label="E-mail"
          :error-messages="errors.collect('e-mail')"
          type="email"
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md2>
        <v-text-field
          name="renda"
          id="renda"
          v-model="informacoesPessoais.renda"
          label="Renda*"
          v-validate="'required'"
          :error-messages="errors.collect('renda')"
          data-vv-name="renda"
          required
          type="number"
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm6 md5>
        <v-text-field
          name="local_trabalho"
          id="local_trabalho"
          v-model="informacoesPessoais.local_trabalho"
          label="Local de Trabalho*"
          v-validate="'required'"
          :error-messages="errors.collect('local de trabalho')"
          data-vv-name="local de trabalho"
          required
          @input="$emit('input', informacoesPessoais)"
        ></v-text-field>
      </v-flex>
    </v-layout>
  </v-form>
</template>
<script>
export default {
  name: "informacoes-pessoais-form",
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
      informacoesPessoais: Object.assign({}, this.value) //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
    };
  },
  watch: {
    value: {
      handler() {
        this.informacoesPessoais = Object.assign({}, this.value);
      },
      deep: true
    }
  },
  methods: {
  }
};
</script>