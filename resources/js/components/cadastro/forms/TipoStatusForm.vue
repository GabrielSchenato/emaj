<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    id="id"
                    v-model="tipoStatus.id"
                    label="ID"
                    disabled
                    @input="$emit('input', tipoStatus)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md8>
                <v-text-field
                    name="nome"
                    id="nome"
                    v-model="tipoStatus.nome"
                    label="Nome*"
                    v-validate="'required'"
                    :error-messages="errors.collect('nome')"
                    data-vv-name="nome"
                    @input="$emit('input', tipoStatus)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-checkbox
                    name="ativo"
                    id="ativo"
                    v-model="tipoStatus.ativo"
                    label="Ativo?"
                    @change="$emit('input', tipoStatus)"
                    ></v-checkbox>
            </v-flex>

        </v-layout>
    </v-form>
</template>
<script>
    export default {
        name: "tipo-status-form",
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
                tipoStatus: Object.assign({}, this.value) //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
            };
        },
        watch: {
            value: {
                handler() {
                    this.tipoStatus = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
        }
    };
</script>