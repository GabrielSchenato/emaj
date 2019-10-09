<template>
    <div>
        <cliente-dialog ref="clienteDialog"></cliente-dialog>
        <tipo-demanda-dialog ref="tipoDemandaDialog"></tipo-demanda-dialog>
        <aluno-dialog ref="alunoDialog"></aluno-dialog>
        <usuario-dialog ref="usuarioDialog"></usuario-dialog>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    v-model="fichaTriagem.id"
                    label="ID"
                    disabled
                    @input="$emit('input', fichaTriagem)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="protocolo"
                    v-model="fichaTriagem.protocolo"
                    label="Protocolo*"
                    return-masked-value
                    :error-messages="errors.collect('protocolo')"
                    data-vv-name="protocolo"
                    v-validate="{required: true }"
                    @input="$emit('input', fichaTriagem)"                    
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md8>
                <v-text-field
                    name="numero_processo"
                    v-model="fichaTriagem.numero_processo"
                    label="Número Processo"
                    mask="#######-##.####.#.##.####"
                    return-masked-value
                    @input="$emit('input', fichaTriagem)"
                    ></v-text-field>
            </v-flex>
        </v-layout>

        <v-card class="mb-4">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Dados das Partes</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>                                      
                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteCliente"
                            v-bind:errorMessages="errors.collect(optionsCliente.name)"
                            :data-vv-name="optionsCliente.name"
                            v-validate="{required: optionsCliente.required }"
                            v-bind:options="optionsCliente"
                            :create="criarCliente"
                            :edit="editarCliente"
                            v-model="fichaTriagem.cliente_id"
                            @input="$emit('input', fichaTriagem)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteParteContraria"
                            v-bind:errorMessages="errors.collect(optionsParteContraria.name)"
                            :data-vv-name="optionsParteContraria.name"
                            v-validate="{required: optionsParteContraria.required }"
                            v-bind:options="optionsParteContraria"
                            :create="criarCliente"
                            :edit="editarCliente"
                            v-model="fichaTriagem.parte_contraria_id"
                            @input="$emit('input', fichaTriagem)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md6>
                        <v-checkbox
                            name="ja_foi_atendido"
                            v-model="fichaTriagem.ja_foi_atendido"
                            label="Já foi atendido pelo escritório?*"
                            @change="$emit('input', fichaTriagem)"
                            ></v-checkbox>
                    </v-flex>

                    <v-flex xs12 sm6 md1>
                        <v-checkbox
                            name="ativo"
                            v-model="fichaTriagem.ativo"
                            label="Ativo?"
                            @change="$emit('input', fichaTriagem)"
                            ></v-checkbox>
                    </v-flex>
                </v-layout>
            </v-card-text>       
        </v-card>

        <v-card class="mb-4">
            <v-toolbar color="blue-grey darken-3" dark flat dense cad>
                <v-toolbar-title class="subheading">Outras Informações</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="">   
                <v-layout wrap>

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteTipoDemanda"
                            v-bind:errorMessages="errors.collect(optionsTipoDemanda.name)"
                            :data-vv-name="optionsTipoDemanda.name"
                            v-validate="{required: optionsTipoDemanda.required }"
                            v-bind:options="optionsTipoDemanda"
                            :create="criarTipoDemanda"
                            :edit="editarTipoDemanda"
                            v-model="fichaTriagem.tipo_demanda_id"
                            @input="$emit('input', fichaTriagem)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md6>   
                        <autocomplete-field
                            ref="autocompleteAluno"
                            v-bind:errorMessages="errors.collect(optionsAluno.name)"
                            :data-vv-name="optionsAluno.name"
                            v-validate="{required: optionsAluno.required }"
                            v-bind:options="optionsAluno"
                            :create="criarAluno"
                            :edit="editarAluno"
                            v-model="fichaTriagem.aluno_id"
                            @input="$emit('input', fichaTriagem)"
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
                            v-model="fichaTriagem.professor_id"
                            @input="$emit('input', fichaTriagem)"
                            ></autocomplete-field>
                    </v-flex>

                    <v-flex xs12 sm6 md12>
                        <v-text-field
                            name="outras_informacoes"
                            v-model="fichaTriagem.outras_informacoes"
                            label="Outras Informações"
                            @input="$emit('input', fichaTriagem)"
                            ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>       
        </v-card>
        <ul>
            <li><small><span class="required">*</span> <b>(Asterisco)</b> Indica os campos que são obrigatórios</small></li>
        </ul>   
    </div>
</template>
<script>
    import TipoDemandaDialog from "@/components/cadastro/dialogs/TipoDemandaDialog.vue";
    import AlunoDialog from "@/components/cadastro/dialogs/AlunoDialog.vue";
    import UsuarioDialog from "@/components/cadastro/dialogs/UsuarioDialog.vue";

    export default {
        name: "ficha-triagem-form",
        components: {
            TipoDemandaDialog,
            AlunoDialog,
            UsuarioDialog
        },
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
                fichaTriagem: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                clientes: [],
                parteContrarias: [],
                tipoDemandas: [],
                alunos: [],
                professores: [],
                loadingClientes: false,
                autocompleteClientes: null,
                loadingParteContrarias: false,
                autocompleteParteContrarias: null,
                loadingTipoDemandas: false,
                autocompleteTipoDemandas: null,
                loadingAlunos: false,
                autocompleteAlunos: null,
                loadingProfessores: false,
                autocompleteProfessores: null
            };
        },
        computed: {
            optionsCliente() {
                return {
                    field: 'cliente_id',
                    required: true,
                    itemText: 'nome_completo',
                    name: 'Cliente',
                    url: 'fichatriagens/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsParteContraria() {
                return {
                    field: 'parte_contraria_id',
                    required: false,
                    itemText: 'nome_completo',
                    name: 'Parte Contrária',
                    url: 'fichatriagens/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsTipoDemanda() {
                return {
                    field: 'tipo_demanda_id',
                    required: false,
                    itemText: 'nome',
                    name: 'Tipo de Demanda',
                    url: 'fichatriagens/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsAluno() {
                return {
                    field: 'aluno_id',
                    required: false,
                    itemText: 'nome_completo',
                    name: 'Aluno',
                    url: 'fichatriagens/autocomplete',
                    helperCreateEdit: true
                };
            },
            optionsProfessor() {
                return {
                    field: 'professor_id',
                    required: false,
                    itemText: 'nome_completo',
                    name: 'Professor',
                    url: 'fichatriagens/autocomplete',
                    helperCreateEdit: true
                };
            }
        },
        watch: {
            value: {
                handler() {
                    this.fichaTriagem = Object.assign({}, this.value);
                },
                deep: true
            },
            autocompleteClientes: _.debounce(
                    function autocompleteClientes(busca) {
                        if (this.fichaTriagem.cliente_id && busca.length <= 1)
                        {
                            this.fichaTriagem.cliente_id = null;
                        }
                        if (busca) {
                            if (this.loadingClientes)
                                return;

                            if (this.fichaTriagem.cliente_id)
                                return;

                            this.loadingClientes = true;
                            window.axios.get(`fichatriagens/autocomplete?nome_cliente=${busca.replace(' ', '%20')}`).then(response => {
                                this.clientes = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingClientes = false));
                        }

                    },
                    500,
                    ),
            autocompleteParteContrarias: _.debounce(
                    function autocompleteParteContrarias(busca) {
                        if (this.fichaTriagem.parte_contraria_id && busca.length <= 1)
                        {
                            this.fichaTriagem.parte_contraria_id = null;
                        }
                        if (busca) {
                            if (this.loadingParteContrarias)
                                return;

                            if (this.fichaTriagem.parte_contraria_id)
                                return;

                            this.loadingParteContrarias = true;
                            window.axios.get(`fichatriagens/autocomplete?nome_cliente=${busca.replace(' ', '%20')}`).then(response => {
                                this.parteContrarias = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingParteContrarias = false));
                        }

                    },
                    500,
                    ),
            autocompleteTipoDemandas: _.debounce(
                    function autocompleteTipoDemandas(busca) {
                        if (this.fichaTriagem.tipo_demanda_id && busca.length <= 1)
                        {
                            this.fichaTriagem.tipo_demanda_id = null;
                        }
                        if (busca) {
                            if (this.loadingTipoDemandas)
                                return;

                            if (this.fichaTriagem.tipo_demanda_id)
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
            autocompleteAlunos: _.debounce(
                    function autocompleteAlunos(busca) {
                        if (this.fichaTriagem.aluno_id && busca.length <= 1)
                        {
                            this.fichaTriagem.aluno_id = null;
                        }
                        if (busca) {
                            if (this.loadingAlunos)
                                return;

                            if (this.fichaTriagem.aluno_id)
                                return;

                            this.loadingAlunos = true;
                            window.axios.get(`fichatriagens/autocomplete?nome_aluno=${busca.replace(' ', '%20')}`).then(response => {
                                this.alunos = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingAlunos = false));
                        }

                    },
                    500,
                    ),
            autocompleteProfessores: _.debounce(
                    function autocompleteProfessores(busca) {
                        if (this.fichaTriagem.professor_id && busca.length <= 1)
                        {
                            this.fichaTriagem.professor_id = null;
                        }
                        if (busca) {
                            if (this.loadingProfessores)
                                return;

                            if (this.fichaTriagem.professor_id)
                                return;

                            this.loadingProfessores = true;
                            window.axios.get(`fichatriagens/autocomplete?nome_professor=${busca.replace(' ', '%20')}`).then(response => {
                                this.professores = response.data;
                            }).catch(resp => {
                                let msgErro = '';
                                if (resp.response.data.errors)
                                    msgErro = resp.response.data.errors;
                                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                            }).finally(() => (this.loadingProfessores = false));
                        }

                    },
                    500,
                    )
        },
        methods: {
            criarCliente() {
                this.$refs.clienteDialog
                        .open(
                                'Adicionar um novo Cliente',
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
            editarCliente(id) {
                this.$store.dispatch("getCliente", id).then(() => {
                    this.$refs.clienteDialog
                            .open(
                                    'Editar Cliente',
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
                                    'Editar um Tipo de Demanda',
                                    this.$store.state.tipodemanda.tipoDemandaView,
                                    {
                                        color: "blue"
                                    }
                            );
                });
            },
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
                                    'Editar um Aluno',
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
                                    'Editar um Professor',
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