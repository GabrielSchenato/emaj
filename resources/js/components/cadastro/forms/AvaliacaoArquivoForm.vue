<template>
    <div>
        <input
            ref="input"
            type="file"
            multiple
            @change="uploadFieldChange"
            style="display:none">
        <confirm ref="confirm"></confirm>
        <!-- error dialog displays any potential error messages -->
        <v-dialog v-model="errorDialog" max-width="450">
            <v-card>
                <v-card-text class="subheading">
                    O tamanho do(s) seguinte(s) arquivo(s) que você escolheu é muito grande! Por favor selecione arquivo(s) de no máximo 10MB.
                </v-card-text>
                <v-list two-line>
                    <template v-for="errorFile in errorFiles">
                        <v-list-tile avatar v-bind:key="errorFile.id" @click="">
                            <v-list-tile-avatar>
                                <v-icon v-if="getIcon(errorFile.mimetype)" :color="getIcon(errorFile.mimetype).color">
                                    {{ getIcon(errorFile.mimetype).name }}
                                </v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title v-html="errorFile.nome"></v-list-tile-title>
                                <v-list-tile-sub-title>
                                    {{ errorFile.tamanho_arquivo }} MB
                                </v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </template>
                </v-list>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="errorDialog = false; errorFiles = []" flat>Voltar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>      


        <v-dialog
            v-model="preview"
            transition="dialog-bottom-transition"
            fullscreen
            scrollable
            hide-overlay>
            <v-card v-if="attachmentPreview !== null">
                <v-toolbar
                    dark
                    color="primary">
                    <v-btn
                        icon
                        dark
                        @click="closePreview">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Você está visualizando o anexo {{ attachmentPreview.nome }}</v-toolbar-title>
                </v-toolbar>

                <template>
                    <object
                        class="view-pdf"
                        :type="attachmentPreview.mimetype"
                        :data="attachmentPreview.data"
                        ></object>

                </template>

            </v-card>
        </v-dialog>


        <!-- File uploader -->
        <v-layout wrap justify-center>
            <v-card>
                <v-list two-line>
                    <template v-for="file in arquivos">
                        <v-list-tile avatar v-bind:key="file.id" @click="">
                            <v-list-tile-avatar>
                                <v-icon v-if="getIcon(file.mimetype)" :color="getIcon(file.mimetype).color">
                                    {{ getIcon(file.mimetype).name }}
                                </v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title v-html="file.nome"></v-list-tile-title>
                                <v-list-tile-sub-title>
                                    {{ file.tamanho_arquivo }}
                                </v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-btn icon @click="previewAttachment(file)" left v-if="canPreview(file.mimetype)">
                                <v-icon color="blue">mdi-eye</v-icon>
                            </v-btn>
                            <v-btn icon @click="downloadAttachment(file)" left>
                                <v-icon>cloud_download</v-icon>
                            </v-btn>
                            <v-btn icon @click="deleteAttachment(file)" left>
                                <v-icon color="red">close</v-icon>
                            </v-btn>
                        </v-list-tile>
                    </template>
                </v-list>
            </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import Confirm from "@/components/dialogs/Confirm.vue";
    export default {
        components: {
            Confirm
        },
        props: {
            idAvaliacao: {
                accept: Number,
                required: true
            },
            arquivos: {
                type: [Array]
            }
        },
        data() {
            return {
                attachments: [],
                data: new FormData(),
                errorDialog: null,
                errorFiles: [],
                maxSize: 10,
                percentCompleted: 0,
                preview: false,
                attachmentPreview: null
            };
        },
        methods: {
            abreTelaAdicionarArquivo() {
                this.$refs.input.click();
            },
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    if (this.isValidateAttachment(files[i], i)) {
                        this.attachments.push(files[i]);
                    }
                }
                this.$refs.input.value = [];
                if (this.errorFiles.length > 0) {
                    this.errorDialog = true;
                    return;
                }
                this.submit();
            },

            submit() {
                this.prepareFields();
                var config = {
                    headers: {'Content-Type': 'multipart/form-data'},
                    onUploadProgress: function (progressEvent) {
                        this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        this.$forceUpdate();
                    }.bind(this)
                };
                axios.post('avaliacaoarquivos', this.data, config)
                        .then((response) => {
                            window.getApp.$emit("APP_SUCCESS", {msg: 'Anexo(s) enviado com sucesso!', timeout: 4500});
                            for (var i = 0; i < response.data.length; i++) {
                                this.arquivos.push(response.data[i]);
                            }
                            this.resetData();
                        }).catch((resp) => {
                    let msgErro = '';
                    if (resp.response.data.errors)
                        msgErro = resp.response.data.errors;
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                });
            },
            deleteAttachment(file) {
                this.$refs.confirm
                        .open("Deletar " + file.nome, "Você tem certeza que deseja deletar esse Anexo?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                axios.delete(`avaliacaoarquivos/${file.id}`)
                                        .then(() => {
                                            window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                            let index = this.arquivos.indexOf(file);
                                            this.arquivos.splice(index, 1);
                                        }).catch((resp) => {
                                    let msgErro = '';
                                    if (resp.response.data.errors)
                                        msgErro = resp.response.data.errors;
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                                });
                            }
                        });
            },
            downloadAttachment(file) {
                axios({
                    method: 'get',
                    url: `avaliacaoarquivos/download/${file.id}`,
                    responseType: 'blob'})
                        .then(response => {
                            const blob = new Blob([response.data], {
                                type: response.headers["content-type"]
                            });
                            const url = window.URL.createObjectURL(blob);
                            const link = document.createElement("a");
                            link.href = url;
                            const contentDisposition =
                                    response.headers["content-disposition"];
                            let fileName = "erro";
                            if (contentDisposition) {
                                fileName = decodeURIComponent(this.getFileNameFromHttpResponse(
                                        contentDisposition
                                        ));
                            }
                            link.setAttribute("download", fileName);
                            document.body.appendChild(link);
                            link.click();
                            link.remove();
                            window.URL.revokeObjectURL(url);
                        });
            },
            previewAttachment(file) {
                axios({
                    method: 'get',
                    url: `avaliacaoarquivos/${file.id}`})
                        .then(response => {
                            const blob = this.base64toBlob(response.data.arquivo, response.data.mimetype);
                            this.preview = true;
                            this.attachmentPreview = {
                                nome: file.nome,
                                mimetype: file.mimetype,
                                data: window.URL.createObjectURL(blob)
                            };
                        });
            },
            closePreview(){
                this.preview = false;
                this.attachmentPreview = null;
            },
            getFileNameFromHttpResponse(contentDisposition) {
                var result = contentDisposition
                        .split(";")[1]
                        .trim()
                        .split("=")[1];
                return result.replace(/"/g, "");
            },
            getIcon(type) {
                switch (this.checkIsImage(type)) {
                    case 'application/pdf':
                        return {name: 'mdi-file-pdf', color: 'red lighten-2'};
                    case 'application/msword':
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.template':
                    case 'application/vnd.ms-word.document.macroEnabled.12':
                    case 'application/vnd.ms-word.template.macroEnabled.12':
                        return {name: 'mdi-file-word', color: 'blue'};
                    case 'application/vnd.ms-excel':
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.template':
                    case 'application/vnd.ms-excel.sheet.macroEnabled.12':
                    case 'application/vnd.ms-excel.template.macroEnabled.12':
                    case 'application/vnd.ms-excel.addin.macroEnabled.12':
                    case 'application/vnd.ms-excel.sheet.binary.macroEnabled.12':
                        return {name: 'mdi-file-excel', color: 'green'};
                    case 'application/vnd.ms-powerpoint':
                    case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                    case 'application/vnd.openxmlformats-officedocument.presentationml.template':
                    case 'application/vnd.openxmlformats-officedocument.presentationml.slideshow':
                    case 'application/vnd.ms-powerpoint.addin.macroEnabled.12':
                    case 'application/vnd.ms-powerpoint.presentation.macroEnabled.12':
                    case 'application/vnd.ms-powerpoint.template.macroEnabled.12':
                    case 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12':
                        return {name: 'mdi-file-powerpoint', color: 'yellow darken-3'};
                    case 'image/*':
                        return {name: 'mdi-file-image', color: 'grey darken-1'};
                    case 'text/plain':
                        return {name: 'mdi-file-document', color: 'grey'};
                    default:
                        return {name: 'mdi-file', color: 'grey darken-4'};
                }
            },
            resetData() {
                this.data = new FormData();
                this.attachments = [];
            },
            checkIsImage(type) {
                if (type.match('image.*')) {
                    return 'image/*';
                }
                return type;
            },
            checkIsPdf(type) {
                if (type.match('application/pdf')) {
                    return true;
                }
                return false;
            },
            checkIsPlainText(type) {
                if (type.match('text/plain')) {
                    return true;
                }
                return false;
            },
            canPreview(type){
                if(this.checkIsImage(type) == 'image/*' || this.checkIsPdf(type)
                        || this.checkIsPlainText(type))
                    return true;
                return false;
            },
            prepareFields() {
                if (this.attachments.length > 0) {
                    for (var i = 0; i < this.attachments.length; i++) {
                        let attachment = this.attachments[i];
                        this.data.append('attachments[]', attachment);
                    }
                    this.data.append('avaliacao_id', this.$props.idAvaliacao);
                }
            },
            isValidateAttachment(file, index) {
                const {maxSize} = this;
                let size = file.size / 1024 / 1024;
                if (size > maxSize) {
                    this.errorFiles.push({
                        id: index,
                        nome: file.name,
                        mimetype: file.type,
                        tamanho_arquivo: Number((file.size / 1024 / 1024).toFixed(1))
                    });
                    return false;
                }
                return true;
            },
            base64toBlob(base64Data, contentType) {
                contentType = contentType || '';
                var sliceSize = 1024;
                var byteCharacters = atob(base64Data);
                var bytesLength = byteCharacters.length;
                var slicesCount = Math.ceil(bytesLength / sliceSize);
                var byteArrays = new Array(slicesCount);

                for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
                    var begin = sliceIndex * sliceSize;
                    var end = Math.min(begin + sliceSize, bytesLength);

                    var bytes = new Array(end - begin);
                    for (var offset = begin, i = 0; offset < end; ++i, ++offset) {
                        bytes[i] = byteCharacters[offset].charCodeAt(0);
                    }
                    byteArrays[sliceIndex] = new Uint8Array(bytes);
                }
                return new Blob(byteArrays, {type: contentType});
            }
        }
    }
</script>
<style scoped>
    i.v-icon.material-icons.theme--light.red--text:hover {
        color: #FFFFFFFF!important;
    }
    .v-list__tile--link:hover .v-icon{
        color: #FFFFFFFF!important;
    }
    .view-pdf {
        width: 100%;
        height: 100%;
    }
</style>