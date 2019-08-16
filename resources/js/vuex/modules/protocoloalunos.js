import Vue from 'vue'
export default {
    state: {
        protocoloAlunosList: [],
        protocoloAlunosView: {}
    },
    mutations: {
        updateProtocoloAlunosList(state, data) {
            state.protocoloAlunosList = data;
        },
        updateProtocoloAlunosView(state, data) {
            state.protocoloAlunosView = data;
        }
    },
    actions: {
        getProtocoloAlunos(context, params) {
            return window.axios.get('protocoloalunos' + params).then(response => {
                context.commit('updateProtocoloAlunosList', response.data);
            });
        },
        getProtocoloAluno(context, id) {
            return window.axios.get('protocoloalunos/' + id).then(response => {
                context.commit('updateProtocoloAlunosView', response.data);
            });
        },
        newProtocoloAluno(context, data) {
            return window.axios.post('protocoloalunos', data);
        },
        updateProtocoloAluno(context, data) {
            return window.axios.put('protocoloalunos/' + data.id, data);
        },
        removeProtocoloAluno(context, data) {
            return window.axios.delete('protocoloalunos/' + data.id);
        }
    }
}