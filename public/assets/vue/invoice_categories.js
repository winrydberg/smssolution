$(function(){
    $("#invoice_categories").DataTable({
        layout: {
            topStart: {
                buttons: ['csv', 'excel']
            }
        }
    })
})
new Vue({
        el: '#vue-section',
        delimiters: ['[[', ']]'], // I have already set the global config for this
        data: {
            _token: $('meta[name="_token"]').attr('content'),
        },
        methods: {
            deleteInvoiceCategory(id){
                Swal.fire({
                    title: "Delete Invoice Category",
                    text: "Are you sure? This action will delete all invoice pending payment in this category ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        axios.post("/delete-invoice-category", {id: id, _token: this._token}).then(response => {
                            if(response.data.status == "success"){
                                Swal.fire({
                                    title: "Success",
                                    text: response.data.message,
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: "Error",
                                    text: response.data.message,
                                    icon: "error"
                                })
                            }
                        }).catch(error => {
                            Swal.fire({
                                title: "Error!",
                                text: "Oops, something went wrong. Please try again",
                                icon: "error"
                            });
                        })
                    }
                });
            },
        }
});
