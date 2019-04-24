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
                            id="id"
                            v-model="parametrosTriagem.id"
                            label="ID"
                            disabled
                            @input="$emit('input', parametrosTriagem)"
                            ></v-text-field>
                    </v-flex>     
                    <v-flex xs12 sm6 md4>
                        <v-text-field
                            name="renda"
                            id="renda"
                            v-model="parametrosTriagem.renda"
                            v-validate="'required'"
                            :error-messages="errors.collect('renda')"
                            label="Renda*"
                            data-vv-name="renda"
                            required
                            type="number"
                            @input="$emit('input', parametrosTriagem)"
                            >
                            <template v-slot:prepend>
                                <v-tooltip bottom light color="success">
                                    <template v-slot:activator="{ on }">
                                        <v-icon v-on="on">not_listed_location</v-icon>
                                    </template>Utilizado para validar se a renda do cliente está dentro do requerido pelo EMAJ
                                </v-tooltip>
                            </template>
                        </v-text-field>
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
                parametrosTriagem: Object.assign({}, this.value) //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
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
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.$store
                                .dispatch("saveParametrosTriagem", this.parametrosTriagem)
                                .then(() => {
                                    this.$store.dispatch("getParametrosTriagem").then(() => {
                                        this.parametrosTriagem = this.$store.state.parametrostriagem.parametrosTriagemView;
                                    }).catch((resp) => {
                                        window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro.', timeout: 2000});
                                    });
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Dados salvo com sucesso!', timeout: 2000});
                                }).catch((resp) => {
                            this.addErrors(resp);
                        });


                    }
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