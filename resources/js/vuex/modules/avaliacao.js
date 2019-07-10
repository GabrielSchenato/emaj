export default {
    state: {
        avaliacaoList: [],
        avaliacaoView: {}
    },
    mutations: {
        updateAvaliacaoList(state, data) {
            state.avaliacaoList = data;
        },
        updateAvaliacaoView(state, data) {
            state.avaliacaoView = data;
        }
    },
    actions: {
        getAvaliacoes(context) {
            return window.axios.get('avaliacoes?limit=1500&order=id,desc').then(response => {
                context.commit('updateAvaliacaoList', response.data);
            });
        },
        getAvaliacao(context, id) {
            return window.axios.get('avaliacoes/' + id).then(response => {
                context.commit('updateAvaliacaoView', response.data);
            });
        },
        newAvaliacao(context, data) {
            return window.axios.post('avaliacoes', data);
        },
        updateAvaliacao(context, data) {
            return window.axios.put('avaliacoes/' + data.id, data);
        },
        removeAvaliacao(context, data) {
            return window.axios.delete('avaliacoes/' + data.id);
        }
    }
}