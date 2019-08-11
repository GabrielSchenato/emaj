<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <relatorio-atividades-prestadas-form
                        ref="relatorioAtividadesPrestadasForm"
                        ></relatorio-atividades-prestadas-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

    import RelatorioAtividadesPrestadasForm from "@/components/relatorio/forms/RelatorioAtividadesPrestadasForm.vue";
    export default {
        components: {
            RelatorioAtividadesPrestadasForm
        },
        data: () => ({
            }),

        methods: {
        }
    };
</script>
