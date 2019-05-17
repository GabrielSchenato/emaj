<template>
    <v-layout row pb-2>
        <v-flex xs10 offset-xs1>
            <versao1_0_1></versao1_0_1>
            </br>
            <versao1_0_0></versao1_0_0>
        </v-flex>
    </v-layout>        
</template>

<script>
    import Versao1_0_0 from "@/views/versoes/Versao1_0_0.vue";
    import Versao1_0_1 from "@/views/versoes/Versao1_0_1.vue";
    export default {
        components: {
            Versao1_0_0,
            Versao1_0_1,
        }
    };
</script>