<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <parametros-triagem-form
                        ref="parametrosTriagemForm"
                        ></parametros-triagem-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

    import ParametrosTriagemForm from "@/components/cadastro/forms/ParametrosTriagemForm.vue";
    export default {
        components: {
            ParametrosTriagemForm
        },
        data: () => ({
            }),

        methods: {
        }
    };
</script>
