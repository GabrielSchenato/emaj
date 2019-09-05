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
                    label="Tipo"
                    v-validate="'required'"
                    :error-messages="errors.collect('Tipo')"
                    data-vv-name="Tipo"
                    :items="tipoTelefone"
                    item-value="id"
                    item-text="nome"
                    @input="$emit('input', telefone)"
                    >
                    <template v-slot:label>
                        Tipo<span class="required">*</span>
                    </template>    
                </v-select>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="descricao"
                    v-model="telefone.descricao"
                    label="Descrição"
                    :error-messages="errors.collect('Descrição')"
                    data-vv-name="Descrição"
                    @input="$emit('input', telefone)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="telefone"
                    v-model="telefone.telefone"
                    label="Telefone"
                    v-validate="'required'"
                    :error-messages="errors.collect('Telefone')"
                    data-vv-name="Telefone"
                    return-masked-value
                    :mask="getMask(telefone.tipo)"
                    @input="$emit('input', telefone)"
                    >
                    <template v-slot:label>
                        Telefone<span class="required">*</span>
                    </template>
                </v-text-field>
            </v-flex>
        </v-layout>
    </v-form>
</template>
<script>
    export default {
        name: "telefone-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                tipoTelefone: [
                    {
                        id: 'Celular',
                        nome: 'Celular',
                        mask: '(##) #####-####'
                    },
                    {
                        id: 'Residencial',
                        nome: 'Residencial',
                        mask: '(##) ####-####'

                    }],
                telefone: Object.assign({}, this.value)
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
            getMask(tipo) {
                if (!tipo)
                    return;
                return this.tipoTelefone.find(campo => campo.id === tipo).mask;
            }
        }
    };
</script>