import Vue from 'vue'
export default {
    state: {
        protocoloList: [],
        protocoloView: {}
    },
    mutations: {
        updateProtocoloList(state, data) {
            state.protocoloList = data;
        },
        updateProtocoloView(state, data) {
            state.protocoloView = data;
        }
    },
    actions: {
        getProtocolos(context, params) {
            return window.axios.get('protocolos' + params).then(response => {
                context.commit('updateProtocoloList', response.data);
            });
        },
        getProtocolo(context, id) {
            return window.axios.get('protocolos/' + id).then(response => {
                context.commit('updateProtocoloView', response.data);
            });
        },
        newProtocolo(context, data) {
            return window.axios.post('protocolos', data);
        },
        updateProtocolo(context, data) {
            return window.axios.put('protocolos/' + data.id, data);
        },
        removeProtocolo(context, data) {
            return window.axios.delete('protocolos/' + data.id);
        }
    }
}