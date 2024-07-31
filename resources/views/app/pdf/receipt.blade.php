<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}"> --}}
    <title>Payment Receipt</title>
    <style>
        body {
            position: relative;
        }

        .watermark {
            position: absolute;
            top: 50%; /* Adjust the vertical position */
            left: 50%; /* Adjust the horizontal position */
            transform: translate(-50%, -50%);
            opacity: 0.5; /* Adjust the opacity as needed */
        }
        table{
            margin-top: 30px;
        }
        th, td {
            border: 1px solid;
            padding-top: 10px;
            padding-left: 5px;
            padding-bottom: 10px;
        }
        table, tr {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
        }
        #imagecontainer{
            width: 100%;
            display:flex;
            justify-content: center;
            align-items: center;
            margin: 20px;
            text-align: center;
        }

        #photo {
            height: 110px; 
            width: 100px;
            /* display: block; */
            margin-left: 0 auto;
            margin-right: 0 auto;
            /* margin: 0 auto */

        }

        table span {
            color: brown;
            font-weight: bold;
            text-transform: uppercase
        }
    </style>
</head>
<body>
    <div class="logo-container">
        {{-- <img style="height: 200px; width: 180px; display:block;margin: 0 auto; " src="{{asset("assets/images/logo.jpg")}}"/> --}}
    </div>
    <p><strong style="font-size: 25px;">OFFICIAL RECEIPT</strong> </p>
    {{-- <p><strong style="font-size: 20px;">NO# {{$payment->receipt_no}}</strong></p> --}}
</br >
    <p><strong>INVOICE NO#: </strong> <strong>{{$payment->invoice_no}}</strong></p>
    <p><strong>RECEIPT NO#: </strong> <strong>{{$payment->receipt_no}}</strong></p>
    <table>
        <tbody>
            <tr>
                <td style="border-color:white;" colspan="2">
                    <p><strong>FROM: </strong></p>
                    <p><strong>{{env("SCHOOL_NAME")}}</strong> </p>
                    <p><strong>Address: </strong> {{env(("ADDRESS"))}}</p>
                    <p><strong>Phone NO#: </strong> {{env(("PHONE"))}}</p>
                </td>
                <td style="border-color:white;" colspan="1">
                    <p><strong>TO: </strong></p>
                    <p><strong>Student Name </strong> {{$student?->first_name." ".$student?->last_name}}</p>
                    <p><strong>Parent Name: </strong> {{$guardian?->first_name." ".$guardian?->last_name}} </p>
                    <p><strong>Phone NO#: </strong> {{$guardian?->phone}}</p>
                    <p><strong>Date Paid: </strong> {{date("F j, Y", strtotime($payment->paid_date))}}</p>
                </td>
                
            </tr>
        </tbody>
    </table>
    
    
    <p> Received with thanks from .........................................<strong style="text-transform: uppercase; text-decoration:underline;">{{$student!= null ? $student->first_name.' '.$student->middle_name.' '.$student->last_name: "N/A"}}</strong>.........................................................</p>
    <p> the sum of  ...........................................<strong style="text-decoration: underline;">{{env("CURRENCY")}} {{$payment != null ? $payment->amount : '0.0'}}</strong>......................................................................................</p>
    <p>..............................................................................................................................................................................</p>
    <p>For the purpose of ................................................<strong style="text-decoration: underline;">{{$payment != null ? $payment->fee_name : 'N/A'}}</strong>...................................................</p>
    <table>
        <tbody>
            <tr>
                <td colspan="2">SIGNATURE:   </td>
            </tr>
        </tbody>
    </table>

  
</body>
</html>