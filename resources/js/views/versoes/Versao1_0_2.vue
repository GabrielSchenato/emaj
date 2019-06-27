<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.0.2</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>22 de Maio de 2019</small></v-toolbar-title>                      
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
        name: "versao1_0_2",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Correção (Cadastro): Aplicada correção nos campos "Renda", "Renda Familiar" e "Valor Patrimônio", corrigindo dessa forma o campo moeda no cadastro do "Cliente"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Removido a obrigatoriedade dos campos "Tipo de Demanda" e "Tipo de Status". Habilitado também o campo "Protocolo" para editação na ação de editar na tela de "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Adicionado o campo "Professor" na tela de "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Adicionado o campo "CPF Representado/Assistido" e "RG Representado/Assistido" na tela de cadastro de "Cliente"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Aplicada diversas modificações na impressão da "Ficha de Triagem", incluindo novos campos e layout melhorado'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [];
            }
        }
    };
</script>