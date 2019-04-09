<template>
  <div>
    <!-- slot for parent component to activate the file changer -->
    <div @click="launchFilePicker()">
      <slot name="activator"></slot>
    </div>
    <!-- image input: style is set to hidden and assigned a ref so that it can be triggered -->
    <input type="file"
       ref="file"
       :name="uploadFieldName"
       @change="onFileChange(
          $event.target.name, $event.target.files)"
       style="display:none">
    <!-- error dialog displays any potential error messages -->
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
    data: ()=> ({
      errorDialog: null,
      errorText: '',
      uploadFieldName: 'file',
      maxSize: 1024
    }),
    props: {
    // Use "value" to enable using v-model
      value: Object,
    },
    methods: {
      launchFilePicker(){
        this.$refs.file.click();
      },
      onFileChange(fieldName, file) {
        const { maxSize } = this
        let imageFile = file[0]
        if (file.length>0) {
          let size = imageFile.size / maxSize / maxSize
          if (!imageFile.type.match('image.*')) {
            // check whether the upload is an image
            this.errorDialog = true
            this.errorText = 'Por favor, escolha um arquivo tipo imagem'
          } else if (size>1) {
            // check whether the size is greater than the size limit
            this.errorDialog = true
            this.errorText = 'A imagem que você escolheu é muito grande! Por favor selecione uma imagem menor que 1MB'
          } else {
            let imageURL = URL.createObjectURL(imageFile)
            // Emit the FormData and image URL to the parent component
            this.$emit('input', { imageFile, imageURL })
          }
        }
      }
    }
  }
</script>