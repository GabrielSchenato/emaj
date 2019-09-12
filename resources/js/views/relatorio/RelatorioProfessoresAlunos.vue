<template>
    <div id="pageTable">
        <v-container grid-list-xl fluid>
            <v-layout row wrap>
                <v-flex lg12>
                    <relatorio-professores-alunos-form
                        ref="relatorioProfessoresAlunosForm"
                        ></relatorio-professores-alunos-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

    import RelatorioProfessoresAlunosForm from "@/components/relatorio/forms/RelatorioProfessoresAlunosForm.vue";
    export default {
        components: {
            RelatorioProfessoresAlunosForm
        },
        data: () => ({
            }),

        methods: {
        }
    };
</script>
