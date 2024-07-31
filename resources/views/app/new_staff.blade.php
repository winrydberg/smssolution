@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
{{-- <link href="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"> --}}
<style>

</style>
@stop

@section("content")
<div class="row">
    <div class="col-lg-12">	
        <h2 class="st_title"><i class="uil uil-file-alt"></i> Dashboard</h2>
    </div>					
</div>				
<div class="row" id="vue-section">					
    <div class="col-lg-8 col-md-8">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>NEW STAFF</h2>
            </div>
            <div class="statement_content">
                <form @submit.prevent="addNewStaff">
                    <div class="row">
                        <div class="col-md-6">	
                            <div class="ui search focus mt-30 lbel25">
                                <label>Staff No <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19">
                                    <input v-model="form.staff_no" style="background-color: #878282;" disabled value="{{$staff_no}}"  class="prompt srch_explore form-control" type="text" name="staff_no" id="first_name" required="" >															
                                </div>
                            </div>										
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">	
                            <div class="ui search focus mt-30 lbel25">
                                <label>First Name <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19">
                                    <input v-model="form.first_name" required class="prompt srch_explore form-control" type="text" name="first_name" id="first_name" required="" >															
                                </div>
                            </div>										
                        </div>
                        <div class="col-md-6">	
                            <div class="ui search focus mt-30 lbel25">
                                <label>Last Name <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19">														
                                    <input v-model="form.last_name" required class="prompt srch_explore form-control" type="text" name="last_name" >									
                                </div>
                            </div>												
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Email Address</label>
                                <div class="ui left icon input swdh19">	
                                    <input v-model="form.email" class="prompt srch_explore form-control" type="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Phone No <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19">	
                                    <input v-model="form.phone" required class="prompt srch_explore form-control" type="text" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" mt-30">
                                <label>Staff Type <span style="color:red;">*</span></label>
                                <select required @change="setSelectedStaffType" class="ui hj145 dropdown cntry152 prompt srch_explore form-control" name="staff_type">
                                    <option value="">Select an option</option>
                                    @foreach($staff_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" id="add_class_button_con" v-show="form.staff_type == 'Teacher'">
                        <div class="col-md-6">
                            <button type="button" @click="addClass()" id="add_class" style="padding: 10px;">Add Class & Subject</button>
                        </div>
                   </div>
                   <div class="row">
                    <div class="col-md-12">
                        <div class="ui search focus mt-30 lbel25">
                            <label>Basic Salary(GHC)</label>
                            <div class="ui left icon input swdh19">	
                                <input class="prompt srch_explore form-control" type="number" v-model="form.basic_salary"  name="basic_salary">
                            </div>
                        </div>
                    </div>
                   </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Photo</label>
                                <div class="ui left icon input swdh19">	
                                    <input @change="setSelectedImage" class="prompt srch_explore form-control" type="file" accept="image/*" name="photo">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            {{-- <hr /> --}}
                        </div>
                        
                     

                       
                        <div class="col-md-6">
                            <button class="add_crdit_btn mt-50" type="submit">Add Staff</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>			
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>Select Photo Preview</h2>
            </div>
            <div class="statement_content d-flex align-items-center justify-content-center">
                <img v-if="image == null" style="height: 150px; width: 150px; " src="{{asset('assets/images/hd_dp.jpg')}}" />
                <img v-else="image" style="height: 150px; width: 150px; " :src="form.image_src" />
            </div>
        </div>

        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>Class & Subjects</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in class_data">
                            <td>[[index + 1]]</td> 
                            <td>[[item.class_name]]</td> 
                            <td>[[item.subject_name]]</td> 
                            <td>
                                <a href="javascript:void(0)" @click="removeClassSubject(index)" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
                            </td> 
                        </tr>
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="classModalLabel">Add Class & Subject</h5>
              <button type="button" @click="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="class_subject_form" @submit.prevent="saveClassSubject">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="mt-30 lbel25">
                            <label>Class</label>
                        </div>
                        <select class="selectpicker" @change="setSelectedClass" title="Select Class" name="class_id">
                            <option value="" disabled>Select an option</option>	
                            @foreach($classes as $s)
                            <option value="{{$s->id}}">{{$s->name}} - {{$s->sub_name}}</option>	
                            @endforeach																						
                        </select>
                    </div>	
                    <div class="col-lg-12 col-md-12">
                        <div class="mt-30 lbel25">
                            <label>Subject</label>
                        </div>
                        <select class="selectpicker " @change="setSelectedSubject" title="Select Subjects" name="subject">
                            <option value="" disabled>Select an option</option>	
                            @foreach($subjects as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>	
                            @endforeach																						
                        </select>
                    </div>	
                </div>
                <button type="submit" class="add_crdit_btn mt-4">Save Class & Subject</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="closeModal()" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
</div>




@stop

@section("scripts")
<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    new Vue({
        el: '#vue-section',
        delimiters: ['[[', ']]'], // I have already set the global config for this
        data: {
            form: {
                _token: "{{Session::token()}}",
                staff_no: "{{$staff_no}}",
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                staff_type: "",
                image_src: "",
                basic_salary: ""
            },
            
            class_id:0,
            classs: {
                id: null,
                name: null
            },
            subject: {
                id: null,
                name: null
            },
            count: 0,
            class_data: [],
            image: null,

        },
        mounted(){
            // alert("Pga mounted")
        },
        methods: {
            addClass(){
               $("#classModal").modal("show");
            },

            closeModal(){
                $("#classModal").modal("hide");
            },

            setSelectedStaffType(event){
                const selectedIndex = event.target.selectedIndex;
                this.form.staff_type = selectedIndex;
                this.form.staff_type = event.target.options[selectedIndex].text;
                if(this.form.staff_type == "Teacher"){
                    $("#add_class_button_con").show();
                }else{
                    $("#add_class_button_con").hide();
                }
            },

            setSelectedClass(event){
                this.class_id = event.target.value;
                const selectedIndex = event.target.selectedIndex;
                this.classs = {
                    id: event.target.value,
                    name: event.target.options[selectedIndex].text
                }
            },

            setSelectedSubject(event){
                
                const selectedIndex = event.target.selectedIndex;
                this.subject = {
                    id: event.target.value,
                    name: event.target.options[selectedIndex].text
                }
            },

            saveClassSubject(){
                this.class_data.push({
                    class_id: this.classs.id,
                    class_name: this.classs.name,
                    subject_id: this.subject.id,
                    subject_name: this.subject.name
                });
                $("#class_subject_form")[0].reset();
                $("#classModal").modal("hide");
            },

            removeClassSubject(index){
                this.class_data.splice(index, 1);
            },

            setSelectedImage(event){
                this.image = event.target.files[0];
                
                // Create a new FileReader object
                const reader = new FileReader();
                // Listen to the 'load' event of the FileReader object
                reader.addEventListener('load', () => {
                // When the 'load' event is fired, set imageUrl to the result of the FileReader object
                    this.form.image_src = reader.result;
                });

                // Read the contents of the file as a data URL
                reader.readAsDataURL(this.image);
            },

            addNewStaff(){
                if(this.form.staff_type == "Teacher"){
                    if(this.class_data.length <= 0){
                        Swal.fire("Error", "Please add the class and subject being taught by staff", "error");
                        return;
                    }
                }

                Swal.fire({
                    title: "Add New Staff",
                    text: "Confirm to Proceed",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.class_data = this.class_data;
                        axios.post("/new-staff", this.form).then(response => {
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
</script>
@stop