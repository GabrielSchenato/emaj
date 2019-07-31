<template>
    <v-card>
        <v-toolbar card prominent extended color="primary" dark extension-height="15px">
            <v-toolbar-title class="headline">Parâmetros da Triagem</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <v-form>
                <v-layout row wrap>
                    <v-flex xs12 sm6 md1>
                        <v-text-field
                            name="id"
                            v-model="parametrosTriagem.id"
                            label="ID"
                            disabled
                            @input="$emit('input', parametrosTriagem)"
                            ></v-text-field>
                    </v-flex>     
                    <v-flex xs12 sm6 md4>
                        <vuetify-money
                            ref="moneyRenda"
                            name="renda"
                            v-model="parametrosTriagem.renda"
                            label="Renda*"
                            v-bind:validations="validations"
                            @input="$emit('input', parametrosTriagem)"
                            v-bind:ajudaRenda="ajudaRenda"
                            />
                    </v-flex>
                </v-layout>
            </v-form>
            <small>*Indica os campos que são obrigatórios</small>
        </v-card-text>
        <v-card-actions class="pt-0">
            <v-spacer></v-spacer>
            <v-btn color="green" flat="flat" @click.native="save">Salvar
                <v-icon right dark>check</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
    export default {
        name: "parametros-triagem-form",
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
                parametrosTriagem: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                validations: {
                    errormessages: "errors.collect('renda')",
                    datavvname: "renda"
                },
                ajudaRenda: {
                    msg: "Utilizado para validar se a renda do cliente está dentro do requerido pelo EMAJ"
                },
            };
        },
        watch: {
            value: {
                handler() {
                    this.parametrosTriagem = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        created() {
            this.$store.dispatch("getParametrosTriagem").then(() => {
                this.parametrosTriagem = Object.assign({}, this.$store.state.parametrostriagem.parametrosTriagemView);
            }).catch((resp) => {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
            });

        },
        methods: {
            save() {
                let isValidForm = true;
                this.$refs.moneyRenda.required = true;
                this.$validator.validateAll().then(valid => {
                    isValidForm = valid;
                    this.$refs.moneyRenda.$validator.validate('renda')
                            .then(isValidRenda => {

                                if (!isValidForm || !isValidRenda)
                                    return;

                                this.$store
                                        .dispatch("saveParametrosTriagem", this.parametrosTriagem)
                                        .then((resp) => {
                                            this.parametrosTriagem = resp.data;
                                            this.$store.state.parametrostriagem.parametrosTriagemView = this.parametrosTriagem;
                                            window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                        }).catch((resp) => {
                                    this.addErrors(resp);
                                });
                            });
                });
            },
            addErrors(resp) {
                window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                if (resp.response.data.errors.renda) {
                    this.$validator.errors.add({field: 'renda', msg: resp.response.data.errors.renda});
                }
            }
        }
    };
</script>