<div class="row">
    <div class="col-lg-12">	
        <h2 class="st_title"><i class="uil uil-apps"></i> Dashboard</h2>
    </div>

    <div class="">
        <x-alert-component></x-alert-component>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>Total Fees(Active Term)</h5>
                <h2>{{env("CURRENCY")}} {{$total_fees}}</h2>
                @if(isset($term))
                <span class="crdbg_1">{{$term->name}}</span>
                @endif
            </div>
            <div class="card_dash_right">
                <img src="{{asset('assets/images/dashboard/achievement.svg')}}" style="width: 50px;" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>Total Staff</h5>
                <h2>{{$staff_count}}</h2>
                {{-- <span class="crdbg_2">New 125</span> --}}
            </div>
            <div class="card_dash_right">
                <img src="{{asset('assets/images/dashboard/graduation-cap.svg')}}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>Classes</h5>
                <h2>{{$classes_count}}</h2>
                {{-- <span class="crdbg_3">New 5</span> --}}
            </div>
            <div class="card_dash_right">
                <img src="{{asset('assets/images/dashboard/online-course.svg')}}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>Total Students</h5>
                <h2>{{$student_count}}</h2>
                {{-- <span class="crdbg_4">New 245</span> --}}
            </div>
            <div class="card_dash_right">
                <img src="{{asset('assets/images/dashboard/knowledge.svg')}}" alt="">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>Have a New Student ?</h1>
            </div>
            <div class="card_dash_right1">
                <button class="upload_btn ui violet button" onclick="window.location.href = '{{url('/new-student')}}';"><i class="fa fa-user-plus"></i> Register Student</button>
            </div>
        </div>
    </div>					
</div>