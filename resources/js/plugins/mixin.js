export default {
    methods: {
        gerarImpressao(data, url) {
            window.getApp.$emit("APP_LOADER", {msg: 'O relatório está sendo gerado, aguarde.'});
            window.axios({
                url: url,
                method: "POST",
                responseType: "blob",
                data: data
            }).then(response => {
                window.getApp.$emit("APP_LOADER", {});
                const blob = new Blob([response.data], {
                    type: response.headers["content-type"]
                });
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement("a");
                link.href = url;
                const contentDisposition =
                        response.headers["content-disposition"];
                let fileName = "";
                if (contentDisposition) {
                    fileName = this.getFileNameFromHttpResponse(
                            contentDisposition
                            );
                }
                link.setAttribute("download", fileName);
                document.body.appendChild(link);
                link.click();
                link.remove();
                window.URL.revokeObjectURL(url);
            }).catch((error) => {
                window.getApp.$emit("APP_LOADER", {});
                try {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const data = JSON.parse(e.target.result);
                        window.getApp.$emit("APP_ERROR", {msg: `Ops! Ocorreu algum erro. ${data.errors}`, timeout: 5000});
                    };
                    reader.readAsText(error.response.data);
                } catch (e) {
                    window.getApp.$emit("APP_ERROR", {msg: `Ops! Ocorreu algum erro.`, timeout: 5000});
                }

            });            
        },
        getFileNameFromHttpResponse(contentDisposition) {
            var result = contentDisposition
                    .split(";")[1]
                    .trim()
                    .split("=")[1];
            return result.replace(/"/g, "");
        },
        paginationTable(paramsTable) {
            const sortBy = paramsTable.sortBy ? paramsTable.sortBy : 'id';
            const descending = paramsTable.descending ? 'desc' : 'asc';
            const page = '&page=' + paramsTable.page;
            const rowsPerPage = '?limit=' + paramsTable.rowsPerPage;
            const order = '&order=' + sortBy + ',' + descending;
            const field = paramsTable.query.field ? '&' + paramsTable.query.field : '';
            const value = paramsTable.query.value != null ? '=' + paramsTable.query.value : '';
            const busca = field && value ? field + value : '';

            return rowsPerPage + page + order + busca;
        }
    }
};