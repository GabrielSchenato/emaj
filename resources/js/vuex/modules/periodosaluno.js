import Vue from 'vue'
export default {
    state: {
        periodosalunoList: [],
        periodoalunoView: {}
    },
    mutations: {
        updatePeriodosAlunoList(state, data) {
            state.periodosalunoList = data;
        },
        updatePeriodoAlunoView(state, data) {
            state.periodoalunoView = data;
        }
    },
    actions: {
        getPeriodosAluno(context, params) {
            return window.axios.get('diaperiodoalunos' + params).then(response => {
                context.commit('updatePeriodosAlunoList', response.data);
            });
        },
        getPeriodoAluno(context, id) {
            return window.axios.get('diaperiodoalunos/' + id).then(response => {
                context.commit('updatePeriodoAlunoView', response.data);
            });
        },
        newPeriodoAluno(context, data) {
            return window.axios.post('diaperiodoalunos', data);
        },
        removePeriodoAluno(context, data) {
            return window.axios.delete('diaperiodoalunos/' + data.id);
        }
    }
}