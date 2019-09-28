<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <relatorio-clientes-protocolos-form
                        ref="relatorioClientesProtocolosForm"
                        ></relatorio-clientes-protocolos-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

    import RelatorioClientesProtocolosForm from "@/components/relatorio/forms/RelatorioClientesProtocolosForm.vue";
    export default {
        components: {
            RelatorioClientesProtocolosForm
        },
        data: () => ({
            }),

        methods: {
        }
    };
</script>
