<template>
    <v-layout wrap>
        <v-flex xs12 sm6 md2>
            <v-text-field
                name="id"
                v-model="tipoDemanda.id"
                label="ID"
                disabled
                @input="$emit('input', tipoDemanda)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md4>
            <v-text-field
                name="nome"
                v-model="tipoDemanda.nome"
                label="Nome"
                v-validate="'required'"
                :error-messages="errors.collect('Nome')"
                data-vv-name="Nome"
                @input="$emit('input', tipoDemanda)"
                >
                <template v-slot:label>
                    Nome<span class="required">*</span>
                </template>
            </v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md5>
            <v-text-field
                name="descricao"
                v-model="tipoDemanda.descricao"
                label="Descrição"
                @input="$emit('input', tipoDemanda)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-checkbox
                name="ativo"
                v-model="tipoDemanda.ativo"
                label="Ativo?"
                @change="$emit('input', tipoDemanda)"
                ></v-checkbox>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        name: "tipo-demanda-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                tipoDemanda: Object.assign({}, this.value)
            };
        },
        watch: {
            value: {
                handler() {
                    this.tipoDemanda = Object.assign({}, this.value);
                },
                deep: true
            }
        }
    };
</script>