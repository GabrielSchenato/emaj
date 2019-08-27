<template>
    <v-form>
        <v-layout wrap>

            <v-flex xs12 sm6 md4>
                <v-select
                    flat
                    solo              
                    hide-details
                    chips
                    name="campo_busca"
                    v-model="search.field"
                    :items="campos"
                    @change="clearData()"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md8 v-if="type(search.field) == 'text'">
                <v-text-field
                    prepend-inner-icon="search"
                    flat
                    clearable
                    solo              
                    hide-details
                    :mask='mask(search.field)'
                    return-masked-value
                    placeholder="Buscar..."
                    v-model="search.value"
                    class="hidden-sm-and-down"
                    @input="emit"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md8 v-if="type(search.field) == 'money'">
                <vuetify-money
                    prepend-inner-icon="search"
                    flat
                    clearable
                    solo              
                    hide-details
                    v-model="search.value"
                    placeholder="Buscar..."
                    @input="emit"
                    />
            </v-flex>

            <v-flex xs12 sm6 md8 v-else-if="type(search.field) == 'number'">
                <v-text-field
                    prepend-inner-icon="search"
                    flat
                    clearable
                    solo              
                    hide-details
                    mask='################'
                    placeholder="Buscar..."
                    v-model="search.value"
                    class="hidden-sm-and-down"
                    @input="emit"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md8 v-else-if="type(search.field) == 'combo'">
                <v-select
                    flat
                    clearable
                    solo              
                    hide-details
                    v-model="search.value"
                    :items="optionsCombo(search.field)"
                    @change="emit"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md8 v-else-if="type(search.field) == 'datetime'">
                <v-menu
                    v-model="menu"
                    :close-on-content-click="false"
                    full-width
                    max-width="290"
                    >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            prepend-inner-icon="calendar_today"
                            :value="data"
                            flat
                            clearable
                            solo              
                            placeholder="Buscar..."
                            hide-details
                            @click:clear="clearData()"
                            readonly
                            v-on="on"
                            ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="search.value"
                        @change="menu = false"
                        locale="pt-br"
                        @input="emit"
                        ></v-date-picker>
                </v-menu>
            </v-flex>

        </v-layout>
    </v-form>
</template>
<script>
    import moment from 'moment'
    export default {
        name: "filter-form",
        props: {
            value: {
                type: [Object]
            },
            options: {
                type: Array
            }
        },
        data() {
            return {
                search: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                menu: false,
                initial: true
            };
        },
        watch: {
            value: {
                handler() {
                    this.search = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        computed: {
            campos() {
                return this.options.filter((campo) => {
                    if (campo.initial && this.initial !== false) {
                        this.search.field = campo.value;
                        this.initial = false;
                    }
                    return campo.filterable === true;
                });
            },
            data() {
                return this.search.value ? moment(this.search.value).format('L') : '';
            }
        },
        methods: {
            type(field) {
                return this.options.find(campo => campo.value === field).type;
            },
            optionsCombo(field) {
                return this.options.find(campo => campo.value === field).options;
            },
            mask(field) {
                return this.options.find(campo => campo.value === field).mask ? this.options.find(campo => campo.value === field).mask : '';
            },
            clearData() {
                this.search.value = null;
                this.$emit('input', this.search);
            },
            emit: _.debounce(
                    function emit() {
                        this.$emit('input', this.search);
                    },
                    500,
                    )
        }
    };
</script>