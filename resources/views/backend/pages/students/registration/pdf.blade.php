<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style type="text/css">
       table{
           border-collapse: collapse;
       }
       h2 h3{
           margin: 0;
           padding: 0;
       }
       .table{
           width: 100%;
           margin-bottom:  1rem;
           background: transparent;
       }
       .table th,
       .table td {
           padding: 0.75rem;
           vertical-align: top;
           border-top: 1px solid black;
       }
       .table thead th {
           vertical-align: bottom;
           border-bottom: 2px solid black;
       }
       .table tbody + tbody {
        border-bottom: 2px solid black;
       }
       .table .table{
           background: #fff;
       }
       .table-borderd{
           border: 1px solid black;
       }
       .table-borderd th,
       .table-borderd td{
          border-bottom-width: 2px;
       }
       .text-center{
           text-align: center;
       }
       .text-right {
           text-align: right;
       }
       table tr td {
           padding: 5px;
       }
       .table-borderd thead th {
           background: #cacaca;
       }
    </style>
    <title>Student details pdf!</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="80%">
                   <tr>
                       <td width="33%" class="text-center">
                          <img src="{{ asset('images/school/logo/logo.jpg') }}" alt="" width="200px">
                       </td>
                       <td class="text-center" width="63%">
                           <h4><strong>ABC School</strong></h4>
                           <h4><strong>Firoza Basar School && College</strong></h4>
                           <h4><strong>www.fbs.com</strong></h4>
                       </td>
                       <td class="text-center">
                           <img src="{{ asset('images/students/'.$student->student->image) }}" alt="">
                       </td>
                   </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: -25px;">Student Registration Card</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 50%">Student Name</td>
                            <td>{{ $student->student->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Father's Name</td>
                            <td>{{ $student->student->father_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Mother's Name</td>
                            <td>{{ $student->student->mother_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Year</td>
                            <td>{{ $student->year->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Class</td>
                            <td>{{ $student->class->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Id No</td>
                            <td>{{ $student->student->id_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Roll No</td>
                            <td>{{ $student->roll }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Mobile No</td>
                            <td>{{ $student->student->mobile }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Gender</td>
                            <td>{{ $student->student->gender }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Religion</td>
                            <td>{{ $student->student->religion }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Date of Birth</td>
                            <td>{{ $student->student->dob }}</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px; float: right;">Print date : {{ date("d M Y") }}</i>
            </div>
            <div class="col-md-12">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 30%"></td>
                            <td style="width: 30%"></td>
                            <td style="width: 40%; text-align : center;">
                               <hr style="margin-bottom: 0px; color: #000; width: 60%; border: 1px solid">
                               <p style="text-align: center;">HeadMaster/Principal</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

   
    -->
  </body>
</html>