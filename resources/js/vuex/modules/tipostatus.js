import Vue from 'vue'
export default {
    state: {
        tipoStatusList: [],
        tipoStatusView: {}
    },
    mutations: {
        updateTipoStatusList(state, data) {
            state.tipoStatusList = data;
        },
        updateTipoStatusView(state, data) {
            state.tipoStatusView = data;
        }
    },
    actions: {
        getTipoStatusAll(context) {
            return window.axios.get('tipostatus?limit=1500&order=id,desc').then(response => {
                context.commit('updateTipoStatusList', response.data);
            });
        },
        getTipoStatus(context, id) {
            return window.axios.get('tipostatus/' + id).then(response => {
                context.commit('updateTipoStatusView', response.data);
            });
        },
        newTipoStatus(context, data) {
            return window.axios.post('tipostatus', data);
        },
        updateTipoStatus(context, data) {
            return window.axios.put('tipostatus/' + data.id, data);
        },
        removeTipoStatus(context, data) {
            return window.axios.delete('tipostatus/' + data.id);
        }
    }
}