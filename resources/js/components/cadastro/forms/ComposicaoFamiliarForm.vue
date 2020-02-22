<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="id"
                    v-model="composicaoFamiliar.id"
                    label="ID"
                    disabled
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <money-field
                    ref="moneyRendaFamiliar"
                    v-bind:errorMessages="errors.collect(optionsRendaFamiliar.name)"
                    :data-vv-name="optionsRendaFamiliar.name"
                    v-validate="{required: optionsRendaFamiliar.required }"
                    v-bind:options="optionsRendaFamiliar"
                    v-model="composicaoFamiliar.renda_familiar"
                    @input="$emit('input', composicaoFamiliar)"
                    ></money-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-select
                    name="casa"
                    v-model="composicaoFamiliar.casa"
                    v-validate="{required: false }"
                    :error-messages="errors.collect('Casa')"
                    data-vv-name="Casa"
                    :items="tipoCasa"
                    item-value="id"
                    item-text="nome"
                    clearable
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Casa<span class="required" v-if="false">*</span>
                    </template>
                </v-select>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-layout align-center class="ma-0">
                    <v-checkbox
                        name="possui_carro"
                        v-model="composicaoFamiliar.possui_carro"
                        label="Carro"
                        hide-details
                        class="shrink mr-2"
                        @change="$emit('input', composicaoFamiliar)"
                        ></v-checkbox>
                </v-layout>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="marca_carro"
                    v-model="composicaoFamiliar.marca_carro"
                    v-validate="{required: composicaoFamiliar.possui_carro == true }"
                    :error-messages="errors.collect('Marca do Carro')"
                    data-vv-name="Marca do Carro"
                    :disabled="!composicaoFamiliar.possui_carro"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Marca<span class="required" v-if="composicaoFamiliar.possui_carro">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="ano_carro"
                    v-validate="{required: composicaoFamiliar.possui_carro == true, digits:4 }"
                    :error-messages="errors.collect('Ano do Carro')"
                    data-vv-name="Ano do Carro"
                    v-model="composicaoFamiliar.ano_carro"
                    :disabled="!composicaoFamiliar.possui_carro"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Ano<span class="required" v-if="composicaoFamiliar.possui_carro">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-layout align-center class="ma-0">
                    <v-checkbox
                        name="possui_moto"
                        v-model="composicaoFamiliar.possui_moto"
                        label="Moto"
                        hide-details
                        class="shrink mr-2"
                        @change="$emit('input', composicaoFamiliar)"
                        ></v-checkbox>
                </v-layout>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="marca_moto"
                    v-validate="{required: composicaoFamiliar.possui_moto == true }"
                    :error-messages="errors.collect('Marca da Moto')"
                    data-vv-name="Marca da Moto"
                    v-model="composicaoFamiliar.marca_moto"
                    :disabled="!composicaoFamiliar.possui_moto"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Marca<span class="required" v-if="composicaoFamiliar.possui_moto">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="ano_moto"
                    v-validate="{required: composicaoFamiliar.possui_moto == true, digits:4 }"
                    :error-messages="errors.collect('Ano da Moto')"
                    data-vv-name="Ano da Moto"
                    v-model="composicaoFamiliar.ano_moto"
                    :disabled="!composicaoFamiliar.possui_moto"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Ano<span class="required" v-if="composicaoFamiliar.possui_moto">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md7>
                <v-text-field
                    name="outros_bens"
                    v-model="composicaoFamiliar.outros_bens"
                    v-validate="{required: false }"
                    :error-messages="errors.collect('Outros Bens')"
                    data-vv-name="Outros Bens"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Outros Bens<span class="required" v-if="false">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="dividas"
                    v-model="composicaoFamiliar.dividas"
                    v-validate="{required: false }"
                    :error-messages="errors.collect('Dívidas')"
                    data-vv-name="Dívidas"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Dívidas<span class="required" v-if="false">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md7>
                <v-text-field
                    name="despesas"
                    v-model="composicaoFamiliar.despesas"
                    v-validate="{required: false }"
                    :error-messages="errors.collect('Despesas')"
                    data-vv-name="Despesas"
                    @input="$emit('input', composicaoFamiliar)"
                    >
                    <template v-slot:label>
                        Despesas<span class="required" v-if="false">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <money-field
                    ref="moneyValorPatrimonio"
                    v-bind:errorMessages="errors.collect(optionsValorPatrimonio.name)"
                    :data-vv-name="optionsValorPatrimonio.name"
                    v-validate="{required: optionsValorPatrimonio.required }"
                    v-bind:options="optionsValorPatrimonio"
                    v-model="composicaoFamiliar.valor_patrimonio"
                    @input="$emit('input', composicaoFamiliar)"
                    ></money-field>
            </v-flex>

            <v-flex xs12 sm6 md9>
                <v-text-field
                    name="observacoes"
                    v-model="composicaoFamiliar.observacoes"
                    label="Observações"
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>
        </v-layout>
    </v-form>
</template>
<script>
    export default {
        name: "composicao-familiar-form",
        props: {
            value: {
                type: [Object]
            },
            getConfig: {type: Function}
        },
        data() {
            return {
                tipoCasa: [{
                        id: 'Alugada',
                        nome: 'Alugada'
                    },
                    {
                        id: 'Própria',
                        nome: 'Própria'

                    },
                    {
                        id: 'Cedida',
                        nome: 'Cedida'

                    }],
                composicaoFamiliar: Object.assign({}, this.value)
            };
        },
        watch: {
            value: {
                handler() {
                    this.composicaoFamiliar = Object.assign({}, this.value);
                },
                deep: true
            },
            'composicaoFamiliar.possui_carro': function (value) {
                if (!value) {
                    this.composicaoFamiliar.marca_carro = null;
                    this.composicaoFamiliar.ano_carro = null;
                    this.$emit('input', this.composicaoFamiliar);
                }
            },
            'composicaoFamiliar.possui_moto': function (value) {
                if (!value) {
                    this.composicaoFamiliar.marca_moto = null;
                    this.composicaoFamiliar.ano_moto = null;
                    this.$emit('input', this.composicaoFamiliar);
                }
            }
        },
        computed: {
            optionsRendaFamiliar() {
                return {
                    field: 'renda_familiar',
                    required: false,
                    name: 'Renda Familiar'
                };
            },
            optionsValorPatrimonio() {
                return {
                    field: 'valor_patrimonio',
                    required: false,
                    name: 'Valor do Patrimônio'
                };
            }
        }
    };
</script>