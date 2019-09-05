<template>
    <div>
        <v-text-field
            v-model="modValue"
            v-bind:name="options.field"
            v-bind:placeholder="options.placeholder"
            v-bind:prepend-inner-icon="options.prependInnerIcon"
            v-bind:flat="options.flat"
            v-bind:clearable="options.clearable"
            v-bind:solo="options.solo"             
            v-bind:hide-details="options.hideDetails"
            v-bind:error-messages="errorMessages"
            v-bind:value="compValue"
            v-on:keypress="onlyNumber"
            v-on:keyup="emit"
            v-on:change="emit"
            >

            <template v-slot:prepend v-if="options.help != null">
                <v-tooltip bottom light color="success">
                    <template v-slot:activator="{ on }">
                        <v-icon v-on="on">not_listed_location</v-icon>
                    </template>{{ options.help }}
                </v-tooltip>
            </template>

            <template v-slot:label>
                {{ options.name }}<span class="required" v-if="options.required">*</span>
            </template>

        </v-text-field>
    </div>
</template>

<script>
    export default {
        model: {prop: "value", event: "input"},
        props: {
            value: {
                type: [Number, String]
            },
            errorMessages: {
                type: Array
            },
            options: {
                type: [Object]
            },
            configurations: {
                type: Object,
                default: function () {
                    return {locale: "pt-BR", prefix: "R$", precision: 2};
                }
            }
        },
        data: () => ({
                modValue: ""
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
                    number = number.padStart(parseInt(this.configurations.precision) + 1, "0");
                    // Incluir ponto na casa correta, conforme a precisão configurada
                    number =
                            number.substring(0, number.length - parseInt(this.configurations.precision)) +
                            "." +
                            number.substring(
                                    number.length - parseInt(this.configurations.precision),
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
                    number = Number(number).toLocaleString(this.configurations.locale, {
                        maximumFractionDigits: this.configurations.precision,
                        minimumFractionDigits: this.configurations.precision
                    });
                }
                return this.configurations.prefix + " " + number;
            }
        }
    };
</script>

