import Vue from 'vue'
export default {
    state: {
        clienteList: [],
        clienteView: {}
    },
    mutations: {
        updateClienteList(state, data) {
            state.clienteList = data;
        },
        updateClienteView(state, data) {
            state.clienteView = data;
        }
    },
    actions: {
        getClientes(context) {
            return window.axios.get('clientes?limit=1500&order=id,desc').then(response => {
                context.commit('updateClienteList', response.data);
            });
        },
        getCliente(context, id) {
            return window.axios.get('clientes/' + id).then(response => {
                context.commit('updateClienteView', response.data);
            });
        },
        newCliente(context, data) {
            return window.axios.post('clientes', data);
        },
        updateCliente(context, data) {
            return window.axios.put('clientes/' + data.informacoesPessoais.id, data);
        },
        removeCliente(context, data) {
            return window.axios.delete('clientes/' + data.id);
        }
    }
}