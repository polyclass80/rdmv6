@extends('common.layout')

@section('navbar')

@stop

@section('leftmenu')

@stop


@section('content')

    <div class="panel panel-default" style="margin-top: -25px;">


       <div class="panel-body" style="min-height: 500px;">

           <ul id="myTab" class="nav nav-tabs">
               <li  class="step active" id="zsk18"><a href="javasript:;" data-toggle="">ZSK18</a></li>
               <li  class="step" id="zsk25"><a href="javasript:;" data-toggle="">ZSK25</a></li>
               <li  class="step" id="zsk26"><a href="javasript:;" data-toggle="">ZSK26</a></li>
               <li  class="step" id="eccoh"><a href="javasript:;" data-toggle="">ECCOH</a></li>
               <li  class="step" id="sjw45"><a href="javasript:;" data-toggle="">SJW45</a></li>
               <li  class="step" id="molding"><a href="javasript:;" data-toggle="">Molding</a></li>
               <li  class="step" id="testing"><a href="javasript:;" data-toggle="">Testing</a></li>
               @can("engineer")
               <li  class="create"><a href="javasript:;" data-toggle=""><span class="glyphicon glyphicon-plus"></span>Create Work Order</a></li>
               @endcan
           </ul>



           <div id="schedule" style="margin-top: 20px">
               <p id="createmsg" class="text-success"></p>
               <div id="list" >

                   <div id="modallist">



                   </div>

               </div>
               </div>
           <div id="newschedule" style="margin-top: 20px" hidden="">
               <div id="create" ></div>

               <div class="pull-right" style="margin-top: 50px">
                   <button id="save" type="button" class="btn btn-primary">Submit</button>
               </div>

           </div>


           <script type="text/javascript">

               $('.navschedule').addClass("active");

               var     data = [],
                       settings,
                       hot;
               settings = {
                   data: data,
                   minRows: 1,
                   minCols: 12,
                   maxRows: 20,
                   maxCols:12,
                   fillHandle: {
                       direction: 'vertical',
                       autoInsertRow: false
                   },
                   rowHeaders: true,
                   readOnly: true,
                   rowHeaderWidth:40,
                   rowHeights:60,
                   columnHeaderHeight:50,
                   colHeaders: ['SR', 'Screw','Grade name','Lot number', 'Engineer', 'Quantity', 'Formula','Create','Schedule','Due day','Opportunity','Comment'],
                   colWidths: [80, 50,160, 100, 60, 50, 50, 80, 80, 80, 190,120],
                   columns: [
                       {renderer: "html"},
                       {   className: "htCenter",
                           readOnly: false
                       },
                       {},
                       {},
                       {},
                       {className: "htCenter"},
                       {className: "htCenter"},
                       {className: "htCenter"},
                       {
                           type: 'date',
                           dateFormat: 'YYYY-MM-DD',
                           correctFormat: true,
                           readOnly: false,
                           defaultDate: new Date(),
                           allowEmpty: false,
                           className: "htCenter",

                           // datePicker additional options (see https://github.com/dbushell/Pikaday#configuration)
                           datePickerConfig: {
                               // First day of the week (0: Sunday, 1: Monday, etc)
                               firstDay: 0,
                               showWeekNumber: false,
                               numberOfMonths: 1

                           }
                       },
                       {className: "htCenter"},
                       {},
                       {readOnly: false}

                   ],
                   groups:[{cols:[0,2]},{cols:[3,5]},{rows:[0,4]},{rows:[5,7]}],
                   minSpareRows: 0,
                   afterChange: function (change, source) {
                       if (!(source === 'loadData') && change[0][2]!=change[0][3]) {
                           var data = hot.getSourceDataAtCell(change[0][0],0);
                           var id = data.replace(/[^0-9]/ig,"");
                           id = id.substr(0, id.length - 5);
                           $.ajax({
                               type: 'POST',
                               url: '{{url('schedule/scheduleUpdate')}}',
                               data: {
                                   data:change[0][3],
                                   content:change[0][1],
                                   id : id,
                                   "_token":"{{csrf_token()}}"
                               },
                               dataType: 'json',
                               success: function (res) {

                                  console.log(res);

                               }
                           });

                       }
                   }
               };
               hot = new Handsontable(list, settings);
               $.ajax({
                   type: 'GET',
                   url: '{{url('schedule/getSchedule')}}',
                   data: {step:  'ZSK18'},
                   dataType: 'json',
                   success: function (response) {
                       var data = [];
                       for (var i = 0; i < response.length; i++) {
                           data[i] = [];
                           data[i][0] = "<a data-toggle='modal' data-target='#" + response[i]['id'] + "'>" + response[i]['sr'] + "</a>";
                           data[i][1] = response[i]['screw'];
                           data[i][2] = response[i]['grade'];
                           data[i][3] = response[i]['lot'];
                           data[i][4] = response[i]['username'];
                           data[i][5] = response[i]['quantity'];
                           data[i][6] = response[i]['formula'];
                           data[i][7] = new Date(response[i]['created_at']).Format('MM-dd');
                           data[i][8] = new Date(response[i]['schedule_at']).Format('yy-MM-dd');
                           data[i][9] = new Date(response[i]['due_at']).Format('MM-dd');
                           data[i][10] = response[i]['opportunity'];
                           data[i][11] = response[i]['comment'];

                           var modal = '<div class="modal" id="' + response[i]['id'] + '" style="margin-top: 100px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
                                   + '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
                                   + '<h3 class="modal-title" id="myModalLabel">Update  '
                                   + response[i]['sr'] + '</h3></div>'
                                   + '<div class="modal-body" style=" height: 150px;padding-top: 30px;">'
                                   + '<form class="form" role="form" method="post" action="{{url('schedule/update')}}">{{csrf_field()}}'
                                   + '<div class="form-group">'
                                   + '<label class="col-sm-1" for="line" style="margin-left: 120px;">Step:</label>'
                                   + '<div class="col-sm-4" style="margin-left: 30px">'
                                   + '<input type="hidden" name="schedule[id]" value="' + response[i]['id'] + '">'
                                   + '<select name="schedule[step]" class="form-control">'
                                   + '<option value="ZSK18" >ZSK18</option>'
                                   + '<option value="ZSK25" >ZSK25</option>'
                                   + '<option value="ZSK26"  >ZSK26</option>'
                                   + '<option value="ECCOH" >ECCOH</option>'
                                   + '<option value="SJW45" >SJW45</option>'
                                   + '<option value="Molding" >Molding</option>'
                                   + '<option value="Testing" >Testing</option>'
                                   + '<option value="Completed" >Completed</option>'
                                   + '</select></div></div><br>'
                                   + '<div class="modal-footer" style="margin-top: 60px">'
                                   + '<button type="submit" class="btn btn-primary" >'
                                   + ' 提交</button></div></form></div></div></div></div>';

                           $('#modallist').append(modal);
                           hot.loadData(data);
                       }
                   }
               });

               var newdata = new Array();
               newdata[0] = new Array();
               newdata[0] = ['',''];

               var    settings1,
                       hot1;

               settings1 = {
                   data: newdata,
                   minRows: 1,
                   minCols: 10,
                   maxRows: 1,
                   maxCols:10,
                   rowHeaders: false,
                   rowHeaderWidth:50,
                   rowHeights:60,
                   columnHeaderHeight:50,
                   colHeaders: ['SR', 'Opportunity',   'Due day', 'Step', 'Screw', 'Grade name', 'Lot number', 'Quantity', 'Formula', 'Comment'],
                   colWidths: [80, 250, 100, 80, 80, 160, 100,  80, 80, 130],
                   columns: [
                       {},
                       {},
                       {
                           type: 'date',
                           dateFormat: 'YY-MM-DD',
                           correctFormat: true,
                           defaultDate: new Date(),
                           allowEmpty: false,
                           // datePicker additional options (see https://github.com/dbushell/Pikaday#configuration)
                           datePickerConfig: {
                               // First day of the week (0: Sunday, 1: Monday, etc)
                               firstDay: 0,
                               showWeekNumber: false,
                               numberOfMonths: 1,

                           }
                       },

                       {
                           type: 'dropdown',
                           source: ['ZSK18', 'ZSK25', 'ZSK26', 'ECCOH', 'SJW45', 'Injection', 'Molding', 'Testing']
                       },
                       {
                           type: 'dropdown',
                           source: ['GF', 'MN','STD']
                       },

                       {},
                       {},
                       {},
                       {},
                       {}

                   ],
                   minSpareRows: 0,
                   afterChange: function (change, source) {
                       if (!(source === 'loadData')) {
                           if (!(hot1.isEmptyRow(0))) {
                               $("#save").show();
                           }
                           else{
                               $("#save").hide();
                           }
                       }

                   }
               };


               hot1 = new Handsontable(create, settings1);


           </script>

           <script type="text/javascript">

               Date.prototype.Format = function (fmt) {
                   var o = {
                       "M+": this.getMonth() + 1, //月份
                       "d+": this.getDate(), //日
                       "h+": this.getHours(), //小时
                       "m+": this.getMinutes(), //分
                       "s+": this.getSeconds(), //秒
                       "q+": Math.floor((this.getMonth() + 3) / 3), //季度
                       "S": this.getMilliseconds() //毫秒
                   };
                   if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
                   for (var k in o)
                       if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
                   return fmt;
               }

           </script>

           <script type="text/javascript">

               $(".create").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#schedule').hide();
                   $('#newschedule').show();
                   $("#save").hide();
                   hot1.loadData([]);

               });
           </script>

           <script type="text/javascript">

               $(".step").click(function() {
                   $(this).addClass('active').siblings().removeClass('active');
                   $('#schedule').show();
                   $('#newschedule').hide();
                   $( "#blockRM" ).hide();
                   $('#createmsg').html('');
                   $("#modallist").empty();
                   $.ajax({
                       type: 'GET',
                       url: '{{url('schedule/getSchedule')}}',
                       data: {step: $(this).attr("id")},
                       dataType: 'json',
                       success: function (response) {
                         var      data = [];
                           for(var i=0; i < response.length; i++){
                               data[i] = [];
                               data[i][0] = "<a data-toggle='modal' data-target='#"+response[i]['id']+"'>"+response[i]['sr']+"</a>";
                               data[i][1] = response[i]['screw'];
                               data[i][2] = response[i]['grade'];
                               data[i][3] = response[i]['lot'];
                               data[i][4] = response[i]['username'];
                               data[i][5] = response[i]['quantity'];
                               data[i][6] = response[i]['formula'];
                               data[i][7] = new Date(response[i]['created_at']).Format('MM-dd');
                               data[i][8] = new Date(response[i]['schedule_at']).Format('yyyy-MM-dd');
                               data[i][9] = new Date(response[i]['due_at']).Format('MM-dd');
                               data[i][10] = response[i]['opportunity'];
                               data[i][11] = response[i]['comment'];

                               var modal = '<div class="modal" id="'+response[i]['id']+'" style="margin-top: 100px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
                                        +'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
                                       + '<h3 class="modal-title" id="myModalLabel">Update  '
                                       +response[i]['sr']+'</h3></div>'
                                       +'<div class="modal-body" style=" height: 150px;padding-top: 30px;">'
                                       +'<form class="form" role="form" method="post" action="{{url('schedule/update')}}">{{csrf_field()}}'
                                       +'<div class="form-group">'
                                       +'<label class="col-sm-1" for="line" style="margin-left: 120px;">Step:</label>'
                                       +'<div class="col-sm-4" style="margin-left: 30px">'
                                       +'<input type="hidden" name="schedule[id]" value="'+response[i]['id']+'">'
                                       +'<select name="schedule[step]" class="form-control">'
                                       + '<option value="ZSK18" >ZSK18</option>'
                                       + '<option value="ZSK25" >ZSK25</option>'
                                       + '<option value="ZSK26"  >ZSK26</option>'
                                       + '<option value="ECCOH" >ECCOH</option>'
                                       + '<option value="SJW45" >SJW45</option>'
                                       + '<option value="Molding" >Molding</option>'
                                       + '<option value="Testing" >Testing</option>'
                                       + '<option value="Completed" >Completed</option>'
                                       +'</select></div></div><br>'
                                       +'<div class="modal-footer" style="margin-top: 60px">'
                                       +'<button type="submit" class="btn btn-primary" >'
                                       +' 提交</button></div></form></div></div></div></div>';

                               $('#modallist').append(modal);

                           }
                           hot.loadData(data);

                       }
                   });
               });

               $("#save").click(function() {
                   $('#schedule').show();
                   $('#newschedule').hide();
                   $('#createmsg').html('添加成功！');
                   $( "#blockRM" ).show();
                   hot.loadData([]);
                   $.ajax({
                       type: 'POST',
                       url: '{{url('schedule/create')}}',
                       data: {
                           data: hot1.getData(),
                           '_token':'{{csrf_token()}}'
                       },
                       dataType: 'json',
                       success: function (response) {
                          console.log(response);
                           var   newdata = [];
                                 newdata[0] = [];
                           newdata[0][0] = response.sr;
                           newdata[0][1] = response.screw;
                           newdata[0][2] = response.grade;
                           newdata[0][3] = response['lot'];
                           newdata[0][4] = response['user'];
                           newdata[0][5] = response['quantity'];
                           newdata[0][6] = response['formula'];
                           newdata[0][7] = new Date(response['created_at']).Format("yyyy-MM-dd");
                           newdata[0][8] = new Date(response['schedule_at']).Format("yyyy-MM-dd");
                           newdata[0][9] = new Date(response['due_at']).Format("MM-dd");
                           newdata[0][10] = response['opportunity'];
                           newdata[0][11] = response['comment'];
                           hot.loadData(newdata);
                       }
                   });
               });



           </script>












    </div>



    </div>




@stop

