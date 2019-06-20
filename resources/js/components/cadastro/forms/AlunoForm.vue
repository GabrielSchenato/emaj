<template>
    <v-layout wrap>
        <v-flex xs12 sm6 md2>
            <v-text-field
                name="aluno_id"
                id="aluno_id"
                v-model="aluno.id"
                label="ID"
                disabled
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md5>
            <v-text-field
                name="aluno_nome_completo"
                id="aluno_nome_completo"
                v-model="aluno.nome_completo"
                label="Nome Completo*"
                v-validate="'required'"
                :error-messages="errors.collect('nome completo')"
                data-vv-name="nome completo"
                required
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md5>
            <v-text-field
                name="aluno_email"
                id="aluno_email"
                v-model="aluno.email"
                label="E-mail"
                :error-messages="errors.collect('e-mail')"
                data-vv-name="e-mail"
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md2>
            <v-text-field
                name="aluno_celular"
                id="aluno_celular"
                v-model="aluno.celular"
                label="Celular"
                mask="(##) #####-####"
                return-masked-value
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md2>
            <v-text-field
                name="aluno_telefone"
                id="aluno_telefone"
                v-model="aluno.telefone"
                label="Telefone"
                mask="(##) ####-####"
                return-masked-value
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-text-field
                name="aluno_fase"
                id="aluno_fase"
                v-model="aluno.fase"
                label="Fase"
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md2>
            <v-text-field
                name="aluno_matricula"
                id="aluno_matricula"
                v-model="aluno.matricula"
                label="Matricula"
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex>            

        <v-flex xs12 sm6 md2>
            <v-select
                name="aluno_disciplina"
                id="aluno_disciplina"
                :items="disciplinas"
                label="Disciplina"
                v-model="aluno.disciplina"
                @input="$emit('input', aluno)"
                item-value="id"
                item-text="nome"
                clearable
                ></v-select>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-text-field
                name="aluno_ano"
                id="aluno_ano"
                v-model="aluno.ano"
                label="Ano"
                type="number"
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex> 

        <v-flex xs12 sm6 md2>
            <v-select
                name="aluno_semestres"
                id="aluno_semestres"
                :items="semestres"
                label="Semestre"
                v-model="aluno.semestre"
                @input="$emit('input', aluno)"
                item-value="id"
                item-text="nome"
                clearable
                ></v-select>
        </v-flex>

        <v-flex xs12 sm6 md2>
            <v-select
                name="aluno_turno"
                id="aluno_turno"
                :items="turnos"
                label="Turno"
                v-model="aluno.turno"
                @input="$emit('input', aluno)"
                item-value="id"
                item-text="nome"
                clearable
                ></v-select>
        </v-flex>

        <v-flex xs12 sm6 md9>
            <v-text-field
                name="aluno_observacoes"
                id="aluno_observacoes"
                v-model="aluno.observacoes"
                label="Observações"
                @input="$emit('input', aluno)"
                ></v-text-field>
        </v-flex> 

        <v-flex xs12 sm6 md1>
            <v-checkbox
                name="aluno_ativo"
                id="aluno_ativo"
                v-model="aluno.ativo"
                label="Ativo?"
                @change="$emit('input', aluno)"
                ></v-checkbox>
        </v-flex>

    </v-layout>
</template>
<script>
    export default {
        name: "aluno-form",
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
                aluno: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                disciplinas: [
                    {
                        id: 'Estágio II',
                        nome: 'Estágio II'
                    },
                    {
                        id: 'Estágio III',
                        nome: 'Estágio III'
                    },
                    {
                        id: 'Estágio IV',
                        nome: 'Estágio IV'
                    }
                ],
                semestres: [
                    {
                        id: '1',
                        nome: '1'
                    },
                    {
                        id: '2',
                        nome: '2'
                    }
                ],
                turnos: [
                    {
                        id: 'Matutino',
                        nome: 'Matutino'
                    },
                    {
                        id: 'Noturno',
                        nome: 'Noturno'
                    }
                ]
            };
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