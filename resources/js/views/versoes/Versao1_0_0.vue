<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.0.0</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>13 de Maio de 2019</small></v-toolbar-title>                      
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
        name: "versao1_0_0",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado área para o cadastro de "Usuários"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado área para a edição do perfil do usuário logado'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado área para o cadastro de "Tipo de Demandas"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado área para o cadastro de "Tipo de Status"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado área para o cadastro de "Parâmetros da Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Movimento): Criado área para o cadastro de "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Movimento): Criado relatório para a impressão dos dados das partes na "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Movimento): Criado relatório para a impressão do protocolo da "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Alterações): Criado área para a visualização das alterações na plataforma"'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Início): Criado página "Início" com conteúdos sobre o EMAJ'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: `Evolução (Sobre): Criado página "Sobre" <small class="font-weight-bold font-italic">(em construção)</small>`
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: `Evolução (Como Funciona): Criado página "Como Funciona" <small class="font-weight-bold font-italic">(em construção)</small>`
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: `Evolução (Contato): Criado página "Contato" <small class="font-weight-bold font-italic">(em construção)</small>`
                    }
                ];
            }
        }
    };
</script>