<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.0.6</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>28 de Junho de 2019</small></v-toolbar-title>                      
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
                        <li class="timeline-block" v-for="(item, index) in alteracoesPortal" :key="index">
                            <div class="timeline-point">
                                <v-icon :color="item.color">{{ item.icon }}</v-icon>
                            </div>
                            <div class="timeline-content">
                                <div v-html="item.text"></div>
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
                        <li class="timeline-block" v-for="(item, index) in alteracoesInstitucional" :key="index">
                            <div class="timeline-point">
                                <v-icon :color="item.color">{{ item.icon }}</v-icon>
                            </div>
                            <div class="timeline-content">
                                <div v-html="item.text"></div>
                            </div>
                        </li>
                    </ol>              
                </div>        
            </v-flex>    

        </v-card-text>
    </v-card>    
</template>

<script>
    export default {
        name: "versao1_0_6",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Alterações): Aplicada melhoria na listagem de alterações da plataforma'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [];
            }
        }
    };
</script>