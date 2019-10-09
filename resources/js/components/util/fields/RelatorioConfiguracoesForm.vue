<template>
    <div class="pt-3">
        <fieldset>
            <legend>Configurações</legend>
            <v-layout row wrap>
                <v-flex xs12 sm6 md2 v-if="tipoRelatorio">
                    <v-select
                        v-model="configuracoes.tipo_relatorio"
                        :items="tiposRelatorios"
                        menu-props="auto"
                        hide-details
                        label="Tipo de Relatório"
                        item-text="nome"
                        item-value="id"
                        @input="$emit('input', configuracoes)"
                        ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md2>
                    <v-select
                        v-model="configuracoes.formato"
                        :items="formatos"
                        menu-props="auto"
                        hide-details
                        label="Formato"
                        item-text="nome"
                        item-value="id"
                        @input="$emit('input', configuracoes)"
                        ></v-select>
                </v-flex>
            </v-layout>            
        </fieldset>
    </div>
</template>
<script>
    export default {
        name: "relatorio-configuracoes-form",
        props: {
            value: {
                type: [Object]
            },
            tipoRelatorio: {
                type: Boolean
            }
        },
        data() {
            return {
                configuracoes: Object.assign({}, this.value),
                tiposRelatorios: [
                    {
                        id: 1, nome: 'Sintético'
                    },
                    {
                        id: 2, nome: 'Analítico'
                    }
                ],
                formatos: [
                    {
                        id: 'pdf', nome: 'PDF'
                    },
                    {
                        id: 'xlsx', nome: 'XLSX'
                    },
                    {
                        id: 'docx', nome: 'DOCX'
                    },
                    {
                        id: 'pptx', nome: 'PPTX'
                    },
                    //{
                    //    id: 'xhtml', nome: 'XHTML'
                    //},
                    {
                        id: 'rtf', nome: 'RTF'
                    },
                    {
                        id: 'odt', nome: 'ODT'
                    },
                    {
                        id: 'html', nome: 'HTML'
                    },
                    {
                        id: 'xls', nome: 'XLS'
                    },
                    {
                        id: 'xml', nome: 'XML'
                    },
                    {
                        id: 'jrprint', nome: 'JRPRINT'
                    },
                    {
                        id: 'csv', nome: 'CSV'
                    }
                ]
            };
        },
        computed: {
            optionsDefault() {
                if (this.tipoRelatorio)
                    this.configuracoes.tipo_relatorio = 1;
                this.configuracoes.formato = 'pdf';
                return this.configuracoes;
            }
        },
        watch: {
            value: {
                handler() {
                    this.configuracoes = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        created() {
            this.$emit('input', this.optionsDefault);
        }
    };
</script>