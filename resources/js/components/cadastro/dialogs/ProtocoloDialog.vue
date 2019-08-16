<template>
    <v-layout row justify-center>
        <v-dialog
            v-model="dialog"
            :max-width="options.width"
            @keydown.esc="cancel"
            v-bind:style="{ zIndex: options.zIndex }"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
            >
            <v-card>
                <v-toolbar dark :color="options.color" dense flat>
                           <v-btn icon dark @click="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-card>
                        <v-form @submit.prevent="protocolo.id != null ? update() : save()">
                            <v-toolbar card prominent extended color="primary" dark extension-height="15px">
                                <v-toolbar-title class="headline"></v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-card-text>

                                <v-container grid-list-md>
                                    <v-layout wrap>
                                        <v-flex xs12>
                                            <v-stepper v-model="step">
                                                <v-stepper-header>
                                                    <v-stepper-step 
                                                        step="1"
                                                        :complete="step > 1" 
                                                        editable
                                                        >Dados do Protocolo
                                                    </v-stepper-step>
                                                    <v-divider></v-divider>
                                                    <v-stepper-step
                                                        step="2"
                                                        :complete="protocolo.id != null"
                                                        :editable="protocolo.id != null"
                                                        edit-icon="fa fa-users"
                                                        >Alunos/Professores Vinculados
                                                </v-stepper-step>
                                                <v-divider></v-divider>
                                            </v-stepper-header>
                                            <v-stepper-items>
                                                <v-stepper-content step="1">
                                                    <v-card>
                                                        <v-card-text>
                                                            <v-card>
                                                                <v-card-text>
                                                                    <v-container grid-list-md>
                                                                        <protocolo-form 
                                                                            ref="protocoloForm"
                                                                            v-model="protocolo"
                                                                            v-bind:nomeCliente="nomeCliente"
                                                                            ></protocolo-form>
                                                                    </v-container>
                                                                    <small>*Indica os campos que são obrigatórios</small>
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-card-text>
                                                    </v-card>
                                                </v-stepper-content>
                                                <v-stepper-content step="2">
                                                    <protocolo-alunos-table 
                                                        v-bind:idProtocolo="protocolo.id"
                                                        v-if="protocolo.id"
                                                        >                                                 
                                                    </protocolo-alunos-table>
                                                    <small><b>Dica: </b>Clique na linha para expandir e visualizar mais informações.</small>
                                                </v-stepper-content>
                                            </v-stepper-items>
                                        </v-stepper>
                                    </v-flex>
                                </v-layout>
                            </v-container>

                        </v-card-text>
                        <v-card-actions class="pt-0">
                            <v-spacer></v-spacer>

                            <v-btn color="green" flat="flat" type="submit">
                                Salvar
                                <v-icon right dark>check</v-icon>
                            </v-btn>

                            <v-btn color="blue" flat="flat" @click.native="clear" :disabled="protocolo.id != null">
                                   Limpar
                                   <v-icon right dark>delete_sweep</v-icon>
                            </v-btn>

                            <v-btn color="red" flat="flat" @click.native="cancel">
                                Cancelar
                                <v-icon right dark>cancel</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
    import ProtocoloForm from "@/components/cadastro/forms/ProtocoloForm.vue";
    import ProtocoloAlunosTable from "@/components/cadastro/tables/ProtocoloAlunosTable.vue";

    export default {
        components: {
            ProtocoloForm,
            ProtocoloAlunosTable
        },
        props: {
            idCliente: {
                accept: Number,
                required: true
            },
            nomeCliente: {
                accept: String,
                required: true
            }
        },
        data: () => ({
                protocolo: {},
                dialog: false,
                resolve: null,
                reject: null,
                formTitle: null,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 1000
                },
                step: 1
            }),
        methods: {
            open(title, item, options) {
                this.dialog = true;
                this.formTitle = title;
                this.step = 1;
                this.protocolo = item;
                this.$refs.protocoloForm.$refs.autocompleteTipoDemanda.values = item.tipo_demanda ? [item.tipo_demanda] : [];
                this.$refs.protocoloForm.$refs.autocompleteParteContraria.values = item.parte_contraria ? [item.parte_contraria] : [];
                this.$refs.protocoloForm.$validator.reset();
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            save() {
                this.$refs.protocoloForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("newProtocolo", {
                                    ...this.protocolo,
                                    ...{
                                            cliente_id: this.idCliente
                                    }
                                })
                                .then((resp) => {
                                    this.resolve(true);
                                    this.protocolo = resp.data;
                                    this.step = 2;
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });


                    }
                });
            },
            update() {
                this.$refs.protocoloForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("updateProtocolo", this.protocolo)
                                .then(() => {
                                    this.resolve(true);
                                    this.dialog = false;
                                    this.protocolo = {};
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados atualizados com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });
                    }
                });
            },
            cancel() {
                this.resolve(false);
                this.dialog = false;
            },
            clear() {
                this.protocolo = {};
                this.$refs.protocoloForm.$validator.errors.clear();
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.cliente_id) {
                    this.$refs.protocoloForm.$validator.errors.add({field: 'Cliente', msg: resp.response.data.errors.cliente_id});
                }
                if (resp.response.data.errors.protocolo) {
                    this.$refs.protocoloForm.$validator.errors.add({field: 'Protocolo', msg: resp.response.data.errors.protocolo});
                }
            }
        }
    };
</script>