export default [
    {
        name: 'APP_LOGIN_SUCCESS',
        callback: function (e) {
            this.$router.push({path: 'dashboard'});
        }
    },
    {
        name: 'APP_LOGOUT',
        callback: function (e) {
            this.snackbar = {
                show: true,
                color: 'green',
                text: 'Deslogado com sucesso!'
            };
            this.$router.replace({path: '/login'});
        }
    },
    {
        name: 'APP_ERROR',
        callback: function (object) {
            this.snackbar = {
                show: true,
                color: 'red',
                text: object.msg,
                icon: 'error',
                timeout: object.timeout ? object.timeout : 3000
            };
        }
    },
    {
        name: 'APP_LOADER',
        callback: function (object) {
            this.loader = {
                show: object.show,
                msg: object.msg ? object.msg : 'Carregando...'
            };
        }
    },
    {
        name: 'APP_SUCCESS',
        callback: function (object) {
            this.snackbar = {
                show: true,
                color: 'green',
                text: object.msg,
                icon: 'done',
                timeout: object.timeout ? object.timeout : 3000
            };
        }
    },
    {
        name: 'APP_ALERT',
        callback: function (object) {
            this.snackbar = {
                show: true,
                color: 'amber accent-4',
                text: object.msg,
                icon: 'warning',
                timeout: object.timeout ? object.timeout : 3000
            };
        }
    },
    {
        name: 'APP_PAGE_LOADED',
        callback: function (e) {
        }
    },
    {
        name: 'APP_AUTH_FAILED',
        callback: function (e) {
            this.$router.push('/login');
            this.$message.error('Token has expired');
        }
    },
    {
        name: 'APP_BAD_REQUEST',
        // @error api response data
        callback: function (msg) {
            this.$message.error(msg);
        }
    },
    {
        name: 'APP_ACCESS_DENIED',
        // @error api response data
        callback: function (msg) {
            this.$message.error(msg);
            this.$router.push('/forbidden');
        }
    },
    {
        name: 'APP_RESOURCE_DELETED',
        // @error api response data
        callback: function (msg) {
            this.$message.success(msg);
        }
    },
    {
        name: 'APP_RESOURCE_UPDATED',
        // @error api response data
        callback: function (msg) {
            this.$message.success(msg);
        }
    },
];
