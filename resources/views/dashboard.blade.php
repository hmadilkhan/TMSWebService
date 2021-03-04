@extends('layouts.master-layout')

@section('title','Dashboard')

@section('breadcrumtitle','Dashboard')

@section('navdashboard','active')

@section('content')

<style>
.outer {
    width: 100%;
    height: 150px;
    white-space: nowrap;
    position: relative;
    overflow-x: scroll;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
}

.outer .inner {
    width: 30%;
    background-color: #eee;
    float: none;
    height: 90%;
    margin: 0 0.25%;
    display: inline-block;
    zoom: 1;
}
</style>

{{--            <div class="row">--}}
{{--               <div class="col-xl-12">--}}

{{--                  --}}
{{--                  <div class="card-block outer">--}}
{{--                      <div class="row">--}}
{{--                          <div class="wrapper">--}}
{{--                               <div id="draggablePanelList "> --}}
{{--                                  @foreach($branches as $value)--}}
{{--                                   <div class="col-xl-3 col-lg-6 inner" style="cursor: pointer;"  onclick="getdetails('{{(session('roleId') == 2 ? $value->branch_id : $value->terminal_id)}}','{{$value->identify}}')" >--}}
{{--                                       <div class="card">--}}
{{--                                          <div class="card-block">--}}
{{--                                             <div class="media d-flex">--}}
{{--                                                <div class="media-left media-middle">--}}
{{--                                                   <a href="#">--}}
{{--                                                      <img class="media-object img-circle" src="{{ asset('public/assets/images/branch/'.(!empty($value->branch_logo) ? $value->branch_logo : 'placeholder.jpg').'') }}" width="50" height="50">--}}
{{--                                                   </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                   <span class="counter-txt f-w-600 f-20">--}}
{{--                                                    <span class="text-primary"> Rs. {{number_format($value->sales,0)}} /=</span>--}}
{{--                                                   </span>--}}
{{--                                <h6 class="f-w-300 m-t-5">{{--}}
{{--                                 (session("roleId") == 2 ? $value->branch_name : $value->terminal_name) --}}
{{--                                }}--}}
{{--                           </h6>--}}
{{--                                                </div>--}}
{{--                                             </div>--}}
{{--                                             <ul>--}}
{{--                                                <li class="new-users">--}}
{{--                                                </li>--}}
{{--                                             </ul>--}}
{{--                                          </div>--}}
{{--                                       </div>--}}
{{--                                    </div>--}}
{{--                                 @endforeach--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                     </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--            </div> --}}
@if($permission)
            <div class="row dashboard-header m-t-15">
               <div class="col-lg-3 col-md-4" onclick="getdetails()" style="cursor:pointer;">
                  <div class="card dashboard-product">
                     <span>Sales</span>
                     <h2 class="dashboard-total-products">{{(empty($totalSales)  ? 0 : number_format($totalSales[0]->TotalSales,2))}}</h2>
                     <span class="label label-warning">Total Sales</span>
                     <div class="side-box">
                        <i class="ti-signal text-warning-color"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-4" onclick="openExpenseReport()" style="cursor:pointer;">
                  <div class="card dashboard-product">
                     <span>Expenses</span>
                     <h2 class="dashboard-total-products">{{(empty($expenseAmount)  ? 0 : number_format($expenseAmount[0]->expenseAmount,2))}}</h2>
                     <span class="label label-primary">Total Expenses</span>
                     <div class="side-box ">
                        <i class="ti-gift text-primary-color" ></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-4" style="cursor:pointer;" onclick="openReport()" >
                  <div class="card dashboard-product">
                     <span>Profit</span>
                     <h2 class="dashboard-total-products"><span>{{number_format($totalSales[0]->TotalSales - $expenseAmount[0]->expenseAmount,2)}}</span></h2>
                     <span class="label label-success">Total Profit</span>
                     <div class="side-box">
                        <i class="ti-direction-alt text-success-color" ></i>
                     </div>
                  </div>
               </div>

{{--               <div class="col-lg-3 col-md-4">--}}
{{--                  <div class="card dashboard-product">--}}
{{--                     <span>Total Products</span>--}}
{{--                     <h2 class="dashboard-total-products"><span>{{$totalstock[0]->products}}</span></h2>--}}
{{--                     <span class="label label-danger">Products</span>--}}
{{--                     <div class="side-box">--}}
{{--                        <i class="icofont icofont-stock-mobile text-danger-color"></i>--}}
{{--                     </div>--}}
{{--                  </div>--}}

                  <div class="col-xl-3 col-lg-3 col-md-3 default-grid-item ">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-header-text">CHEQUE STATISTICS</h5>
                           <table class="table m-b-0" id="tblcheques">
                              <tbody>
                              </tbody>
                           </table>
                        </div>


                     </div>
                  </div>
            </div>


            <!-- 4-blocks row end -->
            <div class="row dashboard-header">
               <div class="col-lg-3 col-md-4 grid-item">
                  <div class="card">
                     <div class="card-block">
                        <div class="media d-flex">
                           <div class="media-left media-middle">
                              <div class="new-orders">
                                 <i class="icofont icofont-business-man-alt-3 bg-primary"></i>
                              </div>
                           </div>
                           <div class="media-body">
                                 <span class="counter-txt f-w-600 f-20">
                                        <span class=" ">{{$customers}}</span>
                                 </span>
                              <h6 class="f-w-300 m-t-5">Total Customers</h6>
                           </div>
                        </div>
                        <ul>
                           <li class="new-users">
                           </li>
                        </ul>
                     </div>
                  </div>
                  </div>

                  <div class="col-lg-3 col-md-4  grid-item">
                     <div class="card">
                        <div class="card-block">
                           <div class="media d-flex">
                              <div class="media-left media-middle">
                                 <div class="new-orders">
                                    <i class="icofont icofont-business-man-alt-3 bg-primary"></i>
                                 </div>
                              </div>
                              <div class="media-body">
                                 <span class="counter-txt f-w-600 f-20">
                                        <span class=" ">{{number_format($customerPayable,2)}}</span>
                                 </span>
                                 <h6 class="f-w-300 m-t-5"> Customers Payable</h6>
                              </div>
                           </div>
                           <ul>
                              <li class="new-users">
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3 col-md-4 grid-item">
                     <div class="card">
                        <div class="card-block">
                           <div class="media d-flex">
                              <div class="media-left media-middle">
                                 <div class="new-orders">
                                    <i class="icofont icofont-hotel-boy-alt bg-danger"></i>
                                 </div>
                              </div>
                              <div class="media-body">
                                 <span class="counter-txt f-w-600 f-20">
                                         <span class=" ">{{$vendors}}</span>
                                 </span>
                                 <h6 class="f-w-300 m-t-5">Vendors</h6>
                              </div>
                           </div>
                           <ul>
                              <li class="new-users">
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>

               <div class="col-lg-3 col-md-4 grid-item">
                  <div class="card">
                     <div class="card-block">
                        <div class="media d-flex">
                           <div class="media-left media-middle">
                              <div class="new-orders">
                                 <i class="icofont icofont-hotel-boy-alt bg-danger"></i>
                              </div>
                           </div>
                           <div class="media-body">
                                 <span class="counter-txt f-w-600 f-20">
                                         <span class=" ">{{number_format($vendorPayable,2)}}</span>
                                 </span>
                              <h6 class="f-w-300 m-t-5">Vendors Payable</h6>
                           </div>
                        </div>
                        <ul>
                           <li class="new-users">
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>


            </div>

            <div class="row">
               <!-- INVOICE STATISTICS start -->
               <div class="col-xl-4 col-lg-6 col-md-12 default-grid-item ">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Invoice Statistics</h5></div>
                     <div class="card-block">
                        <div class="table-responsive">
                           <table class="table m-b-0">
                              <tbody>
                                 <tr>
                                    <th>Total Invoices</th>
                                    <td>30</td>
                                    <td><a href="#">1,498.50 $</a>
                                    </td>

                                 </tr>
                                 <tr>
                                    <th>Total Paid</th>
                                    <td>25</td>
                                    <td><a href="#">1,248.75 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Total Due</th>
                                    <td>5</td>
                                    <td><a href="#">249.75 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Total Overdue</th>
                                    <td>0</td>
                                    <td><a href="#">0.00 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Total Shipping</th>
                                    <td>25</td>
                                    <td><a href="#">150.00 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Total Amount</th>
                                    <td>50</td>
                                    <td><a href="#">250.25 $</a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>
               <!--  INVOICE STATISTICS end -->

               <!-- Sales Statistics start -->
               <div class="col-xl-4 col-lg-6 col-md-12 default-grid-item ">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Sales Statistics</h5></div>
                     <div class="card-block">
                        <div class="table-responsive">
                           <table class="table m-b-0">
                              <tbody>
                                 <tr>
                                    <th>Signups This Month</th>
                                    <td>30</td>
                                    <td><a href="#">25.10 $</a>
                                    </td>

                                 </tr>
                                 <tr>
                                    <th>Sales This Month</th>
                                    <td>25</td>
                                    <td><a href="#">1,248.75 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Signups This Year</th>
                                    <td>30</td>
                                    <td><a href="#">1,115.2 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Sales This Year</th>
                                    <td>25</td>
                                    <td><a href="#">1,248.75 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Signups This Week</th>
                                    <td>20</td>
                                    <td><a href="#">1,50.75 $</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Sale This Week</th>
                                    <td>5</td>
                                    <td><a href="#">1,48.75 $</a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>

               <!--  Sales Statistics end -->
               <div class="col-xl-4 col-lg-12 col-md-12 default-grid-item ">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Invoice Statistics</h5></div>
                     <div class="card-block">
                        <div class="technical-skill">
                           <div>
                              <h6>Pending</h6>
                              <div class="faq-progress">
                                 <div class="progress">
                                    <span class="faq-text1"></span>
                                    <div class="faq-bar1"></div>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <h6>Processing</h6>
                              <div class="faq-progress">
                                 <div class="progress">
                                    <span class="faq-text2"></span>
                                    <div class="faq-bar2"></div>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <h6>Ready For Delivery</h6>
                              <div class="faq-progress">
                                 <div class="progress">
                                    <span class="faq-text5"></span>
                                    <div class="faq-bar5"></div>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <h6>Delivered</h6>
                              <div class="faq-progress">
                                 <div class="progress">
                                    <span class="faq-text4"></span>
                                    <div class="faq-bar4"></div>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <h6>Cancelled</h6>
                              <div class="faq-progress">
                                 <div class="progress">
                                    <span class="faq-text3"></span>
                                    <div class="faq-bar3"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

      <script type="text/javascript">
         var data1 = [
            @foreach($sales as $saleValue)
               { y: '{{$saleValue->branch_name}}', a: {{$saleValue->cash}},  b: {{$saleValue->CreditCard}} , c:{{$saleValue->CustomerCredit }}},
           @endforeach
         ];

      </script>
               <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-xl-4  " >
      
                  <div class="card" style="height: 380px;">
                     <div class="card-header">
                        <h5 class="card-header-text">Daily Sales Chart</h5>
                     </div>
                     <div  class="card-block">
                        <div id="bar-example1" class="" style="height: 260px;">
                           <script type="text/javascript">
                            var $arrColors = [ '#666', '#3498DB','#7D3323','#48C9B0','#2471A3','#6C3483','#6E2C00','#F1C40F','#73C6B6','#34495E'];
                            Morris.Bar({
                                element: 'bar-example1',
                                barGap:1,
                                barSizeRatio:0.35,
                                data: data1,
                                xkey: 'y',
                                ykeys: ['a', 'b' , 'c'],
                                labels: ['Cash', 'CreditCard', 'CustomerCredit']
                              });
                               
                             </script>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12  col-xl-4 col-lg-12 " >
      
                  <div class="card" style="height: 380px;">
                     <div class="card-header">
                        <h5 class="card-header-text">Monthly Sales Chart</h5>
                     </div>
                     <div  class="card-block">
                        <div id="bar-example" class="" style="height: 260px;">
                           <script type="text/javascript">
                            var $arrColors = ['#34495E', '#26B99A',  '#666', '#3498DB','#7D3323','#48C9B0','#2471A3','#6C3483','#6E2C00','#F1C40F','#73C6B6','#34495E'];
                            
                                 Morris.Bar({
                                       barGap:1,
                                       barSizeRatio:0.25,
                                      element: 'bar-example',
                                      data : [
                                      
                                        {"x" : 'January',"y" : '500'},
                                        {"x" : 'February',"y" : '1000'},
                                        {"x" : 'March',"y" : '1500'},
                                        {"x" : 'April',"y" : '2000'},
                                        {"x" : 'May',"y" : '2500'},
                                        {"x" : 'June',"y" : '800'},
                                        {"x" : 'July',"y" : '3000'},
                                        {"x" : 'August',"y" : '2500'},
                                        {"x" : 'September',"y" : '500'},
                                        {"x" : 'October',"y" : '100'},
                                        {"x" : 'November',"y" : '3500'},
                                        {"x" : 'December',"y" : '4000'},
                                      
                                      ],
                                      xkey : 'x',
                                      ykeys : ['y'],
                                       barColors: function (row, series, type) {
                                          return $arrColors[row.x];
                                      }, 
                                      labels : ['Added']
                                    });
                             </script>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

           

            <div class="row">
               <div class="col-md-6 col-xl-6 col-lg-6">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-header-text">Top 5 Products</h5>
                        </div>
                        <div class="card-block">
                           <div id="donut-example">

                             <script type="text/javascript">

                                 Morris.Donut({
                                     element: 'donut-example',
                                     data: [
                                       @foreach($products as $key => $value)

                                          { label: "{{$value->product_name}}", value: '{{$value->count}}',labelColor: 'red', },
                                       @endforeach
                                     ],
                                     colors: ['#EC407A', '#00897B',  '#C0CA33', '#9CC4E4','#7D3323'],
                                 });
                             </script>
                           </div>
                        </div>
                     </div>
                  </div>


                   <div class="col-lg-6 col-md-6 col-xl-6 ">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Yearly Chart</h5>
                     </div>
                     <div class="card-block">
                        <div id="line-example">
                           <script type="text/javascript">
                                 Morris.Line({
                                      element: 'line-example',
                                      data: [
                                      @foreach($year as $value)
                                          { y: '{{$value->year}}', a: '{{$value->amount}}' },
                                       @endforeach  
                                      ],
                                      xkey: 'y',
                                      redraw: true,
                                      ykeys: ['a'],
                                      labels: ['Series A'],
                                      lineColors :['#2196F3']
                                    });
                             </script>
                        </div>
                     </div>
                  </div>
               </div>

               </div>

<div class="modal fade modal-flex" id="Modal-tab" tabindex="-1" role="dialog">
                           <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content ">
                                 <div class="modal-body ">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    <ul class="nav nav-tabs" role="tablist" id="terminalTab">
                                       <li class="nav-item">
                                          <a class="nav-link active" data-toggle="tab" href="#tab-home" role="tab">Home</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#tab-profile" role="tab">Profile</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#tab-messages" role="tab">Messages</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#tab-settings" role="tab">Settings</a>
                                       </li>
                                    </ul>
                                    <div class="tab-content modal-body">
                                       <div class="row text-center text-primary" >
                                          <h1>Terminal Name</h1>
                                       </div>

                                       <div class="row dashboard-header m-t-5">
                                          <div class="col-lg-4 col-md-4">
                                             <div class="card dashboard-product">
                                                <span class="label label-info">OPENING</span>
                                                <h2 class="dashboard-total-products">4500</h2>
                                               <!--  <span class="label label-info">OPENING</span> -->
                                                <div class="side-box">
                                                   <i class="icon-cursor text-info-color"></i>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-4 col-md-4">
                                             <div class="card dashboard-product">
                                                <!-- <span>TOTAL SALES</span> -->
                                                 <span class="label label-warning">TOTAL SALES</span>
                                                <h2 class="dashboard-total-products">4500</h2>
                                              
                                                <div class="side-box">
                                                   <i class="icon-handbag text-warning-color"></i>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-4 col-md-4" >
                                             <div class="card dashboard-product" style="border-color: #CD5C5C;">
                                              <!--   <span>CLOSING</span> -->
                                                 <span class="label label-danger">CLOSING</span>
                                                <h2 class="dashboard-total-products">4500</h2>
                                               
                                                <div class="side-box">
                                                   <i class="icon-vector text-danger-color"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                    <div class="row dashboard-header m-t-5">
                                       <div class="col-lg-4 col-md-4 grid-item">
                                          <div class="card">
                                             <div class="row">
                                                <div class="col-sm-12 d-flex">
                                                   <div class="col-sm-5 bg-warning">
                                                      <div class="p-10 text-center">
                                                         <i class="icofont icofont-cur-dollar f-64"></i>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                      <div class="text-center">
                                                         <h3 class="txt-warning f-34" id="MyClockDisplay" class="clock" >Rs. 1500</h3>
                                                         <span class="text-default  f-18">TAKE AWAY</span>

                                                      </div>
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                       </div>


                                       <div class="col-lg-4 col-md-4 grid-item">
                                          <div class="card">
                                             <div class="row">
                                                <div class="col-sm-12 d-flex">
                                                   <div class="col-sm-5 bg-info">
                                                      <div class="p-10 text-center">
                                                         <i class="icofont icofont-cur-dollar f-64"></i>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                      <div class="text-center">
                                                         <h3 class="txt-warning  f-w-50"  class="clock" >Rs. 1500</h3>
                                                         <span class="text-default f-18 ">ONLINE</span>

                                                      </div>
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                       </div>

                                       <div class="col-lg-4 col-md-4 grid-item">
                                          <div class="card">
                                             <div class="row">
                                                <div class="col-sm-12 d-flex">
                                                   <div class="col-sm-5 bg-primary">
                                                      <div class="p-10 text-center">
                                                         <i class="icofont icofont-cur-dollar f-64"></i>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                      <div class="text-center">
                                                        <h3 class="txt-warning f-34" id="MyClockDisplay" class="clock" >Rs. 1500</h3>
                                                         <span class="text-default  f-18">DELIVERY</span>

                                                      </div>
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                       </div>
                                    </div>

                                    <table width="100%" class="table table-responsive nowrap">
                                      <tr >
                                        <td style="width:500px">Opening Balance</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Cash Sale</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Credit Card Sale</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Customer Credit Sale</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Total Sale</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Total Receipt Item Cost</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Customer Credit Return Cash</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Customer Credit Return Credit</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Customer Credit Return Cheque</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Bank Deposit</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Expense</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Purchase</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Sale Return</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Discount</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                      <tr >
                                        <td style="width:500px">Cash In</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                      <tr >
                                        <td style="width:500px">Cash Out</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Coupon</td>
                                        <td style="width:500px">2</td>
                                     </tr>
                                     <tr >
                                        <td style="width:500px">Cash In Hand</td>
                                        <td style="width:500px">2</td>
                                     </tr>

                                    </table>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>          
@endif
@endsection

@section('scriptcode_three')

<script type="text/javascript">

  <?php if(session('login_msg')) { ?> 

   $(document).ready(function(){

       notify('{{ session("login_msg") }}', 'success');
       <?php $_SESSION['login_msg'] = ''; ?>
   });

  <?php
    }
  ?>

  function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + " " + session;
    $('#MyClockDisplay').html(time);
    // document.getElementById("MyClockDisplay").innerText = time;
    // document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

let total = "{{$orders[0]->total}}";
let pending = "{{$orders[0]->pending}}";
let processing = "{{$orders[0]->processing}}";
let ready = "{{$orders[0]->ready}}";
let delivered = "{{$orders[0]->delivery}}";
let cancelled = "{{$orders[0]->cancelled}}";

let pendingpercentage = pending / total * 100;
let processingpercentage = processing / total * 100;
let readypercentage = ready / total * 100;
let deliveredpercentage =  delivered / total * 100;
let cancelledpercentage =  cancelled / total * 100;


showTime();

"use strict";
 $(document).ready(function() {
     var progression1 = 0;
     var progression2 = 0;
     var progression3 = 0;
     var progression4 = 0;
     var progression5 = 0;
     var progress = setInterval(function()
     {

         $('.progress .faq-text1').text(progression1 + '%');
         $('.progress .faq-text1').css({'left':progression1+'%'});
         $('.progress .faq-text1').css({'top':'-20px'});
         $('.progress .faq-bar1').css({'width':progression1+'%'});

         if(progression1 == parseInt(pendingpercentage)) {
             clearInterval(progress);

         } else
             progression1 += 1;

     }, 100);

     var progress1 = setInterval(function()
     {
         $('.progress .faq-text2').text(progression2 + '%');
         $('.progress .faq-text2').css({'left':progression2+'%'});
         $('.progress .faq-text2').css({'top':'-20px'});
         $('.progress .faq-bar2').css({'width':progression2+'%'});
         if(progression2 == parseInt(processingpercentage)) {
             clearInterval(progress1);

         } else
             progression2 += 1;

     }, 100);
     var progress2 = setInterval(function()
     {
         $('.progress .faq-text5').text(progression3 + '%');
         $('.progress .faq-text5').css({'left':progression3+'%'});
         $('.progress .faq-text5').css({'top':'-20px'});
         $('.progress .faq-bar5').css({'width':progression3+'%'});
         if(progression3 == parseInt(readypercentage)) {
             clearInterval(progress2);

         } else
             progression3 += 1;

     }, 100);
     var progress3 = setInterval(function()
     {
         $('.progress .faq-text4').text(progression4 + '%');
         $('.progress .faq-text4').css({'left':progression4+'%'});
         $('.progress .faq-text4').css({'top':'-20px'});
         $('.progress .faq-bar4').css({'width':progression4+'%'});
         if(progression4 == parseInt(deliveredpercentage)) {
             clearInterval(progress3);

         } else
             progression4 += 1;

     }, 100);
     var progress4 = setInterval(function()
     {
         $('.progress .faq-text3').text(progression5 + '%');
         $('.progress .faq-text3').css({'left':progression5+'%'});
         $('.progress .faq-text3').css({'top':'-20px'});
         $('.progress .faq-bar3').css({'width':progression5+'%'});
         if(progression5 == parseInt(cancelledpercentage)) {
             clearInterval(progress4);

         } else
             progression5 += 1;

     }, 100);


      
       
   $('#contact-list').DataTable({
        fixedHeader: true,
        "scrollY": 572,
        "paging":  false,
        "ordering": false,
        "bLengthChange": false,
        "searching": false,
        "info":     false

    });

   // add scroll to data table
   $(".dataTables_scrollBody").slimScroll({
                height: 675,
                 allowPageScroll: false,
                 wheelStep:5,
                 color: '#000'
           });

    });

   function getdetails()
   {

      window.location = "{{url('sales-details')}}";
      // alert(terminal)
      // if (terminal == "branch") 
      // {

      //   $('#Modal-tab').modal("show");
      //    getTerminals(branch);

         
      // }
      // else
      // {
      //    $('#Modal-tab').modal("show");
      // }
   }


   function getTerminals(branch)
   {
      $.ajax({
            url : "{{url('/getTerminals')}}",
            type : "POST",
            data : {_token : "{{csrf_token()}}",branch:branch},
            dataType : 'json',
            success : function(result){
               console.log(result)
                $('#terminalTab').html('');
               $.each(result, function( index, value ) {
                  $('#terminalTab').append(
                     "<li class='nav-item'><a class='nav-link "+(index == 0 ? "active" : "")+"'  data-toggle='tab' href='#tab-home' role='tab'>" +value.terminal_name+"</a></li>"
                  );
               });
            }
       });
   }
  getcheques();

   function getcheques() {

      var d = new Date(),
              month = '' + (d.getMonth() + 1),
              day = '' + d.getDate(),
              year = d.getFullYear();

      if (month.length < 2)
         month = '0' + month;
      if (day.length < 2)
         day = '0' + day;

      var today = [year, month, day].join('-');

      const date = moment(new Date());
      date.add(1, 'days');
      var tomorrow = date.format('YYYY-MM-DD'); //

      $.ajax({
         url : "{{url('/getcheques')}}",
         type : "GET",
         data : {_token : "{{csrf_token()}}",
         },
         dataType : 'json',
         success : function(result){
            if(result){
               $("#tblcheques tbody").empty();
               for(var count =0;count < result.length; count++){
                  $("#tblcheques tbody").append(
                          "<tr>" +
                          "<td>"+today+"</td>" +
                          "<td>"+result[count].todays+"</td>" +
                          "<td><a href='{{url('/chequemodule')}}/"+today+"'><i class='icofont icofont-eye-alt'></i></a></td>" +
                          "</tr>"+
                          "<tr>" +
                          "<td>"+tomorrow+"</td>" +
                          "<td>"+result[count].tomorrow+"</td>" +
                          "<td><a href='{{url('/chequemodule')}}/"+tomorrow+"'><i class='icofont icofont-eye-alt'></i></a></td>" +
                          "</tr>"
                  );
               }

            }
         }
      });
   }

   function openReport() {

      window.location = "{{url('profitLossStandardReport')}}"+"?fromdate={{$currentDate}}&todate={{$currentDate}}";
   }

  function openExpenseReport() {

     window.location = "{{url('expense-report-pdf')}}"+"?first={{$currentDate}}&second={{$currentDate}}";
  }


</script>
@endsection