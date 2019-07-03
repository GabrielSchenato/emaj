<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.0.1</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>20 de Maio de 2019</small></v-toolbar-title>                      
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
        name: "versao1_0_1",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Removido a obrigatoriedade do campo "Descrição" no cadastro de telefones do cliente'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aumentado o tamanho do campo "Despesas" no cadastro da Composição Familiar do cliente'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Correção (Movimento): Aplicada correção na impressão do relatório da "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado para poder digitar o nome do aluno, ao invés de cadastrar na tela de "Usuários"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de "Ficha de Triagem", assim incluindo o botão de "+" para cadastrar novos clientes/parte contrárias e tipos de demanda'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de "Ficha de Triagem", mudando a forma de busca dos campos "Cliente", "Parte Contrária" e "Tipo de Demanda" para só buscar assim que digitar três caracteres'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [];
            }
        }
    };
</script>