@extends('common.layout')

@section('navbar')

@stop

@section('leftmenu')

@stop


@section('content')

    <div class="panel panel-default" style="margin-top: -25px;">


       <div class="panel-body" style="min-height: 500px;">

           <ul id="myTab" class="nav nav-tabs">
               <li  id="newblock" class="active"><a href="javasript:;" >New RM Block</a></li>
               <li  id="updateblock"><a href="javasript:;" >Update RM Block</a></li>
               <li  id="confirmblock"><a href="javasript:;" >Confirm RM Block</a></li>
           </ul>


           <div style="margin-top: 20px">
           <p id="msg" class="text-success"></p>

           <div id = 'rmblocktab' class="">
               <div class="col-sm-3" id="search" >
                   <input type="text" class="form-control " id="srsearch" placeholder="Input SR number to search">
               </div>


               <div id="srsearchlist" class="" style="margin-top:0px;width: 1000px;">
                  <table class="table table-bordered" id="srlist">
                       <thead>
                       <tr style="height: 30px;vertical-align: middle">
                           <th style="width:10%">SR</th>
                           <th style="width: 40%">Opportunity</th>
                           <th style="width: 20%">Grade name</th>
                           <th style="width: 20%">Lot number</th>
                           <th style="width: 10%" >Action</th>
                       </tr>
                       </thead>
                       <tbody>

                       </tbody>
                   </table>


               </div>


                   <button id="blocksubmit" type="button"  class="btn btn-primary">Submit</button>




           </div>

               <div id = 'rmprtab' class="">


                   <div id="" > PR</div>
               </div>

           </div>


           <script type="text/javascript">

               $('.navblock').addClass("active");
               $('#rmblocktab').show().siblings().hide();
               $('#search').show().siblings().hide();
               $('#msg').html('');
               $('#srsearch').val('');
               $('#srlist').children().slice(1).remove();
               blockhot.loadData([]);


           </script>


           <script type="text/javascript">
               var blockhot,
                   blocksettings,
                   blockupdate;

               blocksettings = {
                   minRows: 10,
                   minCols: 3,
                   maxRows: 20,
                   maxCols:4,
                   fillHandle: {
                       direction: false,
                       autoInsertRow: false
                   },
                   rowHeaders: true,
                   readOnly: false,
                   rowHeaderWidth:60,
                   rowHeights:30,
                   columnHeaderHeight:40,
                   colHeaders: [ 'Material description','SAP code','Block quantity'],
                   columns: [
                       {readonly:true},
                       {readonly:false},
                       {readonly:false}
                   ],
                   colWidths: [250, 200, 200],
                   minSpareRows: 0,
                   afterChange: function (change, source) {
                       if (!(source === 'loadData')) {

                           if(blockhot.getData().length == blockhot.countEmptyRows()){
                               $('#blocksubmit').hide();
                           }
                           else {
                               $('#blocksubmit').show();
                           }

                       }
                   }
               };

               blockupdate = {
                   minRows: 1,
                   minCols: 4,
                   maxRows: 20,
                   maxCols:4,
                   fillHandle: {
                       direction: false,
                       autoInsertRow: false
                   },
                   rowHeaders: true,
                   readOnly: true,
                   rowHeaderWidth:60,
                   rowHeights:30,
                   columnHeaderHeight:40,
                   colHeaders: [ 'Material description','SAP code','Block quantity','Update status'],
                   columns: [
                       {readonly:true},
                       {readonly:false},
                       {readonly:false},
                       {}
                   ],
                   colWidths: [250, 200, 200,200],
                   minSpareRows: 0
               };






               $("#confirmblock").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#rmtypetab').show().siblings().hide();

               });

               $("#updateblock").click(function() {
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



               $("#newblock").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#rmblocktab').show().siblings().hide();
                   $('#search').show().siblings().hide();
                   $('#msg').html('');
                   $('#srsearch').val('');
                   $('#srlist').children().slice(1).remove();
                   blockhot.updateSettings(blocksettings);
                   blockhot.loadData([]);
               });

               $("#srsearch").change(function() {
                   $.ajax({
                       type: 'GET',
                       url: '{{url('schedule/getRmBlock')}}',
                       data: {"sr": $("#srsearch").val()},
                       dataType: 'json',
                       success: function (res) {
                           console.log(res);
                           var schedule =  '<tr style="height: 40px;vertical-align: middle" id="';
                               schedule += res['id'] +'">';
                               schedule += '<td>'+res['sr'] +'</td>';
                               schedule += '<td>'+res['opportunity'] +'</td>';
                               schedule += '<td>'+res['grade'] +'</td>';
                               schedule += '<td>'+res['lot'] +'</td>';
                               schedule += '<td ><a href="javascript:;" id="blockbtn">Block RM</a></td></tr>';
                           $('#srlist').append(schedule);
                           $("#srsearchlist").show();
                           $("#search").hide();
                       }
                   });

               });

               $("#srlist").on("click","#blockbtn",function(){
                   var blocktable = $("<div id='blockcontainer' style='margin-top: 30px;'></div>");

                 $('#srsearchlist').append(blocktable);
                   blockhot = new Handsontable(blockcontainer, blocksettings);

               });

               $("#blocksubmit").click(function() {
                   $('#msg').html('更新成功！').show();
                   var blockdata = blockhot.getData();
                   blockdata.splice(blockdata.length - blockhot.countEmptyRows(),blockhot.countEmptyRows());
                   $.ajax({
                       type: 'POST',
                       url: '{{url('inventory/blockInventory')}}',
                       data: {
                           id: $('#blockbtn').parent().parent().attr('id'),
                           data: blockdata,
                           '_token':'{{csrf_token()}}'
                       },
                       dataType: 'json',
                       success: function (res) {

                           blockhot.updateSettings(blockupdate);
                           blockhot.loadData(res);
                           $("#blocksubmit").hide();
                       }
                   });
               });

           </script>




    </div>



    </div>




@stop

