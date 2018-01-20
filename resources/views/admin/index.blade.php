@extends('common.layout')

@section('navbar')

@stop

@section('leftmenu')

@stop


@section('content')

    <div class="panel panel-default" style="margin-top: -25px;">


       <div class="panel-body" style="min-height: 500px;">

           <ul id="myTab" class="nav nav-tabs">
               <li  id="attendance" class=""><a href="javasript:;" data-toggle="">Attendance</a></li>
               <li  id="nomenclature" class=""><a href="javasript:;" data-toggle="">Grade Name Nomenclature </a></li>
           </ul>


           <div style="margin-top: 20px">
           <div id = 'attentab'>
               <div style="margin-bottom: 20px;margin-top: 20px;"><h1 style="text-align:left;color: ">{{date("Y-m")}}</h1></div>
               <table class="table" id="prlist" style="width:1050px;border-radius: 20px;border: none">
                   <thead>
                   <tr style="height: 50px;border: none; ">
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;">一</th>
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;">二</th>
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;" >三</th>
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;" >四</th>
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;" >五</th>
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;" >六</th>
                       <th style="width: 150px;vertical-align: middle;text-align:center;border: 2px solid #8AC007;" >七</th>
                   </tr>
                   </thead>
                   <tbody>

                       <tr style="height: 30px;vertical-align: middle;border:none;">
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">14</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">15</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">16</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">17</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">18</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">19</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">20</td>
                       </tr>

                       <tr style="height: 90px;vertical-align: middle;border: none;">
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;">Hongyi：Full day<br> Fei: Morning</td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;">Yong：Full day<br> Tony: Morning</td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;">Jiwei：Full day</td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                       </tr>
                       <tr style="height: 30px;vertical-align: middle;border:none;">
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">21</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">22</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">23</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">24</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">25</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">26</td>
                           <td style="width:150px;text-align:right;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-top: 2px solid #8AC007;border-bottom: 0px solid #8AC007;">27</td>
                       </tr>

                       <tr style="height: 90px;vertical-align: middle;border: none;">
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;">Hongyi：Full day<br> Fei: Morning</td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;">Hongyi：Full day<br> Fei: Morning</td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;">Hongyi：Full day<br> Fei: Morning</td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                           <td style="width:150px;text-align:left;border-left: 2px solid #8AC007;border-right: 2px solid #8AC007;border-bottom: 2px solid #8AC007;border-top: 0px solid #8AC007;"></td>
                       </tr>


                   </tbody>
               </table>

               <div class="row col-lg-11" style="margin-top: 20px;margin-left:0px;border-radius: 5px;border: 1px solid #8AC007;padding-top: 25px;padding-bottom: 25px">

                   <form class="form-inline" role="form">
                       <div class="form-group">
                           <label for="dtp_input1" class="col-md-3 control-label">From:</label>
                           <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="yyyy-mm-dd  HH:00" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                               <input class="form-control" size="40" type="text" value="" >
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                           </div>
                           <input type="hidden" id="dtp_input1" value="" />
                       </div>

                       <div class="form-group">
                           <label for="dtp_input2" class="col-md-3 control-label">To:</label>
                           <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="yyyy-mm-dd  HH:00" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                               <input class="form-control" size="40" type="text" value="" >
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                           </div>
                           <input type="hidden" id="dtp_input2" value="" />
                       </div>

                       </br>


                       <div class="form-group" style="margin-top: 30px">
                           <label class="" for="">Application type:</label>
                           <select style="height:28px;width:220px;line-height:50px;border:1px solid rgba(8, 0, 32, 0.2);-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;">
                               <option value="volvo">Annual leave</option>
                               <option value="saab">Sick leave</option>
                               <option value="mercedes">Personal leave</option>
                           </select>
                           <button style="margin-left: 230px" type="button" id="gradenamesubmit" class="btn btn-primary ">Leave application</button>

                       </div>

                   </form>

               </div>

           </div>








           <div id = 'nomenclaturetab'>

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


                               <div class="row col-lg-12 ">

                               <div class="form-group " style="margin-left: 30px;margin-top: 20px;">
                                        <label class="" for="">Comment:</label>
                                        <textarea class="form-control " id="comment" rows="1" cols="80"></textarea>
                                   <button style="margin-left: 40px" type="button" id="gradenamesubmit" class="btn btn-primary ">Submit</button>

                               </div>

                               </div>



                           </form>

                       </div>
                   </div>


               </div>


                   <div class="row" id="createmsg" style="margin-left:15px;margin-bottom: 10px;margin-top: 30px;" >

                   </div>



                   <div class="row" >
                       <div class="col-lg-2" style="margin-left:15px;margin-bottom: 10px;margin-top: 30px;"><b>Tradename:</b>  </div>
                       <div class="col-lg-11" style="border-radius: 0px;border-bottom: 0px solid #8AC007;">
                           <ul id="tradenames" class="nav nav-pills">

                           </ul>
                       </div>
                   </div>

                   <div class="row" >
                       <div class="col-lg-2" style="margin-left:15px;margin-bottom: 10px;margin-top: 20px;"><b> Base Resin: </b></div>
                       <div class="col-lg-11" style="border-radius: 0px;border-bottom: 0px solid #8AC007;">
                           <ul id="resinlist" class="nav nav-pills">

                           </ul>
                       </div>
                       </div>


                   <div class="row" >
                       <div class="col-lg-2" style="margin-left:15px;margin-bottom: 10px;margin-top: 20px;"><b>Color:</b> </div>
                       <div class="col-lg-11" style="border-radius: 0px;border-bottom: 0px solid #8AC007;">
                           <ul id="colorlist" class="nav nav-pills">

                           </ul>
                       </div>
                   </div>


                   <div class="row" >
                       <div class="col-lg-2"style="margin-left:15px;margin-bottom: 10px;margin-top: 20px;"><b>Main feature:</b>  </div>
                       <div class="col-lg-11" style="border-radius: 0px;border-bottom: 0px solid #8AC007;">
                           <ul id="characterlist" class="nav nav-pills">

                           </ul>
                       </div>
                   </div>






           </div>

           </div>

           <script type="text/javascript">
               $('.form_datetime').datetimepicker({
                   //language:  'fr',
                   weekStart: 1,
                   todayBtn:  1,
                   autoclose: 1,
                   todayHighlight: 1,
                   startView: 2,
                   forceParse: 0,
                   showMeridian: 1
               });
               $('.form_date').datetimepicker({
                   language:  '',
                   weekStart: 1,
                   todayBtn:  1,
                   autoclose: 1,
                   todayHighlight: 1,
                   startView: 2,
                   minView: 2,
                   forceParse: 0
               });
               $('.form_time').datetimepicker({
                   language:  '',
                   weekStart: 1,
                   todayBtn:  1,
                   autoclose: 1,
                   todayHighlight: 1,
                   startView: 1,
                   minView: 0,
                   maxView: 1,
                   forceParse: 0
               });
           </script>

           <script type="text/javascript">

               $('.navadmin').addClass("active");
               $("#attendance").addClass('active').siblings().removeClass('active');
               $('#attentab').show().siblings().hide();
           </script>

           <script type="text/javascript">


               $("#maincode").change(function() {
                   $.ajax({
                       type: 'GET',
                       url: '{{url('nomenclature/getSerial')}}',
                       data: {"data":$("#maincode").val() },
                       dataType: 'json',
                       success: function (res) {
                           $("#maincode").val(res.maincode);
                           $("#serialnum").val(res.newcode);
                           $("#gradename").val(res.maincode +'-'+res.newcode);
                       }

                   });

               });

               $("#gradenamesubmit").click(function() {
                   $.ajax({
                       type: 'POST',
                       url: '{{url('nomenclature/create')}}',
                       data: {
                           "maincode":$("#maincode").val(),
                           "serialnum":$("#serialnum").val(),
                           "gradename":$("#gradename").val(),
                           "sr":$("#sr").val(),
                           "comment":$("#comment").val(),
                       '_token':'{{csrf_token()}}'
                       },
                       dataType: 'json',
                       success: function (res) {
                           $("#createmsg").siblings().hide();

                           $("#createmsg").html(res.createmsg)
                       }

                   });

               });


                   $("#attendance").click(function () {
                       $(this).addClass('active').siblings().removeClass('active');
                       $('#attentab').show().siblings().hide();
                   });

                   $("#nomenclature").click(function () {
                       $(this).addClass('active').siblings().removeClass('active');
                       $('#nomenclaturetab').show().siblings().hide();
                       $.ajax({
                           type: 'GET',
                           url: '{{url('nomenclature/getName')}}',
//                       data: {"data": change},
                           dataType: 'json',
                           success: function (res) {

                               for (var j = 0, tradelen = res.tradenames.length, tradelist = ''; j < tradelen; j++) {
                                   tradelist += '<li class="tradename"><a href="javascript:;">' + res.tradenames[j].name + '(<b>' + res.tradenames[j].abbreviation + '</b>)</a></li>';
                               }
                               $("#tradenames").append(tradelist);

                               for (var i = 0, resinlen = res.baseresins.length, resinlist = ''; i < resinlen; i++) {
                                   resinlist += '<li class="resintype"><a href="javascript:;">' + res.baseresins[i].resintype + '(<b>' + res.baseresins[i].code + '</b>)</a></li>';
                               }
                               $("#resinlist").append(resinlist);

                               for (var k = 0, characterlen = res.characteristics.length, characterlist = ''; k < characterlen; k++) {
                                   characterlist += '<li class="character"><a href="javascript:;">' + res.characteristics[k].characteristic + '(<b>' + res.characteristics[k].abbreviation + '</b>)</a></li>';
                               }
                               $("#characterlist").append(characterlist);

                               for (var l = 0, colorlen = res.colors.length, colorlist = ''; l < colorlen; l++) {
                                   colorlist += '<li class="color"><a href="javascript:;">' + res.colors[l].color + '(<b>' + res.colors[l].abbreviation + '</b>)</a></li>';
                               }
                               $("#colorlist").append(colorlist);

                           }
                       });


                   });


           </script>

     </div>



    </div>




@stop

