<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="id"
                    v-model="informacoesPessoais.id"
                    label="ID"
                    disabled
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-checkbox
                    name="parte_contraria"
                    v-model="informacoesPessoais.parte_contraria"
                    label="Parte Contrária?"
                    :disabled="!!informacoesPessoais.pre_atendimento"
                    @change="$emit('input', informacoesPessoais)"
                    ></v-checkbox>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-checkbox
                    name="pre_atendimento"
                    v-model="informacoesPessoais.pre_atendimento"
                    label="Pré-atendimento?"
                    :disabled="!!informacoesPessoais.parte_contraria"
                    @change="$emit('input', informacoesPessoais)"
                    ></v-checkbox>
            </v-flex>

            <v-flex xs12 sm6 md7>
                <v-text-field
                    name="nome_completo"
                    v-model="informacoesPessoais.nome_completo"
                    v-validate="{required: true }"
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
                    v-model="informacoesPessoais.representado_assistido"
                    label="Representado/Assistido"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="representado_assistido_cpf"
                    v-model="informacoesPessoais.representado_assistido_cpf"
                    label="CPF Representado/Assistido"
                    data-vv-name="CPF"
                    mask="###.###.###-##"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="representado_assistido_rg"
                    v-model="informacoesPessoais.representado_assistido_rg"
                    label="RG Representado/Assistido"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="cpf"
                    v-model="informacoesPessoais.cpf"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('CPF')"
                    :label="'CPF' + this.getConfig().asterisco"
                    data-vv-name="CPF"
                    mask="###.###.###-##"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="rg"
                    v-model="informacoesPessoais.rg"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('RG')"
                    :label="'RG' + this.getConfig().asterisco"
                    data-vv-name="RG"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="profissao"
                    v-model="informacoesPessoais.profissao"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('profissão')"
                    :label="'Profissão' + this.getConfig().asterisco"
                    data-vv-name="profissão"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-select
                    name="sexo"
                    :items="sexo"
                    :label="'Sexo' + this.getConfig().asterisco"
                    v-model="informacoesPessoais.sexo"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('sexo')"
                    data-vv-name="sexo"
                    item-value="id"
                    item-text="nome"
                    clearable
                    @input="$emit('input', informacoesPessoais)"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-select
                    name="estado_civil"
                    :items="estadoCivil"
                    :label="'Estado Civil' + this.getConfig().asterisco"
                    v-model="informacoesPessoais.estado_civil"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('estado civil')"
                    data-vv-name="estado civil"
                    item-value="id"
                    item-text="nome"
                    clearable
                    @input="$emit('input', informacoesPessoais)"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md3>            
                <v-autocomplete
                    name="nacionalidade_id"
                    :items="nacionalidades"
                    :search-input.sync="autocompleteNacionalidades"
                    :loading="loadingNacionalidades"
                    hide-no-data
                    clearable
                    placeholder="Comece a digitar para pesquisar"
                    item-text="nome"
                    item-value="id"
                    no-data-text="Não há registros para serem exibidos."
                    :label="'Nacionalidade' + this.getConfig().asterisco"
                    v-model="informacoesPessoais.nacionalidade_id"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('nacionalidade')"
                    data-vv-name="nacionalidade"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-autocomplete>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="email"
                    v-model="informacoesPessoais.email"
                    label="E-mail"
                    :error-messages="errors.collect('e-mail')"
                    type="email"
                    data-vv-name="e-mail"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <vuetify-money
                    ref="moneyRenda"
                    name="renda"
                    v-model="informacoesPessoais.renda"
                    :label="'Renda' + this.getConfig().asterisco"
                    v-bind:validations="validations"
                    @input="$emit('input', informacoesPessoais)"
                    v-bind:options="options"/>
        </v-flex>

        <v-flex xs12 sm6 md5>
            <v-text-field
                name="local_trabalho"
                v-model="informacoesPessoais.local_trabalho"
                label="Local de Trabalho"
                @input="$emit('input', informacoesPessoais)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-checkbox
                name="ativo"
                v-model="informacoesPessoais.ativo"
                label="Ativo?"
                @change="$emit('input', informacoesPessoais)"
                ></v-checkbox>
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
            },
            getConfig: {type: Function}
        },
        data() {
            return {
                validations: {
                    errormessages: "errors.collect('renda')",
                    datavvname: "renda"
                },
                options: {
                    locale: "pt-BR",
                    prefix: "R$",
                    precision: 2
                },
                informacoesPessoais: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                sexo: [{
                        id: 'M',
                        nome: 'Masculino'
                    },
                    {
                        id: 'F',
                        nome: 'Feminino'

                    }],
                estadoCivil: [{
                        id: 'Solteiro',
                        nome: 'Solteiro'
                    },
                    {
                        id: 'Casado',
                        nome: 'Casado'

                    },
                    {
                        id: 'Separado',
                        nome: 'Separado'

                    },
                    {
                        id: 'Divorciado',
                        nome: 'Divorciado'

                    },
                    {
                        id: 'Viúvo',
                        nome: 'Viúvo'

                    }],
                nacionalidades: [],
                loadingNacionalidades: false,
                autocompleteNacionalidades: null
            };
        },
        watch: {
            value: {
                handler() {
                    this.informacoesPessoais = Object.assign({}, this.value);
                },
                deep: true
            },
            autocompleteNacionalidades: _.debounce(
                    function autocompleteNacionalidades(busca) {
                        if (this.informacoesPessoais.nacionalidade_id && busca.length <= 1)
                        {
                            this.informacoesPessoais.nacionalidade_id = null;
                        }
                        if (busca) {
                            if (this.loadingNacionalidades)
                                return;

                            if (this.informacoesPessoais.nacionalidade_id)
                                return;

                            this.loadingClientes = true;
                            window.axios.get(`clientes/autocomplete?nacionalidade=${busca.replace(' ', '%20')}`).then(response => {
                                this.nacionalidades = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingNacionalidades = false));
                        }

                    },
                    500,
                    )
        }
    };
</script>