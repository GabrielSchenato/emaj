<template>
    <v-card>
        <v-toolbar card prominent extended color="primary" dark extension-height="15px">
            <v-toolbar-title class="headline">Relatório das Atividades Prestadas pelo Escritório Modelo</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <v-form>
                <v-layout row wrap>
                    <data-field
                        ref="dataInicial" 
                        v-bind:options="optionsDataInicial"
                        v-model="relAtividadesPrestadas.data_inicial"
                        >                                    
                    </data-field>
                    <data-field
                        ref="dataFinal" 
                        v-bind:options="optionsDataFinal"
                        v-model="relAtividadesPrestadas.data_final"
                        >                                    
                    </data-field>
                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="tipo_demanda_id"
                            :items="tipoDemandas"
                            :search-input.sync="autocompleteTipoDemandas"
                            :loading="loadingTipoDemandas"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            item-text="nome"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Tipo de Demanda"
                            v-model="relAtividadesPrestadas.tipo_demanda_id"
                            v-validate="{required: false }"
                            :error-messages="errors.collect('tipo de demanda')"
                            data-vv-name="tipo de demanda"
                            @input="$emit('input', relAtividadesPrestadas)"
                            ></v-autocomplete>
                    </v-flex>
                </v-layout>
            </v-form>
            <small>*Indica os campos que são obrigatórios</small>
        </v-card-text>
        <v-card-actions class="pt-0">
            <v-spacer></v-spacer>
            <v-btn color="green" flat="flat" @click.native="save">Salvar
                <v-icon right dark>check</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
    import DataField from "@/components/DataField";
    export default {
        name: "relatorio-atividades-prestadas-form",
        components: {
            DataField
        },
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                relAtividadesPrestadas: Object.assign({}, this.value),
                menuDataInicial: false,
                menuDataFinal: false,
                tipoDemandas: [],
                loadingTipoDemandas: false,
                autocompleteTipoDemandas: null
            };
        },
        computed: {
            optionsDataInicial() {
                return {
                    name: 'Data Inicial',
                    required: true,
                    max: this.relAtividadesPrestadas.data_final
                };
            },
            optionsDataFinal() {
                return {
                    name: 'Data Final',
                    required: true,
                    min: this.relAtividadesPrestadas.data_inicial
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.relAtividadesPrestadas = Object.assign({}, this.value);
                },
                deep: true
            },
            autocompleteTipoDemandas: _.debounce(
                    function autocompleteTipoDemandas(busca) {
                        if (this.relAtividadesPrestadas.tipo_demanda_id && busca.length <= 1)
                        {
                            this.relAtividadesPrestadas.tipo_demanda_id = null;
                        }
                        if (busca) {
                            if (this.loadingTipoDemandas)
                                return;

                            if (this.relAtividadesPrestadas.tipo_demanda_id)
                                return;

                            this.loadingTipoDemandas = true;
                            window.axios.get(`fichatriagens/autocomplete?nome_tipo_demanda=${busca.replace(' ', '%20')}`).then(response => {
                                this.tipoDemandas = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingTipoDemandas = false));
                        }

                    },
                    500,
                    ),
        },
    };
</script>