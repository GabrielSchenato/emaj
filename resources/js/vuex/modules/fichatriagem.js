import Vue from 'vue'
export default {
    state: {
        fichaTriagemList: [],
        fichaTriagemView: {}
    },
    mutations: {
        updateFichaTriagensList(state, data) {
            state.fichaTriagemList = data;
        },
        updateFichaTriagensView(state, data) {
            state.fichaTriagemView = data;
        }
    },
    actions: {
        getFichaTriagens(context) {
            return window.axios.get('fichatriagens?limit=1500&order=id,desc').then(response => {
                context.commit('updateFichaTriagensList', response.data);
            });
        },
        getFichaTriagem(context, id) {
            return window.axios.get('fichatriagens/' + id).then(response => {
                context.commit('updateFichaTriagensView', response.data);
            });
        },
        newFichaTriagem(context, data) {
            return window.axios.post('fichatriagens', data);
        },
        updateFichaTriagem(context, data) {
            return window.axios.put('fichatriagens/' + data.id, data);
        },
        removeFichaTriagem(context, data) {
            return window.axios.delete('fichatriagens/' + data.id);
        }
    }
}