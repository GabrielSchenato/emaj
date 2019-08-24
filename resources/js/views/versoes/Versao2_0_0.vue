<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v2.0.0</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>26 de Agosto de 2019</small></v-toolbar-title>                      
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
        name: "versao2_0_0",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria na tela de "Alunos" na aba "Avaliações" para quando clicar na linha expandir a mesma e mostrar mais informações sobre a avaliação'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Implementado uma nova aba no cadastro do "Cliente" chamada "Protocolos" onde é possível adicionar vários protocolos para o mesmo cliente.\n\
                        No cadastro do protocolo foram criados os campos "Protocolo" onde este é obrigatório, e os demais não obrigatórios como, "Número Processo", "Parte Contrária", "Tipo de Demanda" e "Observações"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Implementado dentro do cadastro do protocolo, uma nova aba chamada "Alunos/Professores Vinculados" a onde está, lista e permite o cadastro de "Aluno", "Professor" e "Data Vínculo"\n\
                        estes campos obrigatórios'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Aluno" renomeando a aba "Avaliações" para "Observações"'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Aluno" na aba "Observações", agora possui um campo "Protocolo" não obrigatório, onde é possível puxar todos os protocolos em que o aluno está vinculado'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Cliente" na "Protocolos", agora possui uma nova ação que permite imprimir a ficha de triagem do cliente'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhorias na impressão da Ficha de Triagem'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Aluno" na aba "Clientes", para buscar os vinculos realizados através dos protocolos'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Dashboard): Alterada a forma de buscar as estatísticas da Ficha de Triagem para Protocolos'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria na impressão da Ficha de Triagem, para exibir os campos da Parte Contrária mesmo quando não tenha uma'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", na aba "Protocolos" incluindo a opção de clicar sobre a linha do registro e expandir para visualizar os alunos e professores vinculados ao protocolo'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", na aba "Protocolos" incluindo um aviso quando o cliente já foi uma parte contrária'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", para quando salvar o mesmo e não ser uma parte contrária manter a janela aberta para inserir protocolos'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Movimento): Removido do menu as movimentações de Ficha de Triagens'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", na aba "Protocolos", no campo "Protocolo" validando o mesmo para só permitir salvar se o valor estiver seguindo o padrão #####/##'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Início): Alterada a forma de buscar as estatísticas da Ficha de Triagem para Protocolos'
                    }
                ];
            }
        }
    };
</script>