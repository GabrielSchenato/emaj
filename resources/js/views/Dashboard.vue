<template>
    <div id="pageDashboard">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <!-- mini statistic start -->
                <v-flex lg3 sm6 xs12>
                    <mini-statistic
                        icon="fa fa-graduation-cap"
                        :title="estatisticas.alunos"
                        sub-title="Alunos"
                        color="grey darken-1"      
                        >
                    </mini-statistic>  
                </v-flex>
                <v-flex lg3 sm6 xs12>
                    <mini-statistic
                        icon="fa fa-users"
                        :title="estatisticas.clientes"
                        sub-title="Clientes"
                        color="grey darken-2"      
                        >
                    </mini-statistic>           
                </v-flex>          
                <v-flex lg3 sm6 xs12>
                    <mini-statistic
                        icon="fa fa-user"
                        :title="estatisticas.parteContrarias"
                        sub-title="Parte Contrárias"
                        color="grey darken-3"      
                        >
                    </mini-statistic>            
                </v-flex>        
                <v-flex lg3 sm6 xs12>
                    <mini-statistic
                        icon="how_to_reg"
                        :title="estatisticas.atendimentosMes"
                        sub-title="Atendimentos Mês"
                        color="grey darken-4"      
                        >
                    </mini-statistic>             
                </v-flex>    
            <v-flex lg12 sm12 xs12 v-if="!loading">
                <v-widget title="Demandas" content-bg="white">
                    <div slot="widget-content">
                        <e-chart 
                            :path-option="[
                            ['dataset.source', estatisticas.top5DemandasMaisAtendidas],
                            ['legend.bottom', '0'],
                            ['color', [color.lightBlue.base, color.indigo.base, color.pink.base, color.green.base, color.cyan.base, color.teal.base]],
                            ['xAxis.show', false],
                            ['yAxis.show', false],
                            ['series[0].name', 'Nome'],
                            ['series[0].type', 'pie'],
                            ['series[0].avoidLabelOverlap', true],         
                            ['series[0].radius', ['50%', '70%']],                      
                            ]"
                            height="400px"
                            width="100%"
                            >
                    </e-chart>     
                </div>
            </v-widget>  
        </v-flex>
    </v-layout>
</v-container>
</div>
</template>

<script>
    import EChart from '@/components/chart/echart';
    import MiniStatistic from '@/components/widgets/statistic/MiniStatistic';
    import VWidget from '@/components/VWidget';
    import Material from 'vuetify/es5/util/colors';
    export default {
        components: {
            VWidget,
            MiniStatistic,         
            EChart           
        },
        data: () => ({
                loading: true,
                estatisticas: {},
                color: Material               
            }),
        mounted() {
            window.axios.get('dashboard/estatisticas').then(response => {
                this.estatisticas = response.data.data;
                this.loading = false;
            });
        }

    };
</script>
