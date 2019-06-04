<template>
    <div>
        <cliente-dialog ref="clienteDialog"></cliente-dialog>
        <tipo-demanda-dialog ref="tipoDemandaDialog"></tipo-demanda-dialog>
        <aluno-dialog ref="alunoDialog"></aluno-dialog>
        <usuario-dialog ref="usuarioDialog"></usuario-dialog>
        <v-layout wrap>
            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="ficha_triagem_id"
                    id="ficha_triagem_id"
                    v-model="fichaTriagem.id"
                    label="ID"
                    disabled
                    @input="$emit('input', fichaTriagem)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="ficha_triagem_protocolo"
                    id="ficha_triagem_protocolo"
                    v-model="fichaTriagem.protocolo"
                    label="Protocolo*"
                    mask="#####/##"
                    return-masked-value
                    :error-messages="errors.collect('protocolo')"
                    data-vv-name="protocolo"
                    v-validate="{required: true }"
                    @input="$emit('input', fichaTriagem)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md8>
                <v-text-field
                    name="ficha_triagem_numero_processo"
                    id="ficha_triagem_numero_processo"
                    v-model="fichaTriagem.numero_processo"
                    label="Número Processo"
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
                        <v-autocomplete
                            name="ficha_triagem_cliente_id"
                            id="ficha_triagem_cliente_id"
                            :items="clientes"
                            item-text="nome_completo"
                            :search-input.sync="autocompleteClientes"
                            :loading="loadingClientes"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            autofocus
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Cliente*"
                            v-model="fichaTriagem.cliente_id"
                            v-validate="{required: true }"
                            :error-messages="errors.collect('cliente')"
                            data-vv-name="cliente"
                            @input="$emit('input', fichaTriagem)"
                            :prepend-icon="fichaTriagem.cliente_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.cliente_id != null ? editarCliente(fichaTriagem.cliente_id) : criarCliente()"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>            
                        <v-autocomplete
                            name="ficha_triagem_parte_contraria_id"
                            id="ficha_triagem_parte_contraria_id"
                            :items="parteContrarias"
                            :search-input.sync="autocompleteParteContrarias"
                            :loading="loadingParteContrarias"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            item-text="nome_completo"
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Parte Contrária"
                            v-model="fichaTriagem.parte_contraria_id"
                            :error-messages="errors.collect('parte contrária')"
                            data-vv-name="parte contrária"
                            :prepend-icon="fichaTriagem.parte_contraria_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.parte_contraria_id != null ? editarCliente(fichaTriagem.parte_contraria_id) : criarCliente()"
                            @input="$emit('input', fichaTriagem)"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>
                        <v-checkbox
                            name="ficha_triagem_ja_foi_atendido"
                            id="ficha_triagem_ja_foi_atendido"
                            v-model="fichaTriagem.ja_foi_atendido"
                            label="Já foi atendido pelo escritório?*"
                            @change="$emit('input', fichaTriagem)"
                            ></v-checkbox>
                    </v-flex>

                    <v-flex xs12 sm6 md1>
                        <v-checkbox
                            name="ficha_triagem_ativo"
                            id="ficha_triagem_ativo"
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
                        <v-autocomplete
                            name="ficha_triagem_tipo_demanda_id"
                            id="ficha_triagem_tipo_demanda_id"
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
                            v-model="fichaTriagem.tipo_demanda_id"
                            v-validate="{required: false }"
                            :error-messages="errors.collect('tipo de demanda')"
                            data-vv-name="tipo de demanda"
                            @input="$emit('input', fichaTriagem)"
                            :prepend-icon="fichaTriagem.tipo_demanda_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.tipo_demanda_id != null ? editarTipoDemanda(fichaTriagem.tipo_demanda_id) : criarTipoDemanda()"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>   
                        <v-autocomplete
                            name="ficha_triagem_aluno_id"
                            id="ficha_triagem_aluno_id"
                            :items="alunos"
                            item-text="nome_completo"
                            :search-input.sync="autocompleteAlunos"
                            :loading="loadingAlunos"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            autofocus
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Aluno"
                            v-model="fichaTriagem.aluno_id"
                            @input="$emit('input', fichaTriagem)"
                            :prepend-icon="fichaTriagem.aluno_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.aluno_id != null ? editarAluno(fichaTriagem.aluno_id) : criarAluno()"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md6>   
                        <v-autocomplete
                            name="ficha_triagem_professor_id"
                            id="ficha_triagem_professor_id"
                            :items="professores"
                            item-text="nome_completo"
                            :search-input.sync="autocompleteProfessores"
                            :loading="loadingProfessores"
                            hide-no-data
                            clearable
                            placeholder="Comece a digitar para pesquisar"
                            autofocus
                            item-value="id"
                            no-data-text="Não há registros para serem exibidos."
                            label="Professor"
                            v-model="fichaTriagem.professor_id"
                            @input="$emit('input', fichaTriagem)"
                            :prepend-icon="fichaTriagem.professor_id != null ? 'create' : 'add_box'"
                            @click:prepend="fichaTriagem.professor_id != null ? editarProfessor(fichaTriagem.professor_id) : criarProfessor()"
                            ></v-autocomplete>
                    </v-flex>

                    <v-flex xs12 sm6 md12>
                        <v-text-field
                            name="ficha_triagem_outras_informacoes"
                            id="ficha_triagem_outras_informacoes"
                            v-model="fichaTriagem.outras_informacoes"
                            label="Outras Informações"
                            @input="$emit('input', fichaTriagem)"
                            ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>       
        </v-card>
        <small>*Indica os campos que são obrigatórios</small>
    </div>
</template>
<script>
    import ClienteDialog from "@/components/cadastro/dialogs/ClienteDialog.vue";
    import TipoDemandaDialog from "@/components/cadastro/dialogs/TipoDemandaDialog.vue";
    import AlunoDialog from "@/components/cadastro/dialogs/AlunoDialog.vue";
    import UsuarioDialog from "@/components/cadastro/dialogs/UsuarioDialog.vue";

    export default {
        name: "ficha-triagem-form",
        components: {
            ClienteDialog,
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
        watch: {
            value: {
                handler() {
                    this.fichaTriagem = Object.assign({}, this.value);
                },
                deep: true
            },
            autocompleteClientes(busca) {
                if (this.fichaTriagem.cliente_id && busca.length <= 1)
                {
                    this.fichaTriagem.cliente_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingClientes)
                        return;

                    if (this.fichaTriagem.cliente_id)
                        return;

                    this.loadingClientes = true;
                    window.axios.get('clientes/autocomplete?query=' + busca).then(response => {
                        this.clientes = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingClientes = false));
                }

            },
            autocompleteParteContrarias(busca) {
                if (this.fichaTriagem.parte_contraria_id && busca.length <= 1)
                {
                    this.fichaTriagem.cliente_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingParteContrarias)
                        return;

                    if (this.fichaTriagem.parte_contraria_id)
                        return;

                    this.loadingParteContrarias = true;
                    window.axios.get('clientes/autocomplete?query=' + busca).then(response => {
                        this.parteContrarias = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingParteContrarias = false));
                }

            },
            autocompleteTipoDemandas(busca) {
                if (this.fichaTriagem.tipo_demanda_id && busca.length <= 1)
                {
                    this.fichaTriagem.tipo_demanda_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingTipoDemandas)
                        return;

                    if (this.fichaTriagem.tipo_demanda_id)
                        return;

                    this.loadingTipoDemandas = true;
                    window.axios.get('tipodemandas/autocomplete?query=' + busca).then(response => {
                        this.tipoDemandas = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingTipoDemandas = false));
                }

            },
            autocompleteAlunos(busca) {
                if (this.fichaTriagem.aluno_id && busca.length <= 1)
                {
                    this.fichaTriagem.aluno_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingAlunos)
                        return;

                    if (this.fichaTriagem.aluno_id)
                        return;

                    this.loadingAlunos = true;
                    window.axios.get('alunos/autocomplete?query=' + busca).then(response => {
                        this.alunos = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingAlunos = false));
                }

            },
            autocompleteProfessores(busca) {
                if (this.fichaTriagem.professor_id && busca.length <= 1)
                {
                    this.fichaTriagem.professor_id = null;
                }
                if (busca && busca.length > 2) {
                    if (this.loadingProfessores)
                        return;

                    if (this.fichaTriagem.professor_id)
                        return;

                    this.loadingProfessores = true;
                    window.axios.get('usuarios/autocomplete?query=' + busca).then(response => {
                        this.professores = response.data;
                    }).catch(resp => {
                        let msgErro = '';
                        if (resp.response.data.errors)
                            msgErro = resp.response.data.errors;
                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                    }).finally(() => (this.loadingProfessores = false));
                }

            }
        },
        methods: {
            criarCliente() {
                this.$refs.clienteDialog
                        .open(
                                'Adicionar um novo Cliente',
                                {
                                    informacoesPessoais: {
                                        ativo: true
                                    },
                                    endereco: {},
                                    composicaoFamiliar: {},
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