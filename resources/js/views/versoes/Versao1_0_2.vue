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
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Correção (Cadastro) Aplicada correção nos campos "Renda", "Renda Familiar" e "Valor Patrimônio", corrigindo dessa forma o campo moeda no cadastro do "Cliente"
                </v-list-tile-content>
            </v-list-tile>    
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Movimento) Removido a obrigatoriedade dos campos "Tipo de Demanda" e "Tipo de Status". Habilitado também o campo "Protocolo" para editação na ação de editar na tela de "Ficha de Triagem"
                </v-list-tile-content>
            </v-list-tile> 
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Movimento) Adicionado o campo "Professor" na tela de "Ficha de Triagem"
                </v-list-tile-content>
            </v-list-tile> 
            
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>fiber_manual_record</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    Adaptação (Cadastro) Adicionado o campo "CPF Representado/Assistido" e "RG Representado/Assistido" na tela de cadastro de "Cliente"
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
        name: "versao1_0_2"
    };
</script>