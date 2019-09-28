<template>
    <div>
        <v-alert
            :value="!aluno.ativo"
            type="info"
            >
            <ul>
                <li>Inativando o aluno você estará também inativando o vinculo do mesmo aos protocolos.</li>
                <li>O vínculo do aluno com os períodos será deletado.</li>
            </ul>  
        </v-alert> 
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    v-model="aluno.id"
                    label="ID"
                    disabled
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="nome_completo"
                    v-model="aluno.nome_completo"
                    v-validate="'required'"
                    :error-messages="errors.collect('Nome Completo')"
                    data-vv-name="Nome Completo"
                    @input="$emit('input', aluno)"
                    >
                    <template v-slot:label>
                        Nome Completo<span class="required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="email"
                    v-model="aluno.email"
                    label="E-mail"
                    :error-messages="errors.collect('E-mail')"
                    data-vv-name="e-mail"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="celular"
                    v-model="aluno.celular"
                    label="Celular"
                    mask="(##) #####-####"
                    return-masked-value
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md3>
                <v-text-field
                    name="telefone"
                    v-model="aluno.telefone"
                    label="Telefone"
                    mask="(##) ####-####"
                    return-masked-value
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="matricula"
                    v-model="aluno.matricula"
                    label="Matricula"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>            

            <v-flex xs12 sm6 md4>   
                <autocomplete-field
                    ref="autocompleteDisciplina"
                    v-bind:errorMessages="errors.collect(optionsDisciplina.name)"
                    :data-vv-name="optionsDisciplina.name"
                    v-validate="{required: optionsDisciplina.required }"
                    v-bind:options="optionsDisciplina"
                    v-model="aluno.disciplina_id"
                    @input="$emit('input', aluno)"
                    ></autocomplete-field>
            </v-flex>  

            <v-flex xs12 sm6 md9>
                <v-text-field
                    name="observacoes"
                    v-model="aluno.observacoes"
                    label="Observações"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex> 

            <v-flex xs12 sm6 md1>
                <v-checkbox
                    name="ativo"
                    v-model="aluno.ativo"
                    label="Ativo?"
                    @change="$emit('input', aluno)"
                    ></v-checkbox>
            </v-flex>

        </v-layout>
    </div>
</template>
<script>
    export default {
        name: "aluno-form",
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                aluno: Object.assign({}, this.value),
            };
        },
        computed: {
            optionsDisciplina() {
                return {
                    field: 'disciplina_id',
                    required: true,
                    itemText: 'dados_disciplina',
                    name: 'Disciplina',
                    url: 'alunos/autocomplete'
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.aluno = Object.assign({}, this.value);
                },
                deep: true
            }
        }
    };
</script>