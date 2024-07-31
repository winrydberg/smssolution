$(function(){
    $("#subjects").DataTable({
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
        form: {
            _token: $('meta[name="_token"]').attr('content'),
            subject_name: "",
        }
    },
    mounted(){
        // alert("Pga mounted")
    },
    methods: {
        createNewSubject(){
            Swal.fire({
                title: "Create Subject",
                text: "Confirm to proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/new-subject", this.form).then(response => {
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

        deleteSubject(id){
            Swal.fire({
                title: "Delete Subject",
                text: "Are you sure? This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/delete-subject", {id: id, _token: $('meta[name="_token"]').attr('content')})
                    .then(response => {
                        if(response.data.status == "success"){
                            Swal.fire({
                                title: "Deleted!",
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
                            text: "Unable to delete subject. ERR : ".error.message,
                            icon: "error"
                        });
                    })
                    
                }
            });
        }
    }
});