<template>
    <v-flex xs12 sm6 md2>
        <v-select
            v-model="data"
            :items="ativo"
            menu-props="auto"
            hide-details
            label="Ativo?"
            item-text="nome"
            item-value="id"
            @input="$emit('input', data)"
            ></v-select>
    </v-flex>
</template>
<script>
    export default {
        name: "select-ativo-field",
        props: {
            value: {
                type: Number
            }
        },
        data() {
            return {
                data: this.value,
                ativo: [
                    {id: 1, nome: 'Sim'},
                    {id: 2, nome: 'Não'},
                    {id: 3, nome: 'Ambos'}
                ]
            };
        },
        computed: {
            optionsDefault() {
                this.data = 1;
                return this.data;
            }
        },
        watch: {
            value: {
                handler() {
                    this.data = this.value;
                },
                deep: true
            }
        },
        created() {
            this.$emit('input', this.optionsDefault);
        }
    };
</script>