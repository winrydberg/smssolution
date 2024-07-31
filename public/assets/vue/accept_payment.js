
new Vue({
        el: '#vue-section',
        delimiters: ['[[', ']]'], // I have already set the global config for this
        data: {
            _token: $('meta[name="_token"]').attr('content'),
            invoice_no: "",
            amount_to_pay: null
        },
        methods: {
            searchInvoice(){
                Swal.fire({
                    title: "Search Invoice",
                    text: "Confirm to proceed",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        axios.post("/find-invoice", {invoice: this.invoice_no, _token: this._token}).then(response => {
                            if(response.data.status == "success"){
                                window.location.href = response.data.pay_url
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

            acceptPayment(){
                Swal.fire({
                    title: "Accepting payment for Invoice# "+$("#invoice_no").val(),
                    text: "Confirm to proceed",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        axios.post("/accept-payment", {invoice: $("#invoice_no").val(), sid: $("#sid").val(), amount: this.amount_to_pay, paid_date: $("#paid_date").val(), _token: this._token}).then(response => {
                            if(response.data.status == "success"){
                                Swal.fire({
                                    title: "Success",
                                    text: response.data.message,
                                    icon: "success"
                                })
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
