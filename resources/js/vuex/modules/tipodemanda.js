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
        getTipoDemandas(context, parametros) {
            const { sortBy, descending, page, rowsPerPage, busca } = parametros;
            let order = '';
                order = '&order=' + (sortBy ? sortBy : 'id') + ',' + (descending ? 'desc' : 'asc');
            let search = '';
            if(busca){
                search = '&search=' + busca.trim();
            }
            return window.axios.get('tipodemandas?limit=' + rowsPerPage + order + search + '&page=' + page).then(response => {
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