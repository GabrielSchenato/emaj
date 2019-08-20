import Vue from 'vue'
export default {
    state: {
        protocoloAlunosProfessoresList: [],
        protocoloAlunosProfessoresView: {}
    },
    mutations: {
        updateProtocoloAlunosProfessoresList(state, data) {
            state.protocoloAlunosProfessoresList = data;
        },
        updateProtocoloAlunosProfessoresView(state, data) {
            state.protocoloAlunosProfessoresView = data;
        }
    },
    actions: {
        getProtocoloAlunosProfessores(context, params) {
            return window.axios.get('protocoloalunosprofessores' + params).then(response => {
                context.commit('updateProtocoloAlunosProfessoresList', response.data);
            });
        },
        getProtocoloAlunoProfessor(context, id) {
            return window.axios.get('protocoloalunosprofessores/' + id).then(response => {
                context.commit('updateProtocoloAlunosProfessoresView', response.data);
            });
        },
        newProtocoloAlunoProfessor(context, data) {
            return window.axios.post('protocoloalunosprofessores', data);
        },
        updateProtocoloAlunoProfessor(context, data) {
            return window.axios.put('protocoloalunosprofessores/' + data.id, data);
        },
        removeProtocoloAlunoProfessor(context, data) {
            return window.axios.delete('protocoloalunosprofessores/' + data.id);
        }
    }
}