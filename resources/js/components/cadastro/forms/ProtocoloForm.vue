<template>
    <div>
        <v-alert
            :value="!protocolo.ativo"
            type="info"
            >
            Inativando o protocolo você estará inativando os alunos e professores vinculados a ele.
        </v-alert>       

        <cliente-dialog ref="parteContrariaDialog"></cliente-dialog>
        <tipo-demanda-dialog ref="tipoDemandaDialog"></tipo-demanda-dialog>
        <v-layout wrap>

            <v-flex xs12 sm6 md6>
                <v-text-field
                    name="cliente"
                    v-model="nomeCliente"
                    label="Cliente"
                    disabled
                    :error-messages="errors.collect('Cliente')"
                    data-vv-name="Cliente"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md6>
                <v-text-field
                    name="representado_assistido"
                    v-model="nomeRepresentadoAssistido"
                    label="Representado/Assistido"
                    disabled
                    :error-messages="errors.collect('Representado/Assistido')"
                    data-vv-name="Representado/Assistido"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    v-model="protocolo.id"
                    label="ID"
                    disabled
                    @input="$emit('input', protocolo)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="protocolo"
                    v-model="protocolo.protocolo"
                    return-masked-value
                    autofocus
                    :error-messages="errors.collect('Protocolo')"
                    data-vv-name="Protocolo"
                    v-validate="{required: true, isValidProtocolo: protocolo.protocolo}"
                    @input="$emit('input', protocolo)"                    
                    >
                    <template v-slot:label>
                        Protocolo<span class="required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md8>
                <v-text-field
                    name="numero_processo"
                    v-model="protocolo.numero_processo"
                    label="Número Processo"
                    mask="#######-##.####.#.##.####"
                    return-masked-value
                    @input="$emit('input', protocolo)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-checkbox
                    name="ativo"
                    v-model="protocolo.ativo"
                    label="Ativo?"
                    @change="$emit('input', protocolo)"
                    ></v-checkbox>
            </v-flex>
        </v-layout>

        <v-card class="mb-12">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Outras Informações</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteParteContraria"
                            v-bind:errorMessages="errors.collect(optionsParteContraria.name)"
                            :data-vv-name="optionsParteContraria.name"
                            v-validate="{required: optionsParteContraria.required }"
                            v-bind:options="optionsParteContraria"
                            :create="criarParteContraria"
                            :edit="editarParteContraria"
                            v-model="protocolo.parte_contraria_id"
                            @input="$emit('input', protocolo)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteTipoDemanda"
                            v-bind:errorMessages="errors.collect(optionsTipoDemanda.name)"
                            :data-vv-name="optionsTipoDemanda.name"
                            v-validate="{required: optionsTipoDemanda.required }"
                            v-bind:options="optionsTipoDemanda"
                            :create="criarTipoDemanda"
                            :edit="editarTipoDemanda"
                            v-model="protocolo.tipo_demanda_id"
                            @input="$emit('input', protocolo)"
                            ></autocomplete-field>
                    </v-flex>  

                    <v-flex xs12 sm6 md12>
                        <v-text-field
                            name="observacoes"
                            v-model="protocolo.observacoes"
                            label="Observações"
                            @input="$emit('input', protocolo)"
                            ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>       
        </v-card>
    </div>
</template>
<script>
    import TipoDemandaDialog from "@/components/cadastro/dialogs/TipoDemandaDialog.vue";

    export default {
        name: "protocolo-form",
        components: {
            TipoDemandaDialog
        },
        props: {
            value: {
                type: [Object]
            },
            nomeCliente: {
                accept: String,
                required: true
            },
            nomeRepresentadoAssistido: {
                accept: String
            }
        },
        data() {
            return {
                protocolo: Object.assign({}, this.value)
            };
        },
        created() {
            this.$validator.extend(
                    'isValidProtocolo', {
                        getMessage: field => `O campo ${field} deve seguir o padrão #####/##`,
                        validate: (value) => {
                            // value must be > zero
                            if (/^(\d{0,8}\/\d{2})$/g.test(value))
                                return true;
                            return false;
                        }
                    });
        },
        computed: {
            optionsParteContraria() {
                return {
                    field: 'parte_contraria_id',
                    required: false,
                    itemText: 'nome_completo',
                    name: 'Parte Contrária',
                    url: 'protocolos/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsTipoDemanda() {
                return {
                    field: 'tipo_demanda_id',
                    required: false,
                    itemText: 'nome',
                    name: 'Tipo de Demanda',
                    url: 'protocolos/autocomplete',
                    helperCreateEdit: true
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.protocolo = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            criarParteContraria() {
                this.$refs.parteContrariaDialog
                        .open(
                                'Adicionar uma nova Parte Contrária',
                                {
                                    ativo: true,
                                    nacionalidade_id: 7,
                                    endereco: {},
                                    composicao_familiar: {},
                                    telefones: []
                                },
                                {
                                    color: "blue"
                                }
                        );
            },
            editarParteContraria(id) {
                this.$store.dispatch("getCliente", id).then(() => {
                    this.$refs.parteContrariaDialog
                            .open(
                                    'Editar Parte Contrária',
                                    this.$store.state.cliente.clienteView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            },
            criarTipoDemanda() {
                this.$refs.tipoDemandaDialog
                        .open(
                                'Adicionar um novo Tipo de Demanda',
                                {ativo: true},
                                {
                                    color: "blue"
                                }
                        );
            },

            editarTipoDemanda(id) {
                this.$store.dispatch("getTipoDemanda", id).then(() => {
                    this.$refs.tipoDemandaDialog
                            .open(
                                    'Editar Tipo de Demanda',
                                    this.$store.state.tipodemanda.tipoDemandaView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            }
        }
    };
</script>