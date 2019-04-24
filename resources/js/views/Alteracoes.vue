<template>
    <div id="pageTable">
        <v-layout row pb-2>
            <v-flex xs10 offset-xs1>
                <v-card class="card--flex-toolbar">
                    <v-toolbar card prominent>
                        <v-toolbar-title class="body-6 black--text">v1.0.0</v-toolbar-title>
                        <v-toolbar-title class="body-1 grey--text"><small>30 de Junho de 2019</small></v-toolbar-title>                      
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-list-tile>
                            <v-list-tile-action>
                                <v-icon>fiber_manual_record</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>Evolução (Cadastro) Criado área para o cadastro de usuários</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>        
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <parametros-triagem-form
                        ref="parametrosTriagemForm"
                        ></parametros-triagem-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

    import ParametrosTriagemForm from "@/components/cadastros/forms/ParametrosTriagemForm.vue";
    export default {
        components: {
            ParametrosTriagemForm
        },
        data: () => ({
            }),

        methods: {
        }
    };
</script>
