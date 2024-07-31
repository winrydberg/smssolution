// JQUERY 
$(function(){
    $("#pending_fees").DataTable({
        layout: {
            topStart: {
                buttons: ['csv', 'excel']
            }
        }
    });

    $("#paid_fees").DataTable({
        layout: {
            topStart: {
                buttons: ['csv', 'excel']
            }
        }
    });
})



new Vue({
    el: '#vue-section',
    delimiters: ['[[', ']]'], // I have already set the global config for this
    data: {
        selected_fees: [],
        sid : null
    },
    mounted(){
        //get the student id from the query params
        const urlParams = new URLSearchParams(window.location.search);
        this.sid = urlParams.get('sid');
    },
    methods: {
       generateAllInvoices(){
        Swal.fire({
            title: "Generate Invoice",
            text: "You are about generating invoice for all pending fees. Confirm to proceed",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Proceed!"
            }).then((result) => {
            if (result.isConfirmed) {
                axios.post("/generate-invoice", {
                    gtype: "ALL_FEES",
                    sid: this.sid
                }).then(response => {
                    if(response.data.status == "success"){
                        Swal.fire({
                            title: "Succes",
                            text: response.data.message,
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        })
                    }else{
                        Swal.fire({
                            title: "Error",
                            text: response.data.message,
                            icon: "error"
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: "Error",
                        text: error.message,
                        icon: "error"
                    });
                })
                
            }
        });
       },

       generateInvoiceForSelectedFees(){
        
        Swal.fire({
            title: "Generate Invoice",
            text: "You are about generating invoice for all selected fees. Confirm to proceed",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Proceed!",

            }).then((result) => {
            if (result.isConfirmed) {
                axios.post("/generate-invoice", {
                    gtype: "SELECTED",
                    fees: this.selected_fees,
                    sid: this.sid
                }).then(response => {
                    if(response.data.status == "success"){
                        Swal.fire({
                            title: "Succes",
                            // text: response.data.message,
                            icon: "success",
                            html:  `${response.data.message}`+`<br/> <br/>`+
                            `<a href="#" type="button" role="button" tabindex="0" class="ui green small button">Print Invoice</a>`,
                        }).then(() => {
                            window.location.reload();
                        })
                    }else{
                        Swal.fire({
                            title: "Error",
                            text: response.data.message,
                            icon: "error"
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: "Error",
                        text: error.message,
                        icon: "error"
                    });
                })
                
            }
        });
       }
    }
});
