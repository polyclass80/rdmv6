@extends('common.layout')

@section('navbar')

@stop

@section('leftmenu')

@stop


@section('content')

    <div class="panel panel-default" style="margin-top: -25px;">


       <div class="panel-body" style="min-height: 500px;">

           <ul id="myTab" class="nav nav-tabs">
               <li  id="rmcode" class="active"><a href="javasript:;" >Search Inventory by Code</a></li>
               <li  id="rmupdate"><a href="javasript:;" >Update RM </a></li>
               <li  id="rmdes"><a href="javasript:;" >Search RM code</a></li>
           </ul>


           <div style="margin-top: 20px">
           <p id="msg" class="text-success"></p>
           <div id = 'rmcodetab'>

           </div>

           <div id = 'rmdestab' class="">

               <div id='rmdessearch' style="margin-top: 20px; ">

                   <div class="col-sm-3"  >
                       <input type="text" class="form-control " id="rmsearch" placeholder="Search..." required>
                   </div>
                   <div class="col-sm-12" style="margin-top: 25px">
                   Search by：
                   <label class="radio-inline">
                       <input type="radio" name="searchtype"  value="0" checked>Raw material type code
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="searchtype"   value="1"> Raw material description
                   </label>
                   <button id="rmsearchsubmit" type="button"  class="btn btn-primary" style="margin-left: 100px;">Search</button>
                   </div>
               </div>

               <div id = 'searchresult' class="col-sm-12" style="margin-top: 40px; margin-bottom: 50px">


               </div>

           </div>



               <div id = 'rmupdatetab' class="">
                   <div id = 'rmupdatehot' class="">


                   </div>

                   <div id = 'rmupdateresulthot' class="">


                   </div>
                   <div id='updateaction' style="margin-top: 20px">
                       Action type：
                       <label class="radio-inline">
                           <input type="radio" name="updatetype"  value="0" checked>出入库
                       </label>
                       <label class="radio-inline">
                           <input type="radio" name="updatetype"   value="1"> 盘点
                       </label>
                       <button id="submit" type="button"  class="btn btn-primary" style="margin-left: 100px;">Submit</button>
                   </div>
               </div>




           </div>


           <script type="text/javascript">

               $('.navinventory').addClass("active");
               $('#rmcodetab').show().siblings().hide();
               var     settings,
                       hot;
               settings = {

                   minRows: 10,
                   minCols: 5,
                   maxRows: 20,
                   maxCols:5,
                   fillHandle: {
                       direction: 'vertical',
                       autoInsertRow: false
                   },
                   rowHeaders: true,
                   readOnly: true,
                   rowHeaderWidth:60,
                   rowHeights:30,
                   columnHeaderHeight:40,
                   colHeaders: [ 'SAP code','Material description','Current stock', 'Blocked quantity', 'Location'],
                   colWidths: [200, 250, 200, 200, 200],
                   columns: [
                       { readOnly: false  },
                       {},
                       {},
                       {},
                       {}
                   ],
                   minSpareRows: 0,
                   afterChange: function (change, source) {
                       if (source === 'loadData') {
                           return; //don't save this change
                       }
                       $.ajax({
                           type: 'GET',
                           url: '{{url('inventory/getInventory')}}',
                           data: {"data": change},
                           dataType: 'json',
                           success: function (res) {
                                hot.loadData(res);

                           }
                       });
                   }
               };

               hot = new Handsontable(rmcodetab, settings);


               var data = [],
                       updatesettings,
                       updatehot;

               updatesettings = {
                   data: data,
                   minRows: 10,
                   minCols: 4,
                   maxRows: 20,
                   maxCols:4,
                   fillHandle: {
                       direction: 'vertical',
                       autoInsertRow: false
                   },
                   afterChange: function (change, source) {
                       if (!(source === 'loadData')) {

                           if(updatehot.getData().length == updatehot.countEmptyRows()){
                               $('#submit').hide();
                           }
                           else {
                               $('#submit').show();
                           }

                       }
                   },
                   rowHeaders: true,
                   readOnly: false,
                   rowHeaderWidth:60,
                   rowHeights:30,
                   columnHeaderHeight:40,
                   colHeaders: [ 'Material description','SAP code','Update quantity', 'Location'],
                   colWidths: [250, 200, 200, 200],
                   columns: [
                       {},
                       {},
                       {},
                       {}
                   ],
                   minSpareRows: 0

               };
               updatehot = new Handsontable(rmupdatehot, updatesettings);

               var     searchresulthot,
                       searchresultsettings = {
                           data: data,
                           minRows: 10,
                           minCols: 3,
                           maxRows: 20,
                           maxCols:3,
                           fillHandle: {
                               direction: 'vertical',
                               autoInsertRow: false
                           },
                           rowHeaders: true,
                           readOnly: true,
                           rowHeaderWidth:60,
                           rowHeights:30,
                           columnHeaderHeight:40,
                           colHeaders: [ 'SAP code','Material description','Location'],
                           colWidths: [200, 250, 200],
                           columns: [
                               {},
                               {},
                               {}
                           ],
                           minSpareRows: 0,
                       };

               searchresulthot = new Handsontable(searchresult, searchresultsettings);


               var     updateresultsettings,
                       updateresulthot;

               updateresultsettings = {

                   minRows: 1,
                   minCols: 5,
                   maxRows: 20,
                   maxCols:5,
                   fillHandle: {
                       direction: false,
                       autoInsertRow: false
                   },
                   rowHeaders: true,
                   readOnly: true,
                   rowHeaderWidth:60,
                   rowHeights:30,
                   columnHeaderHeight:40,
                   colHeaders: [ 'Material description','SAP code','Current quantity', 'Location','Update Status'],
                   colWidths: [250, 150, 150, 150,250],
                   minSpareRows: 0

               };

           </script>


           <script type="text/javascript">


               $("#rmcode").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#rmcodetab').show().siblings().hide();
                   hot.loadData([]);
               });

               $("#rmdes").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');

                   $('#rmdestab').show().siblings().hide();



               });

               $("#rmtype").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#rmtypetab').show().siblings().hide();

               });

               $("#rmupdate").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#rmupdatetab').show().siblings().hide();
                   $('#rmupdateresulthot').hide().siblings().show();
                   $('#submit').hide();
                   $('#msg').html('');
                   updatehot.loadData([]);

               });

               $("#submit").click(function() {

                   $('#msg').html('更新成功！').show();

                   var updatedata = updatehot.getData();

                   updatedata.splice(updatedata.length - updatehot.countEmptyRows(),updatehot.countEmptyRows());

                   $.ajax({
                       type: 'POST',
                       url: '{{url('inventory/updateInventory')}}',
                       data: {
                           updatetype: $( "input[type=radio][name = updatetype]:checked" ).val(),
                           data: updatedata,
                           '_token':'{{csrf_token()}}'
                       },
                       dataType: 'json',
                       success: function (res) {
                           $('#rmupdateresulthot').show().siblings().hide();
                           updateresulthot = new Handsontable(rmupdateresulthot, updateresultsettings);
                           updateresulthot.loadData(res);
                       }
                   });
               });

               $("#rmsearchsubmit").click(function() {

                   if($( "#rmsearch" ).val()!= '') {
                       $.ajax({
                           type: 'GET',
                           url: '{{url('inventory/getGetRmCode')}}',
                           data: {
                               searchtype: $("input[type=radio][name = searchtype]:checked").val(),
                               data: $("#rmsearch").val()
                           },
                           dataType: 'json',
                           success: function (res) {
                               var searchresult = new Array();
                               for (var i = 0; i < res.length; i++) {
                                   searchresult[i] = new Array();
                                   searchresult[i][0] = res[i]['code'];
                                   searchresult[i][1] = res[i]['description'];
                                   searchresult[i][2] = res[i]['location'];
                               }
                               console.log(searchresult);
                               searchresulthot.loadData(searchresult);
                               $('#searchresult').show();

                           }
                       });
                   }
               });



           </script>




    </div>



    </div>




@stop

