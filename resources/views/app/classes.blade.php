@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
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
                <h2>CLASSES</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <th>#ID</th>
                            <th>NAME</th>
                            <th>CATEGORIES</th>
                            <th>T. STUDENTS</th>
                            <th>ACTIONS</th>
                        </thead>
                        <tbody>
                            @foreach($classes as $key => $c)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>{{$c->name}}</td>
                                    <td>
                                        @if(!is_null($c->class_subcategories))
                                            @foreach($c->class_subcategories as $sub)
                                                {{$sub->name}}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$c->students_count}}</td>
                                    <td>
                                        {{-- <button class="mini ui primary button"><i class="uil uil-eye"></i> Details</button> --}}
                                        <a class="mini ui purple button" href="{{url('/view-students?classid='.$c->id)}}"><i class="uil uil-user"></i> Students</a>
                                        @if($c->students_count <= 0)
                                        <button class="mini ui orange button" @click="deleteClass('{{$c->id}}')" style="background:red;"><i class="uil uil-trash"></i> Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
            </div>
        </div>			
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>NEW CLASS</h2>
            </div>
            <div class="statement_content">
                <p><i class="uil uil-info-circle" style="color:red;"></i> Complete below for to add classes & sub classes</p>
               <form @submit.prevent="createNewClass" id="newClassForm">
                    <div class="col-md-12">
                        <div class="ui search focus mt-20 lbel25">
                            <label>Class Name <span style="color:red;">*</span></label>
                            <div class="ui left icon input swdh19">	
                                <input v-model="form.class_name" required class="prompt srch_explore form-control" type="text" name="class_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class=" mt-20">
                            <label>Sub Category <span style="color:red;">*</span></label>
                            <select class="selectpicker mt-2 " required v-model="form.category" name="category[]" multiple>
                                <option value="">Select an option</option>
                                @foreach($sub_classes as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="add_crdit_btn mt-30" type="submit"><i class="uil uil-plus"></i> Class</button>
                    </div>
               </form>
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
                class_name: "",
                category: []
            }
        },
        mounted(){
            // alert("Pga mounted")
        },
        methods: {
            createNewClass(){
                Swal.fire({
                    title: "Create Class",
                    text: "Confirm to proceed",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post("/new-class", this.form).then(response => {
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

            deleteClass(id){
                Swal.fire({
                    title: "Delete Class",
                    text: "Are you sure? This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Delete!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post("/delete-class", {id: id, _token: "{{Session::token()}}"})
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
                                text: "Unable to delete class. ERR : ".error.message,
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