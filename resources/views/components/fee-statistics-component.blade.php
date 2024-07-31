<div class="" style="margin-top: 30px;">
    <div class="ui one column grid">
        <div class="column">
          <div class="ui fluid card">
                <div class="content">
                    <img class="right floated mini ui image" src="{{asset('assets/images/fees.jpg')}}">
                    <div class="header">
                    Fees Pending
                    </div>
                    <div class="meta mt-4 mb-4" style="font-size: 13px;">
                     Fees with invoice generated but yet to be paid for the active academic year ({{env("ACADEMIC_YEAR")}})
                    </div>
                    <div class="description">
                       <h2 class="text-danger" >{{env("CURRENCY")}} {{$pending_fees}}</h2>
                    </div>
                </div>
                <div class="extra content">
                    {{-- <div class="ui two buttons">
                      <div class="ui basic green button">Approve</div>
                      <div class="ui basic red button">Decline</div>
                    </div> --}}
                </div>
                {{-- <div class="ui bottom attached button">
                    <i class="add icon"></i>
                    View Details
                </div> --}}
            </div>
        </div>
        <div class="column">
          <div class="ui fluid card">
            <div class="content">
                <img class="right floated mini ui image" src="{{asset('assets/images/verified-account.svg')}}">
                <div class="header">
                Payments Collected
                </div>
                <div class="meta mt-4 mb-4" style="font-size: 13px;">
                    Fees successfully collected for the active academic year ({{env("ACADEMIC_YEAR")}})
                </div>
                <div class="description">
                    <h2 class="text-success">{{env("CURRENCY")}} {{$fees_collected}}</h2>
                </div>
            </div>
            <div class="extra content">
                {{-- <div class="ui two buttons">
                  <div class="ui basic green button">Approve</div>
                  <div class="ui basic red button">Decline</div>
                </div> --}}
            </div>
            {{-- <div class="ui bottom attached button">
                <i class="add icon"></i>
                View Details
            </div> --}}
          </div>
        </div>
    </div>
</div>