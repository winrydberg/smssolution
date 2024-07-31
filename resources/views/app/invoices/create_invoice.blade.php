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
<div class="row" id="vue-section">					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>GENERATE INVOICE</h2>
            </div>
            <div class="statement_content">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6 ">
                        <form @submit.prevent="generateInvoice">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Description <span style="color:red;">*</span></label>
                                        <div class="ui left icon input swdh19">	
                                            <textarea required class="prompt srch_explore form-control" name="description" v-model="form.description" rows="3"></textarea>
                                            <small style="color:red;">Short description of the type of invoice been generated. For the purpose of tracking</small>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Invoice Code <span style="color:red;">*</span></label>
                                        <div class="ui left icon input swdh19">	
                                            <input v-model="form.category" disabled required class="prompt srch_explore form-control" value="{{$category}}" type="text" name="category">
                                        </div>
                                    </div>
                                </div>	
                            </div>
        
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-30 lbel25">
                                        <label>Applied Fees</label>
                                    </div>
                                    <select class="selectpicker" required v-model="form.fees" title="Select Fees" name="fees[]" multiple>
                                        <option value="" disabled>Select an option</option>	
                                        @foreach($fees as $f)
                                        <option value="{{$f->id}}">{{$f->name}}</option>	
                                        @endforeach																						
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-30 lbel25">
                                        <label>Applies On</label>
                                    </div>
                                    <select class="selectpicker" required v-model="form.applies_on" title="Select Fees" name="applies_on">
                                        <option value="" disabled>Select an option</option>	
                                        <option value="ALL">ALL</option>	
                                        <option value="CLASS">CLASS(ES)</option>	
                                        <option value="STUDENT">STUDENT</option>	
                                        																				
                                    </select>
                                </div>
                            </div>

                            <div class="row" v-show="form.applies_on == 'STUDENT'">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-30 lbel25">
                                        <label>Students</label>
                                    </div>
                                    <select class="selectpicker form-control" v-model="form.students" multiple>
                                        <option value="" disabled>Select an option</option>	
                                        @foreach($students as $s)
                                            <option value="{{$s->id}}">{{$s->first_name.' '.$s->last_name}}</option>	
                                        @endforeach																					
                                    </select>
                                </div>
                            </div>

                            <div class="row" v-show="form.applies_on == 'CLASS'">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-30 lbel25">
                                        <label>Class(es)</label>
                                    </div>
                                    <select class="selectpicker form-control" v-model="form.classes">
                                        <option value="" disabled>Select an option</option>	
                                        @foreach($classes as $c)
                                            <option value="">{{$c->name}}</option>	
                                        @endforeach														
                                    </select>
                                </div>
                            </div>

                            <div class="row" v-show="form.applies_on == 'CLASS'">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-30 lbel25">
                                        <label>Sub Group/Category</label>
                                    </div>
                                    <select class="selectpicker form-control" v-model="form.subclass" name="subclass[]" multiple>
                                        <option value="" disabled>Select an option</option>	
                                        <option value="ALL" selected>ALL</option>	
                                        @foreach($subclasses as $sc)
                                            <option value="{{$sc->id}}">{{$sc->name}}</option>	
                                        @endforeach														
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12 col-md-12">
                                   <button class="ui purple button block" type="submit"><i class="fa fa-save"></i> Generate Invoice(s)</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    $("")
    new Vue({
        el: '#vue-section',
        delimiters: ['[[', ']]'], // I have already set the global config for this
        data: {
            students: [],
            form: {
                _token: "{{Session::token()}}",
                category: "{{$category}}",
                students: [],
                classes: [],
                fees: [],
                description: '',
                subclass: [],
                applies_on: "",
                // payment_plan: ""
            }
        },
        methods: {
            openModal(){
               $("#classModal").modal("show");
            },

            closeModal(){
                $("#classModal").modal("hide");
            },

            getRemoteData(event){
                if(event.target.value == "STUDENT"){
                    axios.get("/get-students").then(response => {
                        if(response.data.status == "success"){
                            this.students = response.data.students;
                        }else{
                            console.log(response);
                        }
                    }).catch(error => {
                        console.log(error);
                    })
                }
            },

            generateInvoice(){
                Swal.fire({
                    title: "Generate Invoice",
                    text: "You are about generating invoices. Confirm to proceed",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Proceed"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.class_data = this.class_data;
                        axios.post("/generate-invoice", this.form).then(response => {
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