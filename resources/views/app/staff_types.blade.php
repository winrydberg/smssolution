@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
{{-- <link href="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"> --}}
@stop

@section("content")
<div class="row">
    <div class="col-lg-12">	
        <h2 class="st_title"><i class="uil uil-file-alt"></i> Dashboard</h2>
    </div>					
</div>				
<div class="row">					
    <div class="col-lg-8 col-md-8">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>STAFF CATEGORIES</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Total Staff</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach($staff_types as $key => $t)
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td>{{$t->name}}</td>
                                <td>{{$t->staffs_count}}</td>
                                <td>
                                    <button class="btn btn-sm"> <i class="uil uil-trash-alt"></i> Delete</button>
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
                <h2>NEW CATEGORY</h2>
            </div>
            <div class="statement_content" id="vue-section">
                <p><i class="uil uil-info-circle" style="color:red;"></i> Complete below form to add new staff types into the system</p>
                <form @submit.prevent="addNewStaffCategory" id="newClassForm">
                     <div class="col-md-12">
                         <div class="ui search focus mt-20 lbel25">
                             <label>Category Name <span style="color:red;">*</span></label>
                             <div class="ui left icon input swdh19">	
                                 <input v-model="form.category_name" required class="prompt srch_explore" type="text" name="category_name">
                             </div>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <button class="add_crdit_btn mt-30" type="submit"><i class="uil uil-plus"></i> Add Category</button>
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
                category_name : ""
            }
        },
        methods: {
            addNewStaffCategory(){
                Swal.fire({
                    title: "New Staff Category",
                    text: "Confirm to proceed",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post("/new-staff-type", this.form).then(response => {
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
        }
    });
</script>
@stop