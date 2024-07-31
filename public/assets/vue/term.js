

new Vue({
    el: '#vue-section',
    delimiters: ['[[', ']]'], // I have already set the global config for this
    data: {
        form: {
            _token: $('meta[name="_token"]').attr('content'),
            year_one: null,
            year_two: null,
        }
    },
    mounted(){
        // alert("Pga mounted")
    },
    methods: {
        openModal(){
            $("#acaModal").modal("show");
        },

         closeModal(){
             $("#acaModal").modal("hide");
        },

        activateTerm(id){
            Swal.fire({
                title: "Activate Term",
                text: "Confirm to proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/activate-term", {id: id, _token: $('meta[name="_token"]').attr('content')}).then(response => {
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

        setNewAcademicYear(){

            if(!$("#new_academic_year_form").valid()){
                return;
            }

            if(this.form.year_one == this.form.year_two){
                Swal.fire({
                    title: "Error!",
                    text: "ERR: Year One cannot be equal to Year Two ",
                    icon: "error"
                });
                return;
            }

            if((parseInt(this.form.year_one)) > parseInt(this.form.year_two)){
                Swal.fire({
                    title: "Error!",
                    text: "ERR: Year One cannot be greater than Year Two ",
                    icon: "error"
                });
                return;
            }

            if((parseInt(this.form.year_two)) - parseInt(this.form.year_one) > 1){
                Swal.fire({
                    title: "Error!",
                    text: "ERR: the difference between Year one and Year two cannot be more than 1 ",
                    icon: "error"
                });
                return;
            }

            Swal.fire({
                title: "New Academic year",
                text: "Are you sure? Confirm to proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/new-academic-year", this.form)
                    .then(response => {
                        if(response.data.status == "success"){
                            Swal.fire({
                                title: "Success!",
                                text: response.data.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: "Error: "+response.data.message,
                                icon: "error"
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add new academic year. ERR : "+error.message,
                            icon: "error"
                        });
                    })
                    
                }
            });
        },

        activateAcademicYear(id){
            Swal.fire({
                title: "Activate Academic Year",
                text: "Are you sure? Confirm to proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/activate-academic-year", {id: id, _token: $('meta[name="_token"]').attr('content')})
                    .then(response => {
                        if(response.data.status == "success"){
                            Swal.fire({
                                title: "Success!",
                                text: response.data.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to activate academic year. ERR : ".error.message,
                            icon: "error"
                        });
                    })
                    
                }
            });
        }
    }
});