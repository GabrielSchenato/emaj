<template>
    <div>
        <div @click="launchFilePicker()">
            <slot name="activator"></slot>
        </div>
        <input type="file"
               ref="file"
               :name="uploadFieldName"
               @change="onFileChange(
               $event.target.name, $event.target.files)"
               style="display:none">
        <v-dialog v-model="errorDialog" max-width="450">
            <v-card>
                <v-card-text class="subheading">{{errorText}}</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="errorDialog = false" flat>Voltar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        name: 'image-input',
        props: {
            value: {
                type: [Object]
            }
        },
        data() {
            return {
                imageInput: Object.assign({}, this.value),
                errorDialog: null,
                errorText: '',
                uploadFieldName: 'file',
                maxSize: 1024
            };
        },
        watch: {
            value: {
                handler() {
                    this.imageInput = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        methods: {
            launchFilePicker() {
                this.$refs.file.click();
            },
            onFileChange(fieldName, file) {
                const {maxSize} = this;
                let imageFile = file[0];
                if (file.length > 0) {
                    let size = imageFile.size / maxSize / maxSize;
                    if (!imageFile.type.match('image.*')) {
                        this.errorDialog = true;
                        this.errorText = 'Por favor, escolha um arquivo tipo imagem';
                    } else if (size > 1) {
                        this.errorDialog = true;
                        this.errorText = 'A imagem que você escolheu é muito grande! Por favor selecione uma imagem menor que 1MB';
                    } else {
                        this.imageInput.imageURL = URL.createObjectURL(imageFile);
                        this.imageInput.imageFile = imageFile;
                        this.$emit('input', this.imageInput);
                    }
                }
            }
        }
    }
</script>