$(function() {
    // // Leave step event is used for validating the forms
    // $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
    //     // Validate only on forward movement  
    //     if (stepDirection == 'forward') {
    //       var index = (currentStepIdx + 1);
    //       switch(index){
    //         case 1:
    //             $("#register_btn").hide();
    //             if($('#form-' + index).valid()){
    //                 return true;
    //             }else{
    //                 return false;
    //             }
    //             break;
    //         case 2:
    //             if($("#guardian").val() == "NEW"){
    //                 if($('#form-' + index).valid()){
    //                     return true;
    //                 }else{
    //                     return false;
    //                 }
    //             }else{
    //                 return true;
    //             }
    //             break;
    //         case 3:
    //             $("#register_btn").show();
    //             if($('#form-' + index).valid()){
    //                 return true;
    //             }else{
    //                 return false;
    //             }
    //         default:
    //             return false;
    //       }
    //     }
    // });

    // $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
    //    if(stepNumber == 2){
    //     $("#register_btn").show();
    //    }else{
    //     $("#register_btn").hide();
    //    }
    // });

    // $('#smartwizard').smartWizard({
    //     toolbar: {
    //         showNextButton: true, // show/hide a Next button
    //         showPreviousButton: true, // show/hide a Previous button
    //         showFinishButton: true, // show/hide a Previous button
    //         position: 'bottom', // none|top|bottom|both
    //         // extraHtml: `<button class="btn btn-success" @click="registerStudent" id="register_btn">Register Student</button>`
    //     }
    // });
});



new Vue({
    el: '#vue-section',
    delimiters: ['[[', ']]'], // I have already set the global config for this
    data: {
        image: null,
        currentIndx         : 100,
        student: {
            _token              : $("#token").val(),
            admission_no        : $("#admission_no").val(),
            first_name          : "",
            middle_name         : "",
            class               : "",
            subclass            : "",
            last_name           : "",
            image_src           : "",
            guardian_firstname  : "",
            guardian_lastname   : "",
            guardian_email      : "",
            guardian_phone      : "",
            guardian_houseno    : "",
            guardian_occupation : "",
            admission_fee       : null,
            admission_fee_status: "PAID",
            guardian            : "NEW",
            gender              : ""

        },

    },
    mounted(){
        var _this = this;
        _this.handleWizard();
    },

    methods: {
        
        setSelectedImage(event){
            this.image = event.target.files[0];
            // Create a new FileReader object
            const reader = new FileReader();
            // Listen to the 'load' event of the FileReader object
            reader.addEventListener('load', () => {
            // When the 'load' event is fired, set imageUrl to the result of the FileReader object
                this.student.image_src = reader.result;
            });
            // Read the contents of the file as a data URL
            reader.readAsDataURL(this.image);
        },


        getGuardian(event){
            let val = event.target.value;
            if(event.target.value == "NEW"){
                return;
            }else{
                axios.get("/get-guardian?guardian_id="+val).then((response) => {
                    if(response.data.status == "success"){
                        let parent = response.data.parent;
                        this.student.guardian_firstname = parent.first_name;
                        this.student.guardian_lastname = parent.last_name;
                        this.student.guardian_email = parent.email;
                        this.student.guardian_email = parent.phone;
                        this.student.guardian_houseno = parent.house_no;
                        this.student.guardian_occupation = parent.occupation;
                    }
                }).catch(error => {
                    console.log(error);
                })
            }
        },

        registerStudent(){
            if(this.student.first_name == ""){
                Swal.fire({title: "Error",text: "Oops, Error: Please enter first name in the Student Info tab",icon: "error"});
                return;
            }
            if(this.student.last_name == ""){
                Swal.fire({title: "Error",text: "Oops, Error: Please enter last name / surname int he Student Info tab",icon: "error"});
                return;
            }
            if(this.student.class == ""){
                Swal.fire({title: "Error",text: "Oops, Error: Please select class in the Student Info tab",icon: "error"});
                return;
            }

            if(this.student.subclass == ""){
                Swal.fire({title: "Error",text: "Oops, Error. Please select sub class in the Student Info tab", icon: "error"});
                return;
            }

            if(!$("#form-3").valid()){
                return;
            }


            Swal.fire({
                title: "Register New Student",
                text: "Confirm to Proceed",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Proceed"
                }).then((result) => {
                if (result.isConfirmed) {
                    // this.form.class_data = this.class_data;
                    axios.post("/new-student", this.student).then(response => {
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
                            text: "Unable to register student. Please try again",
                            icon: "error"
                        });
                    })
                }
            });

        },

        handleWizard(){
            // Leave step event is used for validating the forms
            $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
                // Validate only on forward movement  
                if (stepDirection == 'forward') {
                var index = (currentStepIdx + 1);
                switch(index){
                    case 1:
                        $("#register_btn").hide();
                        if($('#form-' + index).valid()){
                            return true;
                        }else{
                            return false;
                        }
                        break;
                    case 2:
                        if($("#guardian").val() == "NEW"){
                            if($('#form-' + index).valid()){
                                return true;
                            }else{
                                return false;
                            }
                        }else{
                            return true;
                        }
                        break;
                    case 3:
                        $("#register_btn").show();
                        if($('#form-' + index).valid()){
                            return true;
                        }else{
                            return false;
                        }
                    default:
                        return false;
                }
                }
            });

            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            if(stepNumber == 2){
                $("#register_btn").show();
            }else{
                $("#register_btn").hide();
            }
            });

            $('#smartwizard').smartWizard({
                selected: 0,
                enableUrlHash: false,
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    showFinishButton: true, // show/hide a Previous button
                    position: 'bottom', // none|top|bottom|both
                    // extraHtml: `<button class="btn btn-success" v-on:click="${this.registerStudent}" id="register_btn">Register Student</button>`
                }
            });
        }
        
    }
});