<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.0.3</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>28 de Maio de 2019</small></v-toolbar-title>                      
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
        name: "versao1_0_3",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Aplicada melhoria na impressão da "Ficha de Triagem", aumentando o campo "Local Trabalho"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria na tela de cadastro de "Clientes", removendo a obrigatoriedade do campo "Local de Trabalho"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de "Ficha de Triagem", assim incluindo o botão de "+" para cadastrar novas parte contrárias'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de cadastro de "Ficha de Triagem", incluído campo "Número Processo"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de cadastro de "Ficha de Triagem", incluído campo "Ativo"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de exibição de "Ficha de Triagem", para mostrar os campos "N.º Processo" e "Ativo"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Removido o cadastro "Tipo de Status"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustado a tela de cadastro "Ficha de Triagem", para atualizar o status da ficha automaticamente quando preencher o campo "Número Processo"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Criado tela para o cadastro "Alunos"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustada a tela de cadastro "Ficha de Triagem" para buscar os alunos cadastrados no sistema'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Adicionado campo "Professor?" no cadastro de "Usuários"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Ajustada a tela de cadastro "Ficha de Triagem" para buscar os professores cadastrados no sistema'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Aplicada melhorias na impressão da "Ficha de Triagem"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Correção (Cadastro): Aplicada correção no campo "Renda", "Valor Patrimônio" e "Renda Familiar", corrigindo dessa forma a validação dos mesmos'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [];
            }
        }
    };
</script>