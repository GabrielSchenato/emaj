export default {
    methods: {
        gerarImpressao(data, url) {
            window.axios({
                url: url,
                method: "POST",
                responseType: "blob",
                data: data
            }).then(response => {
                const blob = new Blob([response.data], {
                    type: response.data.type
                });
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement("a");
                link.href = url;
                const contentDisposition =
                        response.headers["content-disposition"];
                let fileName = "unknown";
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
            });
        },
        getFileNameFromHttpResponse(contentDisposition) {
            var result = contentDisposition
                    .split(";")[1]
                    .trim()
                    .split("=")[1];
            return result.replace(/"/g, "");
        },
        paginationTable(paramsTable){
            const sortBy = paramsTable.sortBy ? paramsTable.sortBy : 'id';
            const descending = paramsTable.descending ? 'desc' : 'asc';
            const page = '&page=' + paramsTable.page;
            const rowsPerPage = '?limit=' + paramsTable.rowsPerPage;
            const order = '&order=' + sortBy + ',' + descending;
            const busca = paramsTable.query.field ? '&' + paramsTable.query.field + '=' + paramsTable.query.value : '';

            return rowsPerPage + page + order + busca;
        }
    }
};