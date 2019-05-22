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

            <v-flex xs12 sm6 md2>
                <v-checkbox
                    name="parte_contraria"
                    id="parte_contraria"
                    v-model="informacoesPessoais.parte_contraria"
                    label="Parte Contrária?"
                    :disabled="!!informacoesPessoais.pre_atendimento"
                    @change="$emit('input', informacoesPessoais)"
                    ></v-checkbox>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-checkbox
                    name="pre_atendimento"
                    id="pre_atendimento"
                    v-model="informacoesPessoais.pre_atendimento"
                    label="Pré-atendimento?"
                    :disabled="!!informacoesPessoais.parte_contraria"
                    @change="$emit('input', informacoesPessoais)"
                    ></v-checkbox>
            </v-flex>

            <v-flex xs12 sm6 md7>
                <v-text-field
                    name="nome_completo"
                    id="nome_completo"
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
                    id="representado_assistido"
                    v-model="informacoesPessoais.representado_assistido"
                    label="Representado/Assistido"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>
            
            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="representado_assistido_cpf"
                    id="representado_assistido_cpf"
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
                    id="representado_assistido_rg"
                    v-model="informacoesPessoais.representado_assistido_rg"
                    label="RG Representado/Assistido"
                    mask="#.###.###"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="cpf"
                    id="cpf"
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
                    id="rg"
                    v-model="informacoesPessoais.rg"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('RG')"
                    :label="'RG' + this.getConfig().asterisco"
                    data-vv-name="RG"
                    mask="#.###.###"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="profissao"
                    id="profissao"
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
                    id="sexo"
                    :items="sexo"
                    :label="'Sexo' + this.getConfig().asterisco"
                    v-model="informacoesPessoais.sexo"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('sexo')"
                    data-vv-name="sexo"
                    item-value="id"
                    item-text="nome"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-select
                    name="estado_civil"
                    id="estado_civil"
                    :items="estadoCivil"
                    :label="'Estado Civil' + this.getConfig().asterisco"
                    v-model="informacoesPessoais.estado_civil"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('estado civil')"
                    data-vv-name="estado civil"
                    item-value="id"
                    item-text="nome"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md3>            
                <v-autocomplete
                    name="nacionalidade_id"
                    id="nacionalidade_id"
                    :items="nacionalidades"
                    :filter="customFilter"
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
                    id="email"
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
                    name="renda"
                    id="renda"
                    v-model="informacoesPessoais.renda"
                    :label="'Renda' + this.getConfig().asterisco"
                    v-bind:validations="validations"
                    @input="$emit('input', informacoesPessoais)"
                    v-bind:options="options"/>
        </v-flex>

        <v-flex xs12 sm6 md5>
            <v-text-field
                name="local_trabalho"
                id="local_trabalho"
                v-model="informacoesPessoais.local_trabalho"
                :label="'Local de Trabalho' + this.getConfig().asterisco"
                v-validate="{required: this.getConfig().required }"
                :error-messages="errors.collect('local de trabalho')"
                data-vv-name="local de trabalho"
                required
                @input="$emit('input', informacoesPessoais)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-checkbox
                name="ativo"
                id="ativo"
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
                    vvalidate: {required: this.getConfig().required},
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
                nacionalidades: []
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
            customFilter(item, queryText, itemText) {
                const textOne = item.nome.toLowerCase();
                //const textTwo = item.abbr.toLowerCase();
                const searchText = queryText.toLowerCase();

                return textOne.indexOf(searchText) > -1 /*||
                 textTwo.indexOf(searchText) > -1*/;
            }
        },
        mounted() {
            window.axios.get('nacionalidades').then(response => {
                this.nacionalidades = response.data;
            });
        }
    };
</script>