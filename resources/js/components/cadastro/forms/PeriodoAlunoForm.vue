<template>
    <v-layout wrap>
        <v-flex xs12 sm6 md6>
            <v-text-field
                name="nome_aluno"
                v-model="periodoAluno.nome_aluno"
                v-validate="'required'"
                :error-messages="errors.collect('Aluno')"
                data-vv-name="Aluno"
                @input="$emit('input', periodoAluno)"
                disabled
                >
                <template v-slot:label>
                    Aluno<span class="required">*</span>
                </template>
            </v-text-field>
        </v-flex>
        <v-flex xs12 sm6 md6>   
            <autocomplete-field
                ref="autocompletePeriodo"
                v-bind:errorMessages="errors.collect(optionsPeriodo.name)"
                :data-vv-name="optionsPeriodo.name"
                v-validate="{required: optionsPeriodo.required }"
                v-bind:options="optionsPeriodo"
                v-model="periodoAluno.dia_periodo_id"
                @input="$emit('input', periodoAluno)"
                ></autocomplete-field>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        name: "periodo-aluno-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                periodoAluno: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsPeriodo() {
                return {
                    field: 'dia_periodo_id',
                    required: true,
                    itemText: 'dados_dia_periodo',
                    name: 'Período',
                    url: 'diaperiodoalunos/autocomplete'
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.periodoAluno = Object.assign({}, this.value);
                },
                deep: true
            }
        }
    };
</script>