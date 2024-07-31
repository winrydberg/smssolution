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
                <h2>EXPENDITURE CATEGORIES</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#ID</th>
                        <th>CATEGORY NAME</th>
                        <th>EXPENDTURE COUNT</th>
                        <th>ACTION</th>
                    </thead>

                    <tbody>
                       @if(isset($categories))
                            @foreach($categories as $key => $c)
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->expenditures_count}}</td>
                                    <td>
                                        <button @click="deleteCategory('{{$c->id}}')" class="mini ui orange button" {{$c->expenditures_count>0 ? 'disabled' : ''}}> <i class="uil uil-trash-alt"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                       @endif
                    </tbody>
                </table>
               </div>
            </div>
        </div>			
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>ADD NEW CATEGORY</h2>
            </div>
            <div class="statement_content" id="vue-section">
                <form id="class_subject_form" @submit.prevent="addNewCategory">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Fee Name <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19">	
                                    <input v-model="form.name" required class="prompt srch_explore form-control" type="text" name="name">
                                </div>
                            </div>
                        </div>		
                        
                    </div>
                    <button type="submit" class="ui violet block button mt-4"><i class="fa fa-plus-circle s"></i> Add Category</button>
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
<script src="{{asset('assets/vue/expenditure_categories.js')}}"></script>
@stop