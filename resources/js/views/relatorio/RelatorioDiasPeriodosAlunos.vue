<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <relatorio-dias-periodos-alunos-form
                        ref="relatorioDiasPeriodosAlunosForm"
                        ></relatorio-dias-periodos-alunos-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

    import RelatorioDiasPeriodosAlunosForm from "@/components/relatorio/forms/RelatorioDiasPeriodosAlunosForm.vue";
    export default {
        components: {
            RelatorioDiasPeriodosAlunosForm
        },
        data: () => ({
            }),

        methods: {
        }
    };
</script>
