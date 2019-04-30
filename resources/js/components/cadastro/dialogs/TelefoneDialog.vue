<template>
    <v-dialog
        v-model="dialog"
        :max-width="options.width"
        @keydown.esc="cancel"
        v-bind:style="{ zIndex: options.zIndex }"
        >
        <v-card>
            <v-toolbar dark :color="options.color" dense flat>
                       <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <telefone-form ref="telefoneForm" v-model="telefone"></telefone-form>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions class="pt-0">
                <v-spacer></v-spacer>
                <v-btn color="green" flat="flat" @click.native="telefoneContinue">
                    {{ buttonTitle }}
                    <v-icon right dark>control_point</v-icon>
                </v-btn>
                <v-btn color="red" flat="flat" @click.native="cancel">
                    Cancelar
                    <v-icon right dark>cancel</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import TelefoneForm from "@/components/cadastro/forms/TelefoneForm.vue";

    export default {
        components: {
            TelefoneForm
        },
        data: () => ({
                telefone: {},
                dialog: false,
                resolve: null,
                reject: null,
                formTitle: null,
                buttonTitle: null,
                options: {
                    color: "primary",
                    width: 1000,
                    zIndex: 1000
                }
            }),
        methods: {
            getValues() {
                return this.telefone;
            },
            open(title, item, options) {
                this.dialog = true;
                this.formTitle = title;
                this.telefone = Object.assign({}, item);
                this.buttonTitle = this.telefone.id ? "Atualizar" : "Inserir";
                this.options = Object.assign(this.options, options);
                return new Promise((resolve, reject) => {
                    this.resolve = resolve;
                    this.reject = reject;
                });
            },
            telefoneContinue() {
                this.$refs.telefoneForm.$validator.validateAll().then(valid => {
                    if (valid) {
                        this.resolve(true);
                        this.dialog = false;
                    }
                });
            },
            cancel() {
                this.telefone = {};
                this.$refs.telefoneForm.$validator.errors.clear();
                this.resolve(false);
                this.dialog = false;
            }
        }
    };
</script>