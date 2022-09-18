<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Barcode</title>
      <style type="text/css">
         * {
         font-family: Verdana, Arial, sans-serif;
         }
         table{
         font-size: x-small;
         }
         tfoot tr td{
         font-weight: bold;
         font-size: x-small;
         }
         .gray {
         background-color: lightgray
         }
         .font{
         font-size: 15px;
         }
         .authority {
         /*text-align: center;*/
         float: right
         }
         .authority h5 {
         margin-top: -10px;
         color: black;
         /*text-align: center;*/
         margin-left: 35px;
         }
         .thanks p {
         color: black;;
         font-size: 16px;
         font-weight: normal;
         font-family: serif;
         margin-top: 20px;
         }
      </style>
   </head>
   <body>
      <table width="100%" style="background: #F7F7F7; padding:5px 20px 5px 20px;">
         <tr>
            <td valign="top" style="text-align:center">
               Barcode
            </td>
            <!--<td align="right">-->
            <!--   <pre class="font" >-->
            <!--   Flipmart Head Office-->
            <!--   Email:support@flipmart.com <br>-->
            <!--   Mob: +44(0) 1244 2312 <br>-->
            <!--   London 1207,New Jersy:#4 <br>-->
              
            <!--</pre>-->
            <!--</td>-->
         </tr>
      </table>
      <table width="100%" style="background:white; padding:2px;"></table>
      <table width="100%" style="padding:10px;" class="font">
          	
     
         <tr>
         <div style="text-align:center"> 
       
             
            @php
                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
            @endphp
            <p style="margin:0;font-size:14px">{{$product->title}} - {{$size}}</p>
            <p style="margin:0;font-size:14px">{{$barcode}}</p>
            <p style="margin:0 0 3px 0;font-size:14px">Style: {{$product->article_no}}</p>
                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barcode, $generatorPNG::TYPE_CODE_128)) }}" class="img-fluid" style="margin-bottom:5px" height="60" width="180">
            <!--<div style="height:1.5in;width:2in">-->

                    <div>
                        <p style="font-size:14px;margin:0">
                         Shahid Afridi Store<br/> {{$subcategory->title}} - {{$color->title}}
                        </p>
                    </div>
                    <h5 style="margin:0">
                        Rs.{{$product->price}} (inclusive of all taxes)
                    </h5>
     
         </div>
            <!--</div>-->
         </tr>
  

      <!--</table>-->
      <br/>
    
     
   </body>
</html>