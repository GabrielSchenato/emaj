<template>
    <v-form>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    id="id"
                    v-model="aluno.id"
                    label="ID"
                    disabled
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="nome_completo"
                    id="nome_completo"
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
                    name="email"
                    id="email"
                    v-model="aluno.email"
                    label="E-mail"
                    :error-messages="errors.collect('e-mail')"
                    data-vv-name="e-mail"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="celular"
                    id="celular"
                    v-model="aluno.celular"
                    label="Celular"
                    mask="(##) #####-####"
                    return-masked-value
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>
            
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="telefone"
                    id="telefone"
                    v-model="aluno.telefone"
                    label="Telefone"
                    mask="(##) ####-####"
                    return-masked-value
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>
            
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="fase"
                    id="fase"
                    v-model="aluno.fase"
                    label="Fase"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>
            
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="matricula"
                    id="matricula"
                    v-model="aluno.matricula"
                    label="Matricula"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex>            

            <v-flex xs12 sm6 md2>
                <v-select
                    name="disciplina"
                    id="disciplina"
                    :items="disciplinas"
                    label="Disciplina"
                    v-model="aluno.disciplina"
                    @input="$emit('input', aluno)"
                    item-value="id"
                    item-text="nome"
                    ></v-select>
            </v-flex>
            
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="ano"
                    id="ano"
                    v-model="aluno.ano"
                    label="Ano"
                    type="number"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex> 
            
            <v-flex xs12 sm6 md2>
                <v-select
                    name="semestres"
                    id="semestres"
                    :items="semestres"
                    label="Semestre"
                    v-model="aluno.semestre"
                    @input="$emit('input', aluno)"
                    item-value="id"
                    item-text="nome"
                    ></v-select>
            </v-flex>
            
            <v-flex xs12 sm6 md2>
                <v-select
                    name="turno"
                    id="turno"
                    :items="turnos"
                    label="Turno"
                    v-model="aluno.turno"
                    @input="$emit('input', aluno)"
                    item-value="id"
                    item-text="nome"
                    ></v-select>
            </v-flex>
            
            <v-flex xs12 sm6 md9>
                <v-text-field
                    name="observacoes"
                    id="observacoes"
                    v-model="aluno.observacoes"
                    label="Observacoes"
                    @input="$emit('input', aluno)"
                    ></v-text-field>
            </v-flex> 

            <v-flex xs12 sm6 md1>
                <v-checkbox
                    name="ativo"
                    id="ativo"
                    v-model="aluno.ativo"
                    label="Ativo?"
                    @change="$emit('input', aluno)"
                    ></v-checkbox>
            </v-flex>

        </v-layout>
    </v-form>
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