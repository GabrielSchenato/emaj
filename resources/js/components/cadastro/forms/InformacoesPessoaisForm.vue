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
                    :error-messages="errors.collect('Nome Completo')"
                    data-vv-name="Nome Completo"
                    @input="$emit('input', informacoesPessoais)"
                    >
                    <template v-slot:label>
                        Nome Completo<span class="required">*</span>
                    </template>
                </v-text-field>
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
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="cpf"
                    v-model="informacoesPessoais.cpf"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('CPF')"
                    data-vv-name="CPF"
                    mask="###.###.###-##"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    >
                    <template v-slot:label>
                        CPF<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="rg"
                    v-model="informacoesPessoais.rg"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('RG')"
                    data-vv-name="RG"
                    return-masked-value
                    @input="$emit('input', informacoesPessoais)"
                    >
                    <template v-slot:label>
                        RG<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="profissao"
                    v-model="informacoesPessoais.profissao"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Profissão')"
                    data-vv-name="Profissão"
                    @input="$emit('input', informacoesPessoais)"
                    >
                    <template v-slot:label>
                        Profissão<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-select
                    name="sexo"
                    :items="sexo"
                    v-model="informacoesPessoais.sexo"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Sexo')"
                    data-vv-name="Sexo"
                    item-value="id"
                    item-text="nome"
                    clearable
                    @input="$emit('input', informacoesPessoais)"
                    >
                    <template v-slot:label>
                        Sexo<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-select>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-select
                    name="estado_civil"
                    :items="estadoCivil"
                    v-model="informacoesPessoais.estado_civil"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Estado Civil')"
                    data-vv-name="Estado Civil"
                    item-value="id"
                    item-text="nome"
                    clearable
                    @input="$emit('input', informacoesPessoais)"
                    >
                    <template v-slot:label>
                        Estado Civil<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-select>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <autocomplete-field
                    ref="autocompleteNacionalidade"
                    v-bind:errorMessages="errors.collect(optionsNacionalidade.name)"
                    :data-vv-name="optionsNacionalidade.name"
                    v-validate="{required: optionsNacionalidade.required }"
                    v-bind:options="optionsNacionalidade"
                    v-model="informacoesPessoais.nacionalidade_id"
                    @input="$emit('input', informacoesPessoais)"
                    ></autocomplete-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="email"
                    v-model="informacoesPessoais.email"
                    label="E-mail"
                    :error-messages="errors.collect('E-mail')"
                    type="email"
                    data-vv-name="E-mail"
                    @input="$emit('input', informacoesPessoais)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <money-field
                    ref="moneyRenda"
                    v-bind:errorMessages="errors.collect(optionsRenda.name)"
                    :data-vv-name="optionsRenda.name"
                    v-validate="{required: optionsRenda.required }"
                    v-bind:options="optionsRenda"
                    v-model="informacoesPessoais.renda"
                    @input="$emit('input', informacoesPessoais)"
                    ></money-field>
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
        props: {
            value: {
                type: [Object]
            },
            getConfig: {type: Function}
        },
        data() {
            return {
                informacoesPessoais: Object.assign({}, this.value),
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

                    }]
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
        computed: {
            optionsNacionalidade() {
                return {
                    field: 'nacionalidade_id',
                    required: this.getConfig().required,
                    itemText: 'nome',
                    name: 'Nacionalidade',
                    url: 'clientes/autocomplete'
                };
            },
            optionsRenda() {
                return {
                    field: 'renda',
                    required: this.getConfig().required,
                    name: 'Renda'
                };
            }
        }
    };
</script>