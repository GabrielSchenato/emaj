<template>
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
                v-model="usuario.id"
                label="ID"
                disabled
                @input="$emit('input', usuario)"
                ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md4>
            <v-text-field
                name="nome_completo"
                v-model="usuario.nome_completo"
                v-validate="'required'"
                :error-messages="errors.collect('Nome Completo')"
                data-vv-name="Nome Completo"
                @input="$emit('input', usuario)"
                >
                <template v-slot:label>
                    Nome Completo<span class="required">*</span>
                </template>
            </v-text-field>
        </v-flex>


        <v-flex xs12 sm6 md6>
            <v-text-field
                name="email"
                v-model="usuario.email"
                v-validate="'required'"
                :error-messages="errors.collect('E-mail')"
                data-vv-name="E-mail"
                @input="$emit('input', usuario)"
                >
                <template v-slot:label>
                    E-mail<span class="required">*</span>
                </template> 
            </v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md4>
            <v-text-field
                name="telefone"
                v-model="usuario.telefone"
                v-validate="'required'"
                :error-messages="errors.collect('Telefone')"
                data-vv-name="Telefone"
                mask="(##) #####-####"
                return-masked-value
                @input="$emit('input', usuario)"
                >
                <template v-slot:label>
                    Telefone<span class="required">*</span>
                </template> 
            </v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md4>
            <v-select
                name="role"
                :items="roles"
                v-model="usuario.role"
                v-validate="'required'"
                :error-messages="errors.collect('Nível de Permissão')"
                data-vv-name="Nível de Permissão"
                @input="$emit('input', usuario)"
                item-value="id"
                item-text="nome"
                :disabled="$auth.user().role == 'secretaria' && usuario.role == 'admin'"
                clearable
                >
                <template v-slot:label>
                    Nível de Permissão<span class="required">*</span>
                </template> 
            </v-select>
        </v-flex>

        <v-flex xs12 sm6 md4>
            <v-text-field
                name="password"
                v-model="usuario.password"
                v-validate="{required: getConfig.required }"
                :error-messages="errors.collect('Senha')"
                data-vv-name="Senha"
                @input="$emit('input', usuario)"
                type="password"
                :append-icon="show1 ? 'visibility' : 'visibility_off'"
                :append-outer-icon="'cached'"
                :type="show1 ? 'text' : 'password'"
                counter
                hint="Ao menos 6 caracteres"
                @click:append="show1 = !show1"
                @click:append-outer="randPassword(0,0,6)"
                >
                <template v-slot:label>
                    Senha<span class="required" v-if="getConfig.required">*</span>
                </template> 
            </v-text-field>
        </v-flex>


        <v-flex xs12 sm6 md4>
            <v-text-field
                name="password_confirmation"
                v-model="usuario.password_confirmation"
                v-validate="{required: getConfig.required }"
                :error-messages="errors.collect('Confirmar Senha')"
                data-vv-name="Confirmar Senha"
                @input="$emit('input', usuario)"
                type="password"
                :append-icon="show2 ? 'visibility' : 'visibility_off'"
                :type="show2 ? 'text' : 'password'"
                counter
                hint="Ao menos 6 caracteres"
                @click:append="show2 = !show2"
                >
                <template v-slot:label>
                    Confirmar Senha<span class="required" v-if="getConfig.required">*</span>
                </template> 
            </v-text-field>
        </v-flex>

        <v-flex xs12 sm6 md2>
            <v-checkbox
                name="professor"
                v-model="usuario.professor"
                label="Professor?"
                @change="$emit('input', usuario)"
                ></v-checkbox>
        </v-flex>

        <v-flex xs12 sm6 md1>
            <v-checkbox
                name="ativo"
                v-model="usuario.ativo"
                label="Ativo?"
                @change="$emit('input', usuario)"
                ></v-checkbox>
        </v-flex>

    </v-layout>
</template>
<script>
    import ImageInput from "@/components/ImageInput.vue";
    export default {
        name: "usuario-form",
        components: {
            ImageInput: ImageInput
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
                usuario: Object.assign({}, this.value),
                avatar: null,
                roles: [{
                        id: 'admin',
                        nome: 'Administrador',
                        disabled: this.$auth.ready() && this.$auth.user().role != 'admin'
                    },
                    {

                        id: 'secretaria',
                        nome: 'Secretária'

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
                    required: this.usuario.id ? false : true
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