<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    id="id"
                    v-model="tipoDemanda.id"
                    label="ID"
                    disabled
                    @input="$emit('input', tipoDemanda)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="nome"
                    id="nome"
                    v-model="tipoDemanda.nome"
                    label="Nome*"
                    v-validate="'required'"
                    :error-messages="errors.collect('nome')"
                    data-vv-name="nome"
                    required
                    @input="$emit('input', tipoDemanda)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="descricao"
                    id="descricao"
                    v-model="tipoDemanda.descricao"
                    label="Descrição"
                    @input="$emit('input', tipoDemanda)"
                    ></v-text-field>
            </v-flex>
            
            <v-flex xs12 sm6 md1>
               <v-checkbox
                    name="ativo"
                    id="ativo"
                    v-model="tipoDemanda.ativo"
                    label="Ativo?"
                    @change="$emit('input', tipoDemanda)"
                    ></v-checkbox>
            </v-flex>
            
        </v-layout>
    </v-form>
</template>
<script>
    export default {
        name: "tipo-demanda-form",
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
                tipoDemanda: Object.assign({}, this.value) //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
            };
        },
        watch: {
            value: {
                handler() {
                    this.tipoDemanda = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
        }
    };
</script>