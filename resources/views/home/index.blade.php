@extends('common.layout')

@section('leftmenu')

@stop


@section('navbar')

@stop


@section('content')

    <div class="panel panel-default" style="margin-top: -25px;">
       <div class="panel-body" style="min-height: 500px;">
           <ul id="myTab" class="nav nav-tabs">
               <li  id="srstatus"><a href="javasript:;" data-toggle="">Ongoing SR Status</a></li>
               {{--<li  id="approvelist"><a href="javasript:;" data-toggle="">Approve List</a></li>--}}
               {{--<li  id="schedule"><a href="javasript:;" data-toggle="">My Schedule</a></li>--}}
               <li  id="attendance" class=""><a href="javasript:;" data-toggle="">Attendance</a></li>
               <li  id="nomenclature" class=""><a href="javasript:;" data-toggle="">Grade Name Nomenclature </a></li>
           </ul>

    <div style="margin-top: 20px">
        <div id = 'attentab'>
            <div style="margin-bottom: 20px;margin-top: 20px;"><h1 style="text-align:left;color: ">{{date("Y-m-d")}}</h1></div>
            <table class="table" id="prlist" style="width:1050px;border-radius: 20px;border: none">
                <thead>
                <tr style="height: 50px;border: none; ">
                    <th style="width: 150px;vertical-align: middle;text-align:center;border: 1px solid #8AC007;">Monday</th>
                    <th style="width: 150px;vertical-align: middle;text-align:center;border: 1px solid #8AC007;">Tuesday</th>
                    <th style="width: 150px;vertical-align: middle;text-align:center;border: 1px solid #8AC007;" >Wednesday</th>
                    <th style="width: 150px;vertical-align: middle;text-align:center;border: 1px solid #8AC007;" >Thursday</th>
                    <th style="width: 150px;vertical-align: middle;text-align:center;border: 1px solid #8AC007;" >Friday</th>
                </tr>
                </thead>
                <tbody>


                <tr class="leavetd">
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                </tr>



                </tbody>
            </table>

            <div class="row col-lg-11" style="margin-top: 20px;margin-left:0px;border-radius: 5px;border: 1px solid #8AC007;padding-top: 25px;padding-bottom: 25px">

                @if(count($errors)>0)
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach

                    </div>
                @endif

                <form class="form-inline" role="form" action="{{url('home/leaveApply')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="dtp_input1" class="col-md-3 control-label">Start Date:</label>
                        <div class="input-group date form_date col-md-6" style="float: left;" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                            <input class="form-control" name="start_date" type="text" value="" >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <div class="col-md-3">
                            <select  name="start_time" style="margin-left:50px;height:34px;width:220px;line-height:50px;border:1px solid rgba(8, 0, 32, 0.2);-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;">
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="full">Full day</option>
                            </select>
                        </div>

                        <input type="hidden" id="dtp_input1" value="" />
                    </div>
                    <br>

                    <div class="form-group" style="margin-top: 30px;">
                        <label for="dtp_input2" class="col-md-3 control-label">Finish Date:</label>
                        <div class="input-group date form_date col-md-6"  style="float: left;" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" name="finish_date"  type="text" value="" >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <div class="col-md-3">
                            <select  name="finish_time" style="margin-left:50px;height:34px;width:220px;line-height:50px;border:1px solid rgba(8, 0, 32, 0.2);-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;">
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="full">Full day</option>
                            </select>
                        </div>
                        <input type="hidden" id="dtp_input2" value="" />
                    </div>



                    <div class="form-group" style="margin-top: 30px">
                        <label class="col-md-3" for="">Leave type:</label>
                        <div class="col-md-6">
                        <select name="type" style="height:34px;width:285px;line-height:50px;border:1px solid rgba(8, 0, 32, 0.2);-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;">
                            <option value="annual">Annual leave</option>
                            <option value="sick">Sick leave</option>
                            <option value="personal">Personal leave</option>
                        </select>
                        </div>
                        <div class="col-md-2" style="margin-left: 38px">
                        <button  type="submit" id="attendance" class="btn btn-primary ">Leave application</button>
                        </div>
                    </div>


                </form>

            </div>

        </div>

        <div id = 'srstatustab'>
            {{ $schedules->links() }}
        </div>

        <div id = 'scheduletab'>

        </div>

        <div id = 'approvetab'>

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


    </div>
    </div>



    <script type="text/javascript">

        $('.navhome').addClass("active");
        $('#srstatus').addClass("active");
        $('#srstatustab').show().siblings().hide();



        var     settings,
                hot,
                data =[

                        @foreach($schedules as $schedule)
                    [   '{{$schedule->sr}}',
                        '{{$schedule->step}}',
                        '{{$schedule->schedule_at->format('Y-m-d')}}',
                        'Pellets',
                        '{{$schedule->created_at->format('Y-m-d')}}',
                        '{{$schedule->due_at->format('Y-m-d')}}',
                        '{{ceil(($schedule->due_at->timestamp-time())/86400)}}',
                        '{{$schedule->opportunity}}',
                        '{{$schedule->user->name}}'
                    ],
                    @endforeach

                ];

         settings = {
            data: data,
            minRows: 1,
            minCols: 9,
//            maxRows: ,
            maxCols:9,
            fillHandle: {
                direction: 'vertical',
                autoInsertRow: false
            },
            rowHeaders: false,
            readOnly: true,
            rowHeaderWidth:40,
            rowHeights:60,
            columnHeaderHeight:50,
            colHeaders: ['SR', 'Step','Schedule', 'Sample type', 'Created','Due day','Days','Opportunity','Engineer'],
            colWidths: [80, 80, 130,  100, 130, 130, 100, 280, 80],
            columns: [
                 {},
                 {className: "htCenter"},
                 {className: "htCenter"},
                 {className: "htCenter"},
                 {className: "htCenter"},
                 {className: "htCenter"},
                 {className: "htCenter"},
                 {},
                 {}

             ],
            minSpareRows: 0
        };
        hot = new Handsontable(srstatustab, settings);


    </script>

    <script>
        $("#attendance").click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $('#attentab').show().siblings().hide();
            $.ajax({
                type: 'GET',
                url: '{{url('home/getAttendance')}}',
//                data: {step:  1},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $(".leavetd td").html('');
                    var now = new Date();
                    var nowTime = now.getTime() ;
                    var day = now.getDay();
                    var oneDayTime = 24*60*60*1000 ;

                    $(".leavetd td").each(function(index, element){

                            var dayTime = nowTime - (day-1-index)*oneDayTime ;
                            var today = new Date(dayTime);
                            if(!(day-1-index)){
                                var date = "<p style='text-align:right; color:red;'>" + today.getDate() + "</p>";
                            }
                        else {
                                var date = "<p style='text-align:right; '>" + today.getDate() + "</p>";
                            }

                            $(this).append(date);

                    });

                    for (var i=0;i<response.length;i++)
                    {
                        var leave =  "<span>" + response[i][1] + "</span><br>";
                        $(".leavetd td").eq(response[i][0]).append(leave);
                    }
                }
            });
        });



        $("#srstatus").click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $('#srstatustab').show().siblings().hide();
        });

        $("#approvelist").click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $('#approvetabtab').show().siblings().hide();
        });

        $("#schedule").click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $('#scheduletab').show().siblings().hide();
        });

    </script>

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
                    $("#tradenames").html(tradelist);

                    for (var i = 0, resinlen = res.baseresins.length, resinlist = ''; i < resinlen; i++) {
                        resinlist += '<li class="resintype"><a href="javascript:;">' + res.baseresins[i].resintype + '(<b>' + res.baseresins[i].code + '</b>)</a></li>';
                    }
                    $("#resinlist").html(resinlist);

                    for (var k = 0, characterlen = res.characteristics.length, characterlist = ''; k < characterlen; k++) {
                        characterlist += '<li class="character"><a href="javascript:;">' + res.characteristics[k].characteristic + '(<b>' + res.characteristics[k].abbreviation + '</b>)</a></li>';
                    }
                    $("#characterlist").html(characterlist);

                    for (var l = 0, colorlen = res.colors.length, colorlist = ''; l < colorlen; l++) {
                        colorlist += '<li class="color"><a href="javascript:;">' + res.colors[l].color + '(<b>' + res.colors[l].abbreviation + '</b>)</a></li>';
                    }
                    $("#colorlist").html(colorlist);

                }
            });


        });


    </script>

@stop

