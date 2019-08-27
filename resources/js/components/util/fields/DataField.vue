<template> 
    <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        :nudge-right="40"      
        lazy
        transition="scale-transition"
        offset-y
        full-width
        min-width="290px"
        >
        <template v-slot:activator="{ on }">
            <v-text-field
                :value="dataFormatada"
                :label="label"
                readonly
                clearable
                v-on="on"
                @click:clear="clearData()"
                v-bind:error-messages="errorMessages"
                ></v-text-field>
        </template>
        <v-date-picker 
            v-model="data"
            no-title scrollable
            locale="pt-br"
            :max="options.max"
            :min="options.min"
            @input="$emit('input', data); menu = false">
        </v-date-picker>
    </v-menu>
</template>
<script>
    import moment from 'moment'
    export default {
        name: "data-field",
        props: {
            value: {
                type: String
            },
            options: {
                type: [Object]
            },
            errorMessages: {
                type: Array
            }
        },
        data() {
            return {
                data: this.value,
                menu: false
            };
        },
        watch: {
            value: {
                handler() {
                    this.data = this.value;
                },
                deep: true
            }
        },
        computed: {
            dataFormatada() {
                return this.data ? moment(this.data).format('L') : '';
            },
            label() {
                return this.options.name + (this.options.required ? '*' : '');
            }
        },
        methods: {
            clearData() {
                this.data = null;
                this.$emit('input', this.data);
            }
        }
    };
</script> 