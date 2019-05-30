<template>
    <v-layout row pb-2>
        <v-flex xs10 offset-xs1>
            <versao1_0_3></versao1_0_3>
            </br>
            <versao1_0_2></versao1_0_2>
            </br>
            <versao1_0_1></versao1_0_1>
            </br>
            <versao1_0_0></versao1_0_0>
        </v-flex>
    </v-layout>        
</template>

<script>
    import Versao1_0_0 from "@/views/versoes/Versao1_0_0.vue";
    import Versao1_0_1 from "@/views/versoes/Versao1_0_1.vue";
    import Versao1_0_2 from "@/views/versoes/Versao1_0_2.vue";
    import Versao1_0_3 from "@/views/versoes/Versao1_0_3.vue";
    export default {
        components: {
            Versao1_0_0,
            Versao1_0_1,
            Versao1_0_2,
            Versao1_0_3,
        }
    };
</script>