<template>
    <v-layout row pb-2>
        <v-flex xs10 offset-xs1>
            <v-card>
                <v-card-text>
                    <fieldset>
                        <legend>Versões</legend>
                        <v-layout row wrap>

                            <v-flex xs12 sm6 md6>
                                <v-autocomplete
                                    v-model="versao"
                                    return-object                                    
                                    :items="versoes"
                                    hide-no-data
                                    hide-details
                                    item-text="nome"
                                    item-value="id"
                                    ></v-autocomplete>
                            </v-flex>

                        </v-layout>            
                    </fieldset>

                    <v-divider light class="pt-3"></v-divider>

                    <v-card class="card--flex-toolbar">
                        <v-toolbar card prominent>
                            <v-toolbar-title class="body-6 black--text">{{ versao.nome }}</v-toolbar-title>
                            <v-toolbar-title class="body-1 grey--text"><small>{{ versao.data }}</small></v-toolbar-title>                      
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text>

                            <h3 class="font-weight-thin font-italic">Portal</h3>
                            <v-divider></v-divider>
                            <br>

                            <v-flex sm12>
                                <div slot="widget-content">
                                    <ol class="timeline timeline-activity timeline-point-sm timeline-content-right" style="position: inherit">
                                        <li class="timeline-block" v-for="(item, index) in versao.alteracoesPortal" :key="index">
                                            <div class="timeline-point">
                                                <v-icon :color="item.color ? item.color : color">{{ item.icon ? item.icon : icon }}</v-icon>
                                            </div>
                                            <div class="timeline-content">
                                                <div v-html="item.descricao"></div>
                                            </div>
                                        </li>
                                    </ol>              
                                </div>        
                            </v-flex>       

                            <br>

                            <h3 class="font-weight-thin font-italic">Institucional</h3>
                            <v-divider></v-divider>      
                            <br>

                            <v-flex sm12>
                                <div slot="widget-content">
                                    <ol class="timeline timeline-activity timeline-point-sm timeline-content-right" style="position: inherit">
                                        <li class="timeline-block" v-for="(item, index) in versao.alteracoesInstitucional" :key="index">
                                            <div class="timeline-point">
                                                <v-icon :color="item.color ? item.color : color">{{ item.icon ? item.icon : icon }}</v-icon>
                                            </div>
                                            <div class="timeline-content">
                                                <div v-html="item.descricao"></div>
                                            </div>
                                        </li>
                                    </ol>              
                                </div>        
                            </v-flex>  

                        </v-card-text>
                    </v-card>    
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>        
</template>

<script>
    import Versoes from "@/api/versoes";
    export default {
        data() {
            return {
                versao: {},
                color: 'black',
                icon: 'fiber_manual_record'
            };
        },
        computed: {
            versoes() {
                return Versoes.getVersoesOrdenado();
            }
        },
        created() {
            this.versao = Versoes.getLastVersao();
        }
    };
</script>