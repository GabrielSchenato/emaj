import Vue from 'vue'
export default {
    state: {
        parametrosTriagemView: {}
    },
    mutations: {
        updateParametrosTriagemView(state, data) {
            state.parametrosTriagemView = data;
        }
    },
    actions: {
        getParametrosTriagem(context) {
            return window.axios.get('parametrostriagem').then(response => {
                context.commit('updateParametrosTriagemView', response.data);
            });
        },
        saveParametrosTriagem(context, data) {
            return window.axios.post('parametrostriagem', data);
        }
    }
}