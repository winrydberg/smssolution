new Vue({
    el: '#vue-section',
    delimiters: ['[[', ']]'], // I have already set the global config for this
    data: {
        students: [],
        form: {
            _token: $('meta[name="_token"]').attr('content'),
            name: "",
        }
    },
    methods: {
       
        addNewCategory(){
            Swal.fire({
                title: "Add New Expenditure Category",
                text: "Confirm to Proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed"
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.class_data = this.class_data;
                    axios.post("/new-expenditure-category", this.form).then(response => {
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

        deleteCategory(id){
            Swal.fire({
                title: "Delete Category",
                text: "Confirm to Proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete"
                }).then((result) => {
                if (result.isConfirmed) {
                    this.form.class_data = this.class_data;
                    axios.post("/delete-expenditure-category", {id: id, _token: this.form._token}).then(response => {
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
        }
    }
});