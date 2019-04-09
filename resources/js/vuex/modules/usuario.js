import Vue from 'vue'
export default {
    state: {
        usuarioList: [],
        usuarioView: {}
    },
    mutations: {
        updateUsuariosList(state, data) {
            state.usuarioList = data;
        },
        updateUsuariosView(state, data) {
            state.usuarioView = data;
        }
    },
    actions: {
        getUsuarios(context) {
            return window.axios.get('usuarios?limit=1500&order=id,desc').then(response => {
                context.commit('updateUsuariosList', response.data);
            });
        },
        getUsuario(context, id) {
            return window.axios.get('usuarios/' + id).then(response => {
                context.commit('updateUsuariosView', response.data);
            });
        },
        newUsuario(context, data) {
            return window.axios.post('usuarios', data, {headers: {"content-type": "multipart/form-data"}});
        },
        updateUsuario(context, data) {
            return window.axios.post('usuarios/' + data.get('id'), data, {headers: {"content-type": "multipart/form-data"}});
        },
        removeUsuario(context, data) {
            return window.axios.delete('usuarios/' + data.id);
        }
    }
}