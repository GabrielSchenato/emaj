<template>
    <v-form>
        <v-flex xs12>
            <v-alert type="warning" :value="naoLocalizado">CEP não encontrado, tente novamente!</v-alert>
        </v-flex>

        <v-layout wrap>
            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="id"
                    v-model="endereco.id"
                    label="ID"
                    disabled
                    @input="$emit('input', endereco)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="cep"
                    v-model="endereco.cep"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('CEP')"
                    data-vv-name="CEP"
                    mask="#####-###"
                    return-masked-value
                    @keyup="buscar"
                    @input="$emit('input', endereco)"
                    :disabled="buscandoCep"
                    >
                    <template v-slot:label>
                        CEP<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="logradouro"
                    v-model="endereco.logradouro"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Logradouro')"
                    data-vv-name="Logradouro"
                    @change="$emit('input', endereco)"
                    >
                    <template v-slot:label>
                        Logradouro<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="complemento"
                    v-model="endereco.complemento"
                    label="Complemento"
                    data-vv-name="complemento"
                    @change="$emit('input', endereco)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="bairro"
                    v-model="endereco.bairro"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Bairro')"
                    data-vv-name="Bairro"
                    @change="$emit('input', endereco)"
                    >
                    <template v-slot:label>
                        Bairro<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="numero"
                    ref="numero"
                    v-model="endereco.numero"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Número')"
                    data-vv-name="Número"
                    type="number"
                    @change="$emit('input', endereco)"
                    >
                    <template v-slot:label>
                        Número<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="localidade"
                    v-model="endereco.localidade"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Cidade')"
                    data-vv-name="Cidade"
                    @change="$emit('input', endereco)"
                    >
                    <template v-slot:label>
                        Cidade<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-text-field
                    name="uf"
                    v-model="endereco.uf"
                    v-validate="{required: this.getConfig().required }"
                    :error-messages="errors.collect('Estado')"
                    data-vv-name="Estado"
                    mask="AA"
                    @change="$emit('input', endereco)"
                    >
                    <template v-slot:label>
                        Estado<span class="required" v-if="getConfig().required">*</span>
                    </template>
                </v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md5>
                <v-text-field
                    name="endereco_local_trabalho"
                    v-model="endereco.endereco_local_trabalho"
                    label="Endereço do Local de Trabalho"
                    @input="$emit('input', endereco)"
                    ></v-text-field>
            </v-flex>
        </v-layout>
    </v-form>
</template>
<script>
    export default {
        name: "endereco-form",
        props: {
            value: {
                type: [Object]
            },
            getConfig: {type: Function}
        },
        data() {
            return {
                endereco: Object.assign({}, this.value),
                naoLocalizado: false,
                buscandoCep: false
            };
        },
        watch: {
            value: {
                handler() {
                    this.endereco = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            buscar: function () {
                if (/^[0-9]{5}-[0-9]{3}$/.test(this.endereco.cep)) {
                    var self = this;
                    self.naoLocalizado = false;
                    self.buscandoCep = true;

                    $.getJSON(
                            "https://viacep.com.br/ws/" + this.endereco.cep + "/json/",
                            function (endereco) {
                                if (endereco.erro) {
                                    self.naoLocalizado = true;
                                    self.buscandoCep = false;
                                    return;
                                }
                                self.$refs.numero.focus();
                                if (self.endereco.id) {
                                    endereco.id = self.endereco.id;
                                }
                                self.endereco = _.mapValues(endereco, function (s) {
                                    return _.isString(s) ? s.toUpperCase() : s;
                                });
                            }
                    );
                    self.buscandoCep = false;
                }
            }
        }
    };
</script>