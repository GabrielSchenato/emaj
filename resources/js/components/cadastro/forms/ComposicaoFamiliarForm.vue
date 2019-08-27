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
                <vuetify-money
                    ref="moneyRendaFamiliar"
                    name="renda_familiar"
                    v-model="composicaoFamiliar.renda_familiar"
                    :label="'Renda Familiar' + this.getConfig().asterisco"
                    v-bind:validations="validations"
                    @input="$emit('input', composicaoFamiliar)"
                    />
        </v-flex>

        <v-flex xs12 sm6 md3>
            <v-select
                name="casa"
                v-model="composicaoFamiliar.casa"
                :label="'Casa' + this.getConfig().asterisco"
                v-validate="{required: this.getConfig().required }"
                :error-messages="errors.collect('casa')"
                data-vv-name="casa"
                required
                :items="tipoCasa"
                item-value="id"
                item-text="nome"
                clearable
                @input="$emit('input', composicaoFamiliar)"
                ></v-select>
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
                :label="'Marca' + (composicaoFamiliar.possui_carro ? '*' : '')"
                v-validate="{required: composicaoFamiliar.possui_carro == true }"
                :error-messages="errors.collect('Marca do Carro')"
                data-vv-name="Marca do Carro"
                :disabled="!composicaoFamiliar.possui_carro"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-text-field
                name="ano_carro"
                :label="'Ano' + (composicaoFamiliar.possui_carro ? '*' : '')"
                v-validate="{required: composicaoFamiliar.possui_carro == true, digits:4 }"
                :error-messages="errors.collect('Ano do Carro')"
                data-vv-name="Ano do Carro"
                v-model="composicaoFamiliar.ano_carro"
                :disabled="!composicaoFamiliar.possui_carro"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
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
                :label="'Marca' + (composicaoFamiliar.possui_moto ? '*' : '')"
                v-validate="{required: composicaoFamiliar.possui_moto == true }"
                :error-messages="errors.collect('Marca da Moto')"
                data-vv-name="Marca da Moto"
                v-model="composicaoFamiliar.marca_moto"
                :disabled="!composicaoFamiliar.possui_moto"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-text-field
                name="ano_moto"
                :label="'Ano' + (composicaoFamiliar.possui_moto ? '*' : '')"
                v-validate="{required: composicaoFamiliar.possui_moto == true, digits:4 }"
                :error-messages="errors.collect('Ano da Moto')"
                data-vv-name="Ano da Moto"
                v-model="composicaoFamiliar.ano_moto"
                :disabled="!composicaoFamiliar.possui_moto"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md7>
            <v-text-field
                name="outros_bens"
                v-model="composicaoFamiliar.outros_bens"
                :label="'Outros Bens' + this.getConfig().asterisco"
                v-validate="{required: this.getConfig().required }"
                :error-messages="errors.collect('outros bens')"
                data-vv-name="outros bens"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md5>
            <v-text-field
                name="dividas"
                v-model="composicaoFamiliar.dividas"
                :label="'Dívidas' + this.getConfig().asterisco"
                v-validate="{required: this.getConfig().required }"
                :error-messages="errors.collect('dívidas')"
                data-vv-name="dívidas"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md7>
            <v-text-field
                name="despesas"
                v-model="composicaoFamiliar.despesas"
                :label="'Despesas' + this.getConfig().asterisco"
                v-validate="{required: this.getConfig().required }"
                :error-messages="errors.collect('despesas')"
                data-vv-name="despesas"
                @input="$emit('input', composicaoFamiliar)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md3>
            <vuetify-money
                ref="moneyValorPatrimonio"
                name="valor_patrimonio"
                v-model="composicaoFamiliar.valor_patrimonio"
                :label="'Valor do Patrimônio' + this.getConfig().asterisco"
                v-bind:validations="validationsPatrimonio"
                @input="$emit('input', composicaoFamiliar)"
                />
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
                    errormessages: "errors.collect('renda familiar')",
                    datavvname: "renda familiar"
                },
                validationsPatrimonio: {
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
        methods: {
        }
    };
</script>