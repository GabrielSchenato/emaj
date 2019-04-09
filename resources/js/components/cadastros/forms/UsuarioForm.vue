<template>
    <v-form>
        <v-layout wrap>

            <v-flex xs10 offset-xs5>
                <image-input v-model="usuario.avatar">
                    <div slot="activator">
                        <v-avatar size="150px" v-ripple v-if="usuario.avatar" class="mb-3">
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
                    ></v-select>
            </v-flex>

            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="password"
                    id="password"
                    v-model="usuario.password"
                    label="Senha*"
                    v-validate="'required'"
                    :error-messages="errors.collect('senha')"
                    data-vv-name="senha"
                    required
                    @input="$emit('input', usuario)"
                    type="password"
                    ></v-text-field>
            </v-flex>


            <v-flex xs12 sm6 md4>
                <v-text-field
                    name="password_confirmation"
                    id="password_confirmation"
                    v-model="usuario.password_confirmation"
                    label="Confirmar Senha*"
                    v-validate="'required'"
                    :error-messages="errors.collect('confirmar senha')"
                    data-vv-name="confirmar senha"
                    required
                    @input="$emit('input', usuario)"
                    type="password"
                    ></v-text-field>
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
                usuario: Object.assign({}, this.value), //object.assign only works for shallow objects. for nested objects, use something like _.cloneDeep
                avatar: null,
                roles: [{
                        id: 'admin',
                        nome: 'Administrador'
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
                
                return 'data:image/jpeg;base64,' + this.usuario.avatar.avatar;
            }
        },
        methods: {
        }
    };
</script>