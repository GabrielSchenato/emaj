<template>
    <div>
        <v-text-field
            v-model="modValue"
            v-bind:label="label"
            v-bind:name="name"
            v-bind:id="id"
            v-bind:placeholder="placeholder"
            v-bind:prepend-inner-icon="prependInnerIcon"
            v-bind:flat="flat"
            v-bind:clearable="clearable"
            v-bind:solo="solo"             
            v-bind:hide-details="hideDetails"
            v-validate="{required: required }"
            :error-messages="errors.collect(validations ? validations.datavvname : 'valor')"
            :data-vv-name="validations ? validations.datavvname : 'valor'"
            v-bind:value="compValue"
            v-on:keypress="onlyNumber"
            v-on:keyup="emit"
            v-on:change="emit"
            >

            <template v-slot:prepend v-if="ajudaRenda != null">
                <v-tooltip bottom light color="success">
                    <template v-slot:activator="{ on }">
                        <v-icon v-on="on">not_listed_location</v-icon>
                    </template>{{ ajudaRenda.msg }}
                </v-tooltip>
            </template>

        </v-text-field>
    </div>
</template>

<script>
    export default {
        model: {prop: "value", event: "input"},
        $_veeValidate: {
            validator: "new"
        },
        props: {
            value: {
                type: [Number, String]
            },
            label: {
                type: String,
                default: ""
            },
            name: {
                type: String,
                default: ""
            },
            id: {
                type: String,
                default: ""
            },
            placeholder: {
                type: String,
                default: ""
            },
            prependInnerIcon: {
                type: String,
                default: ""
            },
            flat: {
                type: Boolean,
                default: false
            },
            clearable: {
                type: Boolean,
                default: false
            },
            solo: {
                type: Boolean,
                default: false
            },
            hideDetails: {
                type: Boolean,
                default: false
            },
            validations: {
                type: Object
            },
            ajudaRenda: {
                type: Object
            },
            options: {
                type: Object,
                default: function () {
                    return {locale: "pt-BR", prefix: "R$", precision: 2};
                }
            }
        },
        data: () => ({
                modValue: "",
                required: false
            }),
        computed: {
            /* Lógica:
             compValue é o ponto de parada
             O valor entra pelo prop e pára aqui, formatado.
             Ao digitar no v-text-field o valor é manipulado para NNNNNN.NN, emitido para o componente pai e retorna pelo prop, parando novamente aqui, formatado.
             */
            compValue() {
                const value = this.value ? this.value.toString() : '';
                return (this.modValue = this.humanFormat(this.machineFormat(value)));
            }
        },
        methods: {
            onlyNumber($event) {
                // console.log($event.keyCode); //keyCodes value
                let keyCode = $event.keyCode ? $event.keyCode : $event.which;
                if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
                    // 46 is dot
                    $event.preventDefault();
                }
            },
            emit() {
                this.$emit("input", this.machineFormat(this.modValue));
            },
            /* Formatar no padrão NNNNNN.NN */
            machineFormat(number) {
                if (number) {
                    // Retirar prefixo
                    if (number.includes(" ")) {
                        number = number.split(" ")[1];
                    }
                    // Retirar pontos e virgulas
                    number = number
                            .replace(new RegExp(/[.]/, "g"), "")
                            .replace(new RegExp(",", "g"), "");
                    // Ajustar quantidade de zeros à esquerda
                    number = number.padStart(parseInt(this.options.precision) + 1, "0");
                    // Incluir ponto na casa correta, conforme a precisão configurada
                    number =
                            number.substring(0, number.length - parseInt(this.options.precision)) +
                            "." +
                            number.substring(
                                    number.length - parseInt(this.options.precision),
                                    number.length
                                    );
                    if (isNaN(number)) {
                        number = "";
                    }
                } else {
                    number = "";
                }
                return number;
            },
            humanFormat: function (number) {
                if (isNaN(number)) {
                    number = "";
                }
                if (number == '') {
                    return;
                } else {
                    // number = Number(number).toLocaleString(this.options.locale, {maximumFractionDigits: 2, minimumFractionDigits: 2, style: 'currency', currency: 'BRL'});
                    number = Number(number).toLocaleString(this.options.locale, {
                        maximumFractionDigits: this.options.precision,
                        minimumFractionDigits: this.options.precision
                    });
                }
                return this.options.prefix + " " + number;
            }
        }
    };
</script>

