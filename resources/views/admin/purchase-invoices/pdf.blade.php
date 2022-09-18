<!DOCTYPE html>
<html>
<head>
    <title>Sale Invoice</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> --}}

    <style>

        body{
            
        }

        .container{
            overflow: hidden;
            /* max-width: 595px; */
            /* margin: auto; */
            border: 1px solid black;
            background: white;
            /* padding: 5px 10px; */
        }

        .flex::after{
            content: "";
            clear: both;
            display: table;
        }

  

        .flex-10{
            width: 10%;
            float: left;
        }

        .flex-20{
            width: 20%;
            float: left;
        }

        .flex-30{
            width: 30%;
            float: left;
        }

        .flex-40{
            width: 40%;
            float: left;
        }

        .flex-50{
            width: 50%;
            float: left;
        }

        .flex-60{
            width: 60%;
            float: left;
        }

        .flex-70{
            width: 70%;
            float: left;
        }

        .flex-80{
            width: 80%;
            float: left;
        }

        .flex-90{
            width: 90%;
            float: left;
        }

        .flex-100{
            width: 100%;
            float: left;
        }

        .align-self-center{
         align-self: center;
        }

        .text-center{
            text-align: center;
        }

        .text-left{
            text-align: left;
        }

        .text-right{
            text-align: right;
        }


        body{
            font-family: "Poppins",sans-serif;
        }


        /* ------------topbar------------ */

            .topbar{
                background-color: #3281f2;
                color: white;
                padding: 14px 15px;
            }

            .topbar p{
                margin: 0px;
            }



    
        /* Address Section */

            .address-section{
                margin-top: 9px;
                padding: 2px 13px;
            }

            .address-section .logo{
                width: 66px;
            }

            .address-section .title{
                font-size: 28px;
                margin: 0px 14px;
                top: -13px;
                position: relative;
            }

            .address-section h6{
                font-size: 20px;
                margin: 0px 0px;
            }

            .address-section ul{
                list-style: none;
                padding: 0px 0px;
                margin: 6px 0px 13px 0px;
            }


            /* Invoice Header */

            .invoice-header {
                padding: 13px 10px;
            }

            .invoice-header table{
                margin: auto;
                width: 100%;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
            }

            .invoice-header table th{
                border: 1px solid #ddd;
                text-align: center;
                padding: 12px 0px;
                background-color: #3281f2;
                color: white;

            }

            .invoice-header table td{
                border: 1px solid #ddd;
                padding: 8px;
            }

            .invoice-header th {
                padding-top: 12px 0px;
                text-align: left;
                background-color: #3281f2;
                color: white;
            }

            hr{
                margin-top: 20px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1px solid #eee;
            }
                
    </style>
</head>
<body>
    <?php 

       $vendor = $invoice->items[0]->receipt->purchase->vendor;
       $receipts =  $invoice->items[0];
       $total = 0; 

     

       $path = public_path().'/admin/images/logo.jpeg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

     
    
    ?>
    <div class="container">
       
        <div class="flex wrap topbar ">
            <div class="flex-item flex-50">
                <p  >Purchase Invoice: #{{$invoice->pi}}<p>    
            </div>
            <div class="flex-item flex-50 text-right topbar__details align-self-center" >
                <p>Date: {{$invoice->created_at}}<p>
            </div>
         </div>

  
         <div class="flex wrap address-section">
            <div class="flex-50 text-left">

                <img class="logo" src="{{$base64}}" />
                <span class="title">AHMED FABRICS</span>
                <ul>
                    <li>PLOT # D-94 A SHERSHA ROAD</li>
                    <li>Site, Karachi</li>
                    <li>NTN:2654077-7</li>
                    <li>STRN:3277876235794</li>
                </ul>

            </div>
            <div class="flex-50 text-right">
                <h6>Ship To:</h6>
                <ul>
                    <li>AHMED FABRICS</li>
                    <li>PLOT # D-94 A SHERSHA ROAD</li>
                    <li>Site, Karachi</li>
                    <li>NTN:2654077-7</li>
                    <li>STRN:3277876235794</li>
                </ul>

                <h6>Payment Details:</h6>
                <ul>
                    <li>AHMED FABRICS</li>
                    <li>PLOT # D-94 A SHERSHA ROAD</li>
                </ul>

            </div>
         </div>

         <hr>
         <div class="invoice-header">
            <table >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rceipt</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total</th>
                    </tr>        
                </thead>
                <tbody>

                      @foreach($invoice->items as $invoiceItem)

                            @foreach($invoiceItem->receipt->items as $key => $receiptItem)      
                            <?php $total +=  $receiptItem->total; ?>
                            <tr>
                                <td class="text-center" >{{$receiptItem->id}}</td>
                                <td>{{$invoiceItem->receipt->po}}</td>
                                <td>{{$receiptItem->product->title}}</td>
                                <td class="text-center" >{{$receiptItem->qty}}</td>
                                <td class="text-center">{{$receiptItem->rate}}</td>
                                <td class="text-center" >{{number_format($receiptItem->rate,2)}}</td>
                            </tr>
                            @endforeach

                       
                
                    @endforeach

                    <?php
                        $calc = ( $total / $invoice->gst ) * 100;
                        $gtotal = $total + $calc;
                    ?>

                    <tr>
                        <td rowspan="3" colspan="4">
                            <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.  <br>Lorem Ipsum has been the industry's standard dummy <br> text ever since the 1500s, when an unknown printer took a galley of type and scram
                          </p>
                        </td>
                        <td style="font-weight: bold" class="text-center">Subtotal:</td>
                        <td class="text-center" >{{number_format($total,2)}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold" class="text-center">GST {{$invoice->gst}}%:</td>
                        <td class="text-center" >{{number_format($calc,2)}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold" class="text-center">Grand Total:</td>
                        <td class="text-center" >{{number_format($gtotal,2)}}</td>
                    </tr>
                
                </tbody>
              </table>
         </div>

         <div class="flex wrap topbar ">
            <div class="flex-item flex-50">
                <p>© 2022 Ahemd Febrics.  All rights reserved.<p>    
            </div>
            <div class="flex-item flex-50 text-right topbar__details align-self-center" >
                <p>www.ahmedfabrics.com<p>
            </div>
         </div>
    
    </div> 
</body>
</html>