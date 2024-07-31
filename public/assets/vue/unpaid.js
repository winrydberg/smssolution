$(function(){
    $("#unpaid").DataTable({
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
        
    },
    methods: {
        
        saveFee(){
            Swal.fire({
                title: "Add New Fee",
                text: "Confirm to Proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed"
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.class_data = this.class_data;
                    axios.post("/new-fee", this.form).then(response => {
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