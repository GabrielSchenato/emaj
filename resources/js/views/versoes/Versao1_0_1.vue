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
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Cadastro) Removido a obrigatoriedade do campo "Descrição" no cadastro de telefones do cliente
                </v-list-tile-content>
            </v-list-tile>
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Cadastro) Aumentado o tamanho do campo "Despesas" no cadastro da Composição Familiar do cliente
                </v-list-tile-content>
            </v-list-tile>
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Correção (Movimento) Aplicada correção na impressão do relatório da "Ficha de Triagem"
                </v-list-tile-content>
            </v-list-tile>
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Movimento) Ajustado para poder digitar o nome do aluno, ao invés de cadastrar na tela de "Usuários"
                </v-list-tile-content>
            </v-list-tile>
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Movimento) Ajustado a tela de "Ficha de Triagem", assim incluindo o botão de "+" para cadastrar novos clientes/parte contrárias e tipos de demanda
                </v-list-tile-content>
            </v-list-tile>
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Movimento) Ajustado a tela de "Ficha de Triagem", mudando a forma de busca dos campos "Cliente", "Parte Contrária" e "Tipo de Demanda" para só buscar assim que digitar três caracteres
                </v-list-tile-content>
            </v-list-tile>
            <br>

            <h3 class="font-weight-thin font-italic">Institucional</h3>
            <v-divider></v-divider>         

        </v-card-text>
    </v-card>    
</template>

<script>
    export default {
        name: "versao1_0_0"
    };
</script>