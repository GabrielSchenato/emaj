<template>
    <div>
        <aluno-dialog ref="alunoDialog"></aluno-dialog>
        <usuario-dialog ref="usuarioDialog"></usuario-dialog>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    v-model="protocoloAluno.id"
                    label="ID"
                    disabled
                    @input="$emit('input', protocoloAluno)"
                    ></v-text-field>
            </v-flex>

        </v-layout>          
        <v-card class="mb-4">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Informações para o vínculo</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>                                     

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteAluno"
                            v-bind:errorMessages="errors.collect(optionsAluno.name)"
                            :data-vv-name="optionsAluno.name"
                            v-validate="{required: optionsAluno.required }"
                            v-bind:options="optionsAluno"
                            :create="criarAluno"
                            :edit="editarAluno"
                            v-model="protocoloAluno.aluno_id"
                            @input="$emit('input', protocoloAluno)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteProfessor"
                            v-bind:errorMessages="errors.collect(optionsProfessor.name)"
                            :data-vv-name="optionsProfessor.name"
                            v-validate="{required: optionsProfessor.required }"
                            v-bind:options="optionsProfessor"
                            :create="criarProfessor"
                            :edit="editarProfessor"
                            v-model="protocoloAluno.professor_id"
                            @input="$emit('input', protocoloAluno)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md6>
                        <data-field
                            ref="dataVinculo" 
                            v-bind:errorMessages="errors.collect(optionsDataVinculo.name)"
                            :data-vv-name="optionsDataVinculo.name"
                            v-validate="{required: optionsDataVinculo.required }"
                            v-bind:options="optionsDataVinculo"
                            v-model="protocoloAluno.data_vinculo"
                            @input="$emit('input', protocoloAluno)"
                            >                                    
                        </data-field>
                    </v-flex>

                    <v-flex xs12 sm6 md1>
                        <v-checkbox
                            name="ativo"
                            v-model="protocoloAluno.ativo"
                            label="Ativo?"
                            @change="$emit('input', protocoloAluno)"
                            ></v-checkbox>
                    </v-flex>

                </v-layout>
            </v-card-text>       
        </v-card>

    </div>
</template>
<script>
    import AlunoDialog from "@/components/cadastro/dialogs/AlunoDialog.vue";
    import UsuarioDialog from "@/components/cadastro/dialogs/UsuarioDialog.vue";
    import moment from 'moment'

    export default {
        name: "protocolo-aluno-form",
        components: {
            AlunoDialog,
            UsuarioDialog
        },
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                protocoloAluno: Object.assign({}, this.value)
            };
        },
        computed: {
            optionsAluno() {
                return {
                    field: 'aluno_id',
                    required: true,
                    itemText: 'nome_completo',
                    name: 'Aluno',
                    url: 'protocoloalunos/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsProfessor() {
                return {
                    field: 'professor_id',
                    required: true,
                    itemText: 'nome_completo',
                    name: 'Professor',
                    url: 'protocoloalunos/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsDataVinculo() {
                return {
                    name: 'Data Vínculo',
                    required: true,
                    max: moment().format('YYYY-MM-DD')
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.protocoloAluno = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            criarAluno() {
                this.$refs.alunoDialog
                        .open(
                                'Adicionar um novo Aluno',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        );
            },
            editarAluno(id) {
                this.$store.dispatch("getAluno", id).then(() => {
                    this.$refs.alunoDialog
                            .open(
                                    'Editar Aluno',
                                    this.$store.state.aluno.alunoView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            },
            criarProfessor() {
                this.$refs.usuarioDialog
                        .open(
                                'Adicionar um novo Professor',
                                {professor: true, ativo: true},
                                {
                                    color: "blue"
                                }
                        );
            },
            editarProfessor(id) {
                this.$store.dispatch("getUsuario", id).then(() => {
                    let avatar = this.$store.state.usuario.usuarioView.avatar;
                    let usuario = Object.assign({}, this.$store.state.usuario.usuarioView);
                    usuario.avatar = {avatar};
                    this.$refs.usuarioDialog
                            .open(
                                    'Editar Professor',
                                    usuario,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            }
        }
    };
</script>