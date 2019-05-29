<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="composicao_familiar_id"
                    id="composicao_familiar_id"
                    v-model="composicaoFamiliar.id"
                    label="ID"
                    disabled
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <vuetify-money
                    name="composicao_familiar_renda_familiar"
                    id="composicao_familiar_renda_familiar"
                    v-model="composicaoFamiliar.renda_familiar"
                    :label="'Renda Familiar' + this.getConfig().asterisco"
                    v-bind:validations="validations"
                    @input="$emit('input', composicaoFamiliar)"
                    />
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-select
                    name="composicao_familiar_casa"
                    id="composicao_familiar_casa"
                    v-model="composicaoFamiliar.casa"
                    :label="'Casa' + this.getConfig().asterisco"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('casa')"
                    data-vv-name="casa"
                    required
                    :items="tipoCasa"
                    item-value="id"
                    item-text="nome"
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-layout align-center class="ma-0">
                    <v-checkbox
                        name="composicao_familiar_possui_carro"
                        id="composicao_familiar_possui_carro"
                        v-model="composicaoFamiliar.possui_carro"
                        label="Carro"
                        hide-details
                        class="shrink mr-2"
                        @input="$emit('input', composicaoFamiliar)"
                        ></v-checkbox>
                </v-layout>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="composicao_familiar_marca_carro"
                    id="composicao_familiar_marca_carro"
                    label="Marca"
                    v-model="composicaoFamiliar.marca_carro"
                    :disabled="!composicaoFamiliar.possui_carro"
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="composicao_familiar_ano_carro"
                    id="composicao_familiar_ano_carro"
                    label="Ano"
                    v-model="composicaoFamiliar.ano_carro"
                    :disabled="!composicaoFamiliar.possui_carro"
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-layout align-center class="ma-0">
                    <v-checkbox
                        name="composicao_familiar_possui_moto"
                        id="composicao_familiar_possui_moto"
                        v-model="composicaoFamiliar.possui_moto"
                        label="Moto"
                        hide-details
                        class="shrink mr-2"
                        @input="$emit('input', composicaoFamiliar)"
                        ></v-checkbox>
                </v-layout>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="composicao_familiar_marca_moto"
                    id="composicao_familiar_marca_moto"
                    label="Marca"
                    v-model="composicaoFamiliar.marca_moto"
                    :disabled="!composicaoFamiliar.possui_moto"
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="composicao_familiar_ano_moto"
                    id="composicao_familiar_ano_moto"
                    label="Ano"
                    v-model="composicaoFamiliar.ano_moto"
                    :disabled="!composicaoFamiliar.possui_moto"
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md7>
                <v-text-field
                    name="composicao_familiar_outros_bens"
                    id="composicao_familiar_outros_bens"
                    v-model="composicaoFamiliar.outros_bens"
                    :label="'Outros Bens' + this.getConfig().asterisco"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('outros bens')"
                    data-vv-name="outros bens"
                    required
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="composicao_familiar_dividas"
                    id="composicao_familiar_dividas"
                    v-model="composicaoFamiliar.dividas"
                    :label="'Dívidas' + this.getConfig().asterisco"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('dívidas')"
                    data-vv-name="dívidas"
                    required
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md7>
                <v-text-field
                    name="composicao_familiar_despesas"
                    id="composicao_familiar_despesas"
                    v-model="composicaoFamiliar.despesas"
                    :label="'Despesas' + this.getConfig().asterisco"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('despesas')"
                    data-vv-name="despesas"
                    required
                    @input="$emit('input', composicaoFamiliar)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <vuetify-money
                    name="composicao_familiar_valor_patrimonio"
                    id="composicao_familiar_valor_patrimonio"
                    v-model="composicaoFamiliar.valor_patrimonio"
                    :label="'Valor do Patrimônio' + this.getConfig().asterisco"
                    v-bind:validations="validationsPatrimonio"
                    @input="$emit('input', composicaoFamiliar)"
                    />
            </v-flex>

            <v-flex xs12 sm6 md9>
                <v-text-field
                    name="composicao_familiar_observacoes"
                    id="composicao_familiar_observacoes"
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
                    errormessages: "errors.collect('renda familiar')",
                    datavvname: "renda familiar"
                },
                validationsPatrimonio: {
                    vvalidate: {required: this.getConfig().required},
                    errormessages: "errors.collect('valor do patrimônio')",
                    datavvname: "valor do patrimônio"
                },
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
                composicaoFamiliar: Object.assign({}, this.value) //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
            };
        },
        watch: {
            value: {
                handler() {
                    this.composicaoFamiliar = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
        }
    };
</script>