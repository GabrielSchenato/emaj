<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="id"
                    v-model="telefone.id"
                    label="ID"
                    disabled
                    @input="$emit('input', telefone)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-select
                    name="tipo"
                    v-model="telefone.tipo"
                    label="Tipo*"
                    v-validate="'required'"
                    :error-messages="errors.collect('tipo')"
                    data-vv-name="tipo"
                    :items="tipoTelefone"
                    item-value="id"
                    item-text="nome"
                    @input="$emit('input', telefone)"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="descricao"
                    v-model="telefone.descricao"
                    label="Descrição"
                    :error-messages="errors.collect('descrição')"
                    data-vv-name="descrição"
                    @input="$emit('input', telefone)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="telefone"
                    v-model="telefone.telefone"
                    label="Telefone*"
                    v-validate="'required'"
                    :error-messages="errors.collect('telefone')"
                    data-vv-name="telefone"
                    return-masked-value
                    :mask="telefone.tipo == 'Celular' ? '(##) #####-####' : '(##) ####-####'"
                    @input="$emit('input', telefone)"
                    ></v-text-field>
            </v-flex>
        </v-layout>
    </v-form>
</template>
<script>
    export default {
        name: "telefone-form",
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
                tipoTelefone: [{
                        id: 'Celular',
                        nome: 'Celular'
                    },
                    {
                        id: 'Residencial',
                        nome: 'Residencial'

                    }],
                telefone: Object.assign({}, this.value) //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
            };
        },
        watch: {
            value: {
                handler() {
                    this.telefone = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
        }
    };
</script>