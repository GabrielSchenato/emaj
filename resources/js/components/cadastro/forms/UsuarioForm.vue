<template>
    <v-form>
        <v-layout wrap>

            <v-flex xs10 offset-xs5>
                <image-input v-model="usuario.avatar">
                    <div slot="activator">
                        <v-avatar size="150px" v-ripple v-if="usuario.avatar && getAvatar" class="mb-3">
                            <img :src="getAvatar" alt="avatar">
                        </v-avatar>
                        <v-avatar size="150px" v-ripple v-else-if="!avatar" class="grey lighten-3 mb-3">
                            <span>Click para adicionar um avatar</span>
                        </v-avatar>
                        <v-avatar size="150px" v-ripple v-else class="mb-3">
                            <img :src="usuario.avatar.imageURL" alt="avatar">
                        </v-avatar>
                    </div>
                </image-input>
            </v-flex>

            <v-flex xs12 sm6 md2>
                <v-text-field
                    name="id"
                    id="id"
                    v-model="usuario.id"
                    label="ID"
                    disabled
                    @input="$emit('input', usuario)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="nome_completo"
                    id="nome_completo"
                    v-model="usuario.nome_completo"
                    label="Nome Completo*"
                    v-validate="'required'"
                    :error-messages="errors.collect('nome completo')"
                    data-vv-name="nome completo"
                    required
                    @input="$emit('input', usuario)"
                    ></v-text-field>
            </v-flex>


            <v-flex xs12 sm6 md6>
                <v-text-field
                    name="email"
                    id="email"
                    v-model="usuario.email"
                    label="E-mail*"
                    v-validate="'required'"
                    :error-messages="errors.collect('e-mail')"
                    data-vv-name="e-mail"
                    required
                    @input="$emit('input', usuario)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="telefone"
                    id="telefone"
                    v-model="usuario.telefone"
                    label="Telefone*"
                    v-validate="'required'"
                    :error-messages="errors.collect('telefone')"
                    data-vv-name="telefone"
                    required
                    @input="$emit('input', usuario)"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-select
                    name="role"
                    id="role"
                    :items="roles"
                    label="Nível de Permissão*"
                    v-model="usuario.role"
                    v-validate="'required'"
                    :error-messages="errors.collect('nível de permissão')"
                    data-vv-name="nível de permissão"
                    required
                    @input="$emit('input', usuario)"
                    item-value="id"
                    item-text="nome"
                    :disabled="$auth.user().role == 'secretaria' && usuario.role == 'admin'"
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="password"
                    id="password"
                    v-model="usuario.password"
                    :label="'Senha' + getConfig.asterisco"
                    v-validate="{required: getConfig.required }"
                    :error-messages="errors.collect('senha')"
                    data-vv-name="senha"
                    required
                    @input="$emit('input', usuario)"
                    type="password"
                    :append-icon="show1 ? 'visibility' : 'visibility_off'"
                    :append-outer-icon="'cached'"
                    :type="show1 ? 'text' : 'password'"
                    counter
                    hint="Ao menos 6 caracteres"
                    @click:append="show1 = !show1"
                    @click:append-outer="randPassword(0,0,6)"
                    ></v-text-field>
            </v-flex>


            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="password_confirmation"
                    id="password_confirmation"
                    v-model="usuario.password_confirmation"
                    :label="'Confirmar Senha' + getConfig.asterisco"
                    v-validate="{required: getConfig.required }"
                    :error-messages="errors.collect('confirmar senha')"
                    data-vv-name="confirmar senha"
                    required
                    @input="$emit('input', usuario)"
                    type="password"
                    :append-icon="show2 ? 'visibility' : 'visibility_off'"
                    :type="show2 ? 'text' : 'password'"
                    counter
                    hint="Ao menos 6 caracteres"
                    @click:append="show2 = !show2"
                    ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 md1>
                <v-checkbox
                    name="ativo"
                    id="ativo"
                    v-model="usuario.ativo"
                    label="Ativo?"
                    @change="$emit('input', usuario)"
                    ></v-checkbox>
            </v-flex>

        </v-layout>
    </v-form>
</template>
<script>
    import ImageInput from "@/components/ImageInput.vue";
    export default {
        name: "usuario-form",
        components: {
            ImageInput: ImageInput
        },
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
                show1: false,
                show2: false,
                usuario: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                avatar: null,
                roles: [{
                        id: 'admin',
                        nome: 'Administrador',
                        disabled: this.$auth.ready() && this.$auth.user().role != 'admin'
                    },
                    {

                        id: 'secretaria',
                        nome: 'Secretária'

                    }, {

                        id: 'aluno',
                        nome: 'Aluno'
                    }]
            };
        },
        watch: {
            value: {
                handler() {
                    this.usuario = Object.assign({}, this.value);
                },
                deep: true
            }
        },
        computed: {
            getAvatar() {
                if (this.usuario.avatar.imageURL)
                    return this.usuario.avatar.imageURL;
                if (this.usuario.avatar.avatar && this.usuario.avatar)
                    return 'data:image/jpeg;base64,' + this.usuario.avatar.avatar;
                return null;
            },
            getConfig() {
                return {
                    required: this.usuario.id ? false : true,
                    asterisco: this.usuario.id ? '' : '*'
                };
            }
        },
        methods: {
            randPassword(letters, numbers, either) {
                var chars = [
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", // letters
                    "0123456789", // numbers
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789" // either
                ];

                let password = [letters, numbers, either].map(function (len, i) {
                    return Array(len).fill(chars[i]).map(function (x) {
                        return x[Math.floor(Math.random() * x.length)];
                    }).join('');
                }).concat().join('').split('').sort(function () {
                    return 0.5 - Math.random();
                }).join('');

                this.usuario.password = password;
                this.usuario.password_confirmation = password;
                this.$emit('input', this.usuario);
            }
        }
    };
</script>