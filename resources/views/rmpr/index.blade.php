@extends('common.layout')

@section('navbar')

@stop

@section('leftmenu')

@stop


@section('content')

    <div class="panel panel-default" style="margin-top: -25px;">


       <div class="panel-body" style="min-height: 500px;">

           <ul id="myTab" class="nav nav-tabs">
               <li  id="prconfirm"><a href="javasript:;" >PR List</a></li>
               <li  id="prcreate" class="active"><a href="javasript:;" >Create PR</a></li>
               <li  id="purchase"><a href="javasript:;" >RM purchase</a></li>
           </ul>


           <div style="margin-top: 20px">
           <p id="msg" class="text-success"></p>
           <div id = 'prcreatetab'>
               <button id="check" type="button"  class="btn btn-primary" style="">Check Raw Material List</button>
               <button id="rmprsubmit" type="button"  class="btn btn-primary" style="">Submit PR</button>
               <div id = 'rmprlist' style="margin-top: 20px;">

               </div>
           </div>

           <div id = 'prconfirmtab' class="">
               <table class="table" id="prlist" style="width:500px;border-radius: 20px;border: 2px solid #8AC007;">
                   <thead>
                   <tr style="height: 30px;vertical-align: middle;border: 2px solid #8AC007; ">
                       <th style="width:30%;text-align:center;border: 2px solid #8AC007;">PR number</th>
                       <th style="width: 30%;text-align:center;border: 2px solid #8AC007;">Created date</th>
                       <th style="width: 40%;text-align:center;border: 2px solid #8AC007;" >Action</th>
                   </tr>
                   </thead>
                   <tbody>

                   @foreach($prs as $pr)
                   <tr style="height: 30px;vertical-align: middle;border: 2px solid #8AC007;">
                       <td style="width:30%;text-align:left;border: 2px solid #8AC007;">{{$pr->id}}</td>
                       <td style="width: 30%;border: 2px solid #8AC007;">{{date("m-d",$pr->created_at)}}</td>
                       <td style="width: 40%;border: 2px solid #8AC007;" ><a href="javascript:;" class="prupdate">Update</a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="prconfirm">Confirm</a> </td>
                   </tr>
                   @endforeach
                   </tbody>
               </table>

               <div id = 'praction' class=""></div>


           </div>

               <div id = 'purchasetab' class="">
                   <div class="container">
                       <div class="row" >
                           <div class="col-lg-3" >
                               <input type="text" class=" form-control " id="maincode" placeholder="Search by main code">
                           </div>
                       </div>

                       <div class="container">
                           <div class="row col-lg-11" style="margin-top: 20px;border-radius: 5px;border: 1px solid #8AC007;padding-top: 25px;padding-bottom: 25px">

                               <form class="form-inline" role="form">
                                   <div class="form-group">
                                       <label class="" for="">Serial Number:</label>
                                       <input type="text" class="form-control" id="serialnum" placeholder="" disabled>
                                   </div>

                                   <div class="form-group" style="margin-left: 30px">
                                       <label class="" for="">Grade Name:</label>
                                       <input type="text" class="form-control" id="gradename" placeholder="">
                                   </div>

                                   <div class="form-group" style="margin-left: 30px">
                                       <label class="" for="">SR:</label>
                                       <input type="text" class="form-control" id="sr" placeholder="">
                                   </div>
                                   <button style="margin-left: 0" type="button" id="gradenamesubmit" class="btn btn-primary pull-right">Submit</button>


                                   <div class="row col-lg-12 ">

                                       <div class="form-group " style="margin-left: 30px;margin-top: 20px;">
                                           <label class="" for="">Comment:</label>
                                           <textarea class="form-control " id="comment" rows="2" cols="80"></textarea>
                                       </div>
                                   </div>

                               </form>

                           </div>
                       </div>


                   </div>

               </div>



           </div>


           <script type="text/javascript">

               $('.navpr').addClass("active");
               $('#prconfirmtab').show().siblings().hide();
               $('#prconfirm').addClass("active").siblings().removeClass("active");


               rmprsettings = {
                   minRows: 20,
                   minCols: 8,
                   maxRows: 50,
                   maxCols:8,
                   fillHandle: {
                       direction: false,
                       autoInsertRow: false
                   },
                   rowHeaders: true,
                   readOnly: false,
                   wordWrap:false,
                   rowHeaderWidth:60,
                   rowHeights:30,
                   columnHeaderHeight:40,
                   colHeaders: [ 'SAP code','Material description','Current stock','Ongoing PR quantity','Block quantity','Safety quantity','New PR','Comment'],
                   columns: [
                       {},
                       {},
                       {},
                       {},
                       {},
                       {},
                       {},
                       {readOnly:false}
                   ],

                   colWidths: [120, 200, 100,150, 150, 100,100,150],
                   minSpareRows: 0
               };
               rmprhot = new Handsontable(rmprlist, rmprsettings);


           </script>

           <script type="text/javascript">



               $("#prconfirm").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#prconfirmtab').show().siblings().hide();
               });

               $("#prcreate").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#prcreatetab').show().siblings().hide();
                   $('#check').show().siblings().hide();
               });

               $("#check").click(function() {
                   $.ajax({
                       type: 'get',
                       url: '{{url('pr/checkPrList')}}',
                       dataType: 'json',
                       success: function (res) {
                           $('#check').hide().siblings().show();
                           rmprhot.loadData(res);
                       }
                   });
               });

               $("#rmprsubmit").click(function() {

                   var rmpr = rmprhot.getData();
                   var emptyrows = rmprhot.countEmptyRows();
                   if(rmpr.length !== emptyrows) {
                       for (var i = 0, j = 0; i < rmpr.length; i++) {
                           if (rmprhot.isEmptyRow(i)) {
                               rmpr.splice(j, 1);
                           }
                           else {
                               j++;
                       }
                   }
//                       console.log(rmpr);

                   $.ajax({
                       type: 'POST',
                       url: '{{url('pr/createPr')}}',
                       data:{
                           data: rmpr,
                           '_token':'{{csrf_token()}}'
                       } ,
                       dataType: 'json',
                       success: function (res) {
                           console.log(res);
                           rmprhot.updateSettings({
                               minCols: 4,
                               maxCols:4,
                               rowHeaders: true,
                               readOnly: true,
                               wordWrap:false,
                               rowHeaderWidth:60,
                               rowHeights:30,
                               columnHeaderHeight:40,
                               colHeaders: [ 'SAP code','Material description','PR quantity','Status'],
                               colWidths: [150, 250, 150,200]
                           });
                           $('#rmprsubmit').hide();
                           rmprhot.loadData(res);
                       }
                   });

                   }
               });

               $("#purchase").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#purchasetab').show().siblings().hide();

               });

           </script>






    </div>



    </div>




@stop

