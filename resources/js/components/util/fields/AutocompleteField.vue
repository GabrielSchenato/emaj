<template>  
    <v-autocomplete
        :name="options.field"
        :items="values"
        :item-text="options.itemText"
        :search-input.sync="autocomplete"
        :loading="loading"
        hide-no-data
        clearable
        :placeholder="placeholder"
        autofocus
        :item-value="itemValue"
        :no-data-text="noDataText"
        :label="label"
        v-model="data"
        v-bind:error-messages="errorMessages"
        @input="emit"
        :prepend-icon="prependIcon"
        @click:prepend="data != null ? edit(data) : create()"
        ></v-autocomplete>   
</template>
<script>
    export default {
        name: "autocomplete-field",
        props: {
            value: {
                type: [Number, String]
            },
            errorMessages: {
                type: Array
            },
            options: {
                type: [Object]
            },
            create: {
                type: Function
            },
            edit: {
                type: Function
            }
        },
        data() {
            return {
                data: this.value,
                values: [],
                loading: false,
                autocomplete: null
            };
        },
        watch: {
            value: {
                handler() {
                    this.data = this.value;
                },
                deep: true
            },
            autocomplete: _.debounce(
                    function autocomplete(busca) {
                        if (this.data && (busca && busca.length <= 1))
                        {
                            this.data = null;
                        }
                        if (busca) {
                            if (this.loading)
                                return;

                            if (this.data)
                                return;

                            this.loading = true;
                            window.axios.get(this.options.url, {
                                params: this.prepareParams(busca)
                            }).then(response => {
                                this.values = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loading = false));
                        }

                    },
                    500,
                    )
        },
        computed: {
            label() {
                return this.options.name + (this.options.required ? '*' : '');
            },
            placeholder() {
                return this.options.placeholder ? this.options.placeholder : 'Comece a digitar para pesquisar';
            },
            itemValue() {
                return this.options.itemValue ? this.options.itemValue : 'id';
            },
            noDataText() {
                return this.options.noDataText ? this.options.noDataText : 'Não há registros para serem exibidos.';
            },
            prependIcon() {
                if (this.options.helperCreateEdit) {
                    if (this.data != null)
                        return 'create';
                    return 'add_box';
                }
            }
        },
        methods: {
            emit(){
                this.$emit('input', this.data ? this.data : null);
            },
            prepareParams(busca) {
                return {
                    ...{
                            [this.options.field]: busca
                    },
                    ...this.options.otherParams
                };
            }
        }
    };
</script> 