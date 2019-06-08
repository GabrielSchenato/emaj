import Vue from 'vue'
export default {
    state: {
        alunoList: [],
        alunoView: {}
    },
    mutations: {
        updateAlunosList(state, data) {
            state.alunoList = data;
        },
        updateAlunosView(state, data) {
            state.alunoView = data;
        }
    },
    actions: {
        getAlunos(context, params) {
            return window.axios.get('alunos' + params).then(response => {
                context.commit('updateAlunosList', response.data);
            });
        },
        getAluno(context, id) {
            return window.axios.get('alunos/' + id).then(response => {
                context.commit('updateAlunosView', response.data);
            });
        },
        newAluno(context, data) {
            return window.axios.post('alunos', data);
        },
        updateAluno(context, data) {
            return window.axios.put('alunos/' + data.id, data);
        },
        removeAluno(context, data) {
            return window.axios.delete('alunos/' + data.id);
        }
    }
}