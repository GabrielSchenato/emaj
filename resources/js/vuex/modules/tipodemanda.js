import Vue from 'vue'
export default {
    state: {
        tipoDemandaList: [],
        tipoDemandaView: {}
    },
    mutations: {
        updateTipoDemandasList(state, data) {
            state.tipoDemandaList = data;
        },
        updateTipoDemandasView(state, data) {
            state.tipoDemandaView = data;
        }
    },
    actions: {
        getTipoDemandas(context, params) {
            return window.axios.get('tipodemandas' + params).then(response => {
                context.commit('updateTipoDemandasList', response.data);
            });
        },
        getTipoDemanda(context, id) {
            return window.axios.get('tipodemandas/' + id).then(response => {
                context.commit('updateTipoDemandasView', response.data);
            });
        },
        newTipoDemanda(context, data) {
            return window.axios.post('tipodemandas', data);
        },
        updateTipoDemanda(context, data) {
            return window.axios.put('tipodemandas/' + data.id, data);
        },
        removeTipoDemanda(context, data) {
            return window.axios.delete('tipodemandas/' + data.id);
        }
    }
}