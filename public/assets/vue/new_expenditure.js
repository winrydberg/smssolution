new Vue({
    el: '#vue-section',
    delimiters: ['[[', ']]'], // I have already set the global config for this
    data: {
        students: [],
        form: {
            _token: $('meta[name="_token"]').attr('content'),
            category: "",
            description: "",
            spent_date: null,
        }
    },
    methods: {

        saveExpenditure(){
            Swal.fire({
                title: "New Expenditure",
                text: "You are about to log a new expenditure. Confirm to proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed"
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    axios.post("/new-expenditure", this.form).then(response => {
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