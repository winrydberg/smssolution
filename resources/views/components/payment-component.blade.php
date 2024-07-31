				
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>LATEST PAYMENTS</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped text-nowrap" id="latest_payments">
                    <thead>
                        <th>#ID</th>
                        <th>RECEIPT#</th>
                        <th>ADMISSION NO</th>
                        <th>STUDENT NAME</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                        <th>PARENT NAME</th>
                        
                        <th>DATE PAID</th>
                        <th>ACTION</th>
                    </thead>

                    <tbody>
                        @foreach($payments as $key => $p)
                            <tr>
                               <td>{{$key + 1}}</td>
                               <td>{{$p->receipt_no}}</td>
                               <td>{{$p->student?->admission_no}}</td>
                               <td>{{$p->student?->first_name." ".$p->student->last_name}}</td>
                               <td>{{$p->amount}}</td>
                               <td><span class="small ui green tag label">PAID</span></td>
                               <td>{{$p->student?->guardian?->first_name." ".$p->student?->guardian?->last_name}}</td>
                               <td>{{date("F j, Y", strtotime($p->created_at))}}</td>
                               <td>
                                <a href="{{url('/pay-receipt?payid='.$p->id)}}" target="_blank" class="mini ui teal button"><i class="fa fa-print"></i> Receipt</a>
                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
            </div>
        </div>			
    </div>
