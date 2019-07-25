<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.1.0</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>31 de Julho de 2019</small></v-toolbar-title>                      
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
        name: "versao1_1_0",
        computed: {
            alteracoesPortal() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Padrão): Aplicada melhoria na tela de Login da plataforma'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado no cadastro do aluno uma nova aba "Clientes", onde é possível visualizar todos os clientes em que o aluno está vinculado'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado no cadastro do aluno uma nova aba "Avaliações", onde é possível criar avaliações dos atendimentos dos alunos'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Cadastro): Criado no cadastro do aluno na ação de editar na aba "Avaliações" um novo campo "Anexos", onde é possível inserir arquivos com tamanho máximo de 10MB vinculado com as avaliações dos atendimentos dos alunos'
                    }
                ];
            },
            alteracoesInstitucional() {
                return [
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Institucional): Aplicada melhoria na logo da Uniplac e do EMAJ'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Evolução (Institucional): Criada página Contato'
                    },
                    {
                        icon: 'fiber_manual_record',
                        color: 'black',
                        text: 'Adaptação (Institucional): Ajustado os conteúdos da página inicial'
                    }
                ];
            }
        }
    };
</script>