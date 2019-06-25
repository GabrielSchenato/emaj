<template>
    <v-card class="card--flex-toolbar">
        <v-toolbar card prominent>
            <v-toolbar-title class="body-6 black--text">v1.0.5</v-toolbar-title>
            <v-toolbar-title class="body-1 grey--text"><small>21 de Junho de 2019</small></v-toolbar-title>                      
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
                    Adaptação (Movimento) Aplicada melhoria na listagem de Ficha de Triagens, destacando de vermelho o nome da Parte Contrária
                </v-list-tile-content>
            </v-list-tile>    
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Dashboard) Aplicada melhoria na Dashboard, destando a quantidade de "Alunos", "Clientes", "Parte Contrárias" e "Atendimentos Mês"
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
        name: "versao1_0_5"
    };
</script>