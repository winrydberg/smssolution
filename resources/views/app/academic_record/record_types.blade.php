@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/smssolution-buttons.css')}}">	
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">	
{{-- <link href="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"> --}}
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
                <h2>FEES</h2>
            </div>
            <div class="statement_content">
                
               @if(count($fees) >0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach($fees as $key => $t)
                                    <tr>
                                        <td>{{$key +1 }}</td>
                                        <td>{{$t->name}}</td>
                                        <td>GHC {{$t->amount}}</td>
                                        <td>
                                            <a href="{{url('fee-collection?filterby=class&fid='.$t->id)}}" class="mini ui orange button"> <i class="uil uil-eye"></i> Breakdown By Class</a>
                                            <button class="mini ui red button"> <i class="uil uil-trash-alt"></i> Delete</button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else 
                    <div class="alert alert-danger d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-info-circle"></i>
                        <p>No fees configured for the active academic year</p>
                    </div>
                @endif
            </div>
        </div>			
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>USEFUL LINKS</h2>
            </div>
            <div class="statement_content" id="vue-section">
                <button @click="openModal()"  class="add_crdit_btn "><i class="uil uil-plus-circle"></i> NEW FEE</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="classModalLabel">Add Fee Type</h5>
              <button type="button" @click="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="class_subject_form" @submit.prevent="saveFee">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="ui search focus mt-30 lbel25">
                            <label>Fee Name <span style="color:red;">*</span></label>
                            <div class="ui left icon input swdh19">	
                                <input v-model="form.fee_name" required class="prompt srch_explore form-control" type="text" name="fee_name">
                            </div>
                        </div>
                    </div>	
                    <div class="col-lg-12 col-md-12">
                        <div class="ui search focus mt-30 lbel25">
                            <label>Amount (GHC) <span style="color:red;">*</span></label>
                            <div class="ui left icon input swdh19">	
                                <input v-model="form.amount" required class="prompt srch_explore form-control" type="text" name="amount">
                            </div>
                        </div>
                    </div>	
                    
                </div>
                <button type="submit" class="add_crdit_btn mt-4">Save Fee</button>
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
            students: [],
            form: {
                _token: "{{Session::token()}}",
                fee_name: "",
                amount: "",
                applies_on: "",
                classes: [],
                students: []
            }
        },
        methods: {
            openModal(){
               $("#classModal").modal("show");
            },

            closeModal(){
                $("#classModal").modal("hide");
            },

            // getRemoteData(event){
            //     if(event.target.value == "STUDENT"){
            //         axios.get("/get-students").then(response => {
            //             if(response.data.status == "success"){
            //                 this.students = response.data.students;
            //             }else{
            //                 console.log(response);
            //             }
            //         }).catch(error => {
            //             console.log(error);
            //         })
            //     }
            // },

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
</script>
@stop