@extends('backend.layouts.app')
@section('title', __('Charts&Tables(Edit)').' | '.app_name())

@section('content')
    <!-- {!! Form::open(['method' => 'POST', 'route' => ['admin.questions.store'], 'files' => true,]) !!} -->
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


   {{-- <link rel="stylesheet" href="{{asset('css/jquery-toasts.css')}}">  
    <script type="text/javascript" src="{{asset('js/jquery-toasts.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script> --}}
    <style>
         #sortable-8{ list-style-type: none; margin: 0; 
            padding: 0; width: 25%; float:left;}
         #sortable-8 li{ margin: 0 3px 3px 3px; padding: 0.4em; 
            padding-left: 1.5em; font-size: 17px; height: 16px; }
         .default {
            background: #ccc;
            border: 1px solid #DDDDDD;
            color: #333333;
         }     
      </style>

      <style>
        #pie-chartdiv {
        width: 50%;
        height: 500px;
        }
        #bar-chartdiv {
        width: 50%;
        height: 500px;
        }
        #donut-chartdiv {
        width: 50%;
        height: 500px;
        }
        #d3bar-chartdiv {
        width: 50%;
        height: 500px;
        }
        .plot-container.plotly:hover .modebar-container{
            display: none !important;
        }

          .attr-li:hover{
              color: #0a6aa1;
          }
          .attr-li.active{
              color: #0ab1fc;
          }

        </style>
      
      <script>
         $(function() {
            $('#sortable-8').sortable({
               update: function(event, ui) {
                  var productOrder = $(this).sortable('toArray').toString();
                  $("#sortable-9").text (productOrder);

                    for (var i=1;i<= $("#sortable-8").children().length ; i++)
                    {
                        $("#sortable-8 li:nth-child("+i+")").find("span.no").text( i );
                    }								
               }
            });
         });

         $(function() {
            $('#sortable-10').sortable({
               update: function(event, ui) {								
               }
            });
         });

         $(function() {
            $('#sortable-11').sortable({
               update: function(event, ui) {					
               }
            });
         });
         $(function() {
            $('#sortable-13').sortable({
               update: function(event, ui) {								
               }
            });
         });

         $(function() {
            $('#sortable-14').sortable({
               update: function(event, ui) {
               }
            });
         });
         
      </script>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">Charts & Tables</h3>
            <div class="float-right">
                <a href="{{ route('admin.charts.index') }}"
                   class="btn btn-success">View Charts</a>
            </div> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">

                    {!! Form::label('tests', 'Test', ['class' => 'control-label']) !!}
                    <?php
                        $chart = json_decode(json_encode($chart)); //add ckd comment
                        $current_chart = $chart[0];
                        $current_content = json_decode($current_chart->content);
                    ?>
                    <select class="form-control select2 required" name="tests_id" id="tests_id" placeholder="Options" multiple>
                        @foreach($tests as $test)
                            @foreach($current_tests as $ctest)
                                @if ($ctest->test_id == $test->id)
                                    <option value="{{$test->id}}" selected>{{$test->title}}</option>
                                @else
                                    <option value="{{$test->id}}">{{$test->title}}</option>
                                @endif
                            @endforeach
                            {{-- $current_chart->title  --}}
                        @endforeach
                    </select>
                    <div class="form-group form-md-line-input has-info" style="margin-top:10px">
                        <input type="text" class="form-control"   id="title" value="{{ $current_chart->title}}">
                        <label for="title">Input the title</label>
                    </div>   
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">Edit</h3>           
        </div>
        <div id="question_edit" class="card-body row">
            <div class="col-4">             
                <input type="text" class="btn-primary qt_name form-control" value="Questions TreeView Test">
                <div class="tree_5 tree-demo" display="none">
                    <ul class="treecontent">
                        @for ($i=0;$i<count($course_list);$i++)
                        <li>                  
                        {{ $course_list[$i]['title'] }} </a>
                            <ul>
                                @for ($j=0;$j<count($course_test_list[$i]);$j++)
                                    <li>
                                        {{ $course_test_list[$i][$j]['title']}}
                                        <ul>
                                            <?php
                                                $tk=  $course_test_list[$i][$j]['id'];
                                            ?>
                                                @if(isset($question_list[$tk]))
                                                    @for ($k=0;$k<count($question_list[$tk]);$k++)
                                                        <?php
                                                        $scores = json_decode($question_list[$tk][$k]['score'], true);
                                                        $sum = 0;
                                                        if(is_array($scores)) {
                                                            foreach($scores as $score) {
                                                                $sum = $sum + (int)$score;
                                                            }
                                                        } else { $sum = (int)$scores;}
                                                        ?>
                                                        <li>
                                                            <?php
                                                            if($question_list[$tk][$k]['questiontype'] != 4 && $question_list[$tk][$k]['questiontype'] != 7){
                                                            ?>
                                                            <span data-toggle="tooltip" data-placement="top" title=" <?php
                                                            echo $sum;
                                                            ?>" data-count="{{$question_list[$tk][$k]['questiontype']}}" data-testid="{{$course_test_list[$i][$j]['id']}}" class= "question-item" onclick= 'selectQuestion(event,this.getAttribute("data-testid"),this.getAttribute("data-count"))'>{{$question_list[$tk][$k]['id']}}.{{$question_list[$tk][$k]['question']}}
                                                        </span>
                                                            <?php
                                                            }
                                                            else if($question_list[$tk][$k]['questiontype'] == 4){
                                                            ?>
                                                            <span data-toggle="tooltip" data-placement="top" class= "question-item">
                                                           {{$question_list[$tk][$k]['id']}}.{{$question_list[$tk][$k]['question']}}
                                                        </span>

                                                            @for ($n=0;$n<count($question_row_list);$n++)
                                                                @if($question_list[$tk][$k]['id'] == $question_row_list[$n]['id'] && isset($question_row_list[$n]['rowcols']))
                                                                    @foreach($question_row_list[$n]['rowcols'] as $row_col)
                                                                        <ul>
                                                                            <li onclick= 'selectQuestion(event,this.getAttribute("data-testid"),this.getAttribute("data-count"))'>
                                                                            <span data-toggle="tooltip" data-placement="top" title=" <?php
                                                                            echo $sum;
                                                                            ?>" data-count="{{$question_list[$tk][$k]['questiontype']}}" data-testid="{{$course_test_list[$i][$j]['id']}}" class= "question-item" onclick= 'selectMatrixQuestion(event,this.getAttribute("data-testid"),this.getAttribute("data-count"))'>{{ $question_list[$tk][$k]['id'] }}.{{$row_col}}
                                                                            </span>
                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                @endif
                                                            @endfor
                                                            <?php
                                                                }else if($question_list[$tk][$k]['questiontype'] == 7) {
                                                            ?>
                                                                <span data-toggle="tooltip" data-placement="top" class= "question-item">
                                                                    {{$question_list[$tk][$k]['id']}}.{{$question_list[$tk][$k]['question']}}
                                                                </span>
                                                                @for($s = 0; $s < count($question_file_list); $s++)
                                                                    @if($question_list[$tk][$k]['id'] == $question_file_list[$s]['id'] && isset($question_file_list[$s]['file_num']))
                                                                        @for($h = 0; $h < $question_file_list[$s]['file_num']; $h++)
                                                                            <ul>
                                                                                <li onclick= 'selectQuestion(event,this.getAttribute("data-testid"),this.getAttribute("data-count"))'>
                                                                                    <span data-toggle="tooltip" data-placement="top" title=" <?php
                                                                                    echo $sum;
                                                                                    ?>" data-count="{{$question_list[$tk][$k]['questiontype']}}" data-testid="{{$course_test_list[$i][$j]['id']}}" class= "question-item" onclick= 'selectQuestion(event,this.getAttribute("data-testid"),this.getAttribute("data-count"))'>{{ $question_list[$tk][$k]['id'] }}.{{'file'}}.{{$h+1}}
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                        @endfor
                                                                    @endif
                                                                @endfor
                                                            <?php } ?>
                                                        </li>
                                                    @endfor
                                                @endif
                                        </ul>
                                    </li>
                                @endfor
                            </ul>
                        </li>                                     
                        @endfor
                    </ul>                   
                </div>
                <input type="text" class="btn-success qt_name form-control" value="Textgroups TreeView">
                <div class="tree_6 tree-demo" display="none">
                    <ul class="treecontent">
                        @for ($i=0;$i<count($course_list);$i++)
                        <li>                  
                        {{ $course_list[$i]['title'] }} </a>
                            <ul>
                                @for ($j=0;$j<count($course_test_list[$i]);$j++)
                                    <li>
                                        {{ $course_test_list[$i][$j]['title']}}
                                        <ul>
                                            <?php
                                                $tk=  $course_test_list[$i][$j]['id'];
                                            ?>
                                            @if(isset($textgroup_list[$tk]))
                                                @for ($k=0;$k<count($textgroup_list[$tk]);$k++)
                                                    <li>
                                                        <span data-toggle="tooltip" data-placement="top" title="{{$textgroup_list[$tk][$k]['id']}}" data-testid="{{$tk}}" class= "question-item" onclick= 'selectTextGroup(event,this.getAttribute("data-testid"))'>{{ $textgroup_list[$tk][$k]['id'] }}.{{ $textgroup_list[$tk][$k]['title'] }}
                                                        </span>
                                                    </li>
                                                @endfor
                                            @endif
                                        </ul>
                                    </li>
                                @endfor
                            </ul>
                        </li>                                     
                        @endfor
                    </ul>                   
                </div>
            </div>
            
            <div class="edit col-8" >  
                <div class="row main-content" id="matrix_part">                
                    <div class="col-12" id="mat_set">
                        <div class="col-12">
                            <div>
                            {!! Form::label('qt_col', trans('labels.backend.questions.fields.qt_col').'*', ['class' => 'control-label']) !!}
                            
                            </div>              
                            <div>
                                <a id="col_add"
                                class="btn btn-success" style="color:white; margin-top:10px;">+ Add Column</a>
                            </div>
                        </div>
                        <div id="col_panel" class="col-12" style="padding-top:10px;">
                            <div class="row" >  
                                <div class="col-2">
                                    <label>Cell Type</label>  
                                </div>
                                <div class="col-2">
                                    <label>Name</label>                             
                                </div>
                            </div>
                            @for($k=1;$k< count($current_content[0]);$k++)
                                <div class="row" >
                                    <div class="col-2">
                                        <select class="form-control input-small select2me" data-placeholder="Select..."  disabled>
                                            <option >Single Input</option>
                                            <option >Checkbox</option>
                                            <option >Radiogroup</option>
                                            <option >Imagepicker</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="text"  style="z-index:20;"  class="form-control" value="{{ $current_content[0][$k] }}">
                                        
                                    </div>
                                    <div class="col-2">
                                        <a class="btn btn-xs mb-2 btn-danger del-btnx" style="cursor:pointer;" data-id="11">
                                            <i class="fa fa-trash" style="color:white"></i>
                                        </a>
                                    </div>
                                </div>
                            @endfor
                            
                        </div>

                        <div class="col-12">
                            <div>
                                {!! Form::label('qt_row', trans('labels.backend.questions.fields.qt_row').'*', ['class' => 'control-label']) !!}    
                            </div>              
                            <div>
                                <a id="row_add"
                                class="btn btn-success" style="color:white; margin-top:10px;">+ Add Row</a>
                            </div>
                        </div>
                        <div id= "row_panel" class="col-12" style="padding-top:10px;">
                            <div class="row" >
                                <div class="col-2">
                                    <label>Cell Type</label>  
                                </div>
                                <div class="col-2">
                                    <label>Name</label>                             
                                </div>
                            </div>

                            @for($i =1;$i<count($current_content);$i++)
                                 <div class="row" >
                                    <div class="col-2">
                                        <select class="form-control input-small select2me" data-placeholder="Select..."  disabled>
                                            <option >Single Input</option>
                                            <option >Checkbox</option>
                                            <option >Radiogroup</option>
                                            <option >Imagepicker</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="text"  style="z-index:20;"  class="form-control" value="{{ $current_content[$i][0] }}">
                                        
                                    </div>
                                    <div class="col-2">
                                        <a class="btn btn-xs mb-2 btn-danger del-btnx" style="cursor:pointer;" data-id="11">
                                            <i class="fa fa-trash" style="color:white"></i>
                                        </a>
                                    </div>
                                </div>
                            @endfor 

                        </div>

                    </div>
                    
                    <div class="col-12" style="padding-top:3vh;">
                        {!! Form::label('value', 'value', ['class' => 'control-label']) !!}

                        <table id="real_matrix" width="100%">
                            <tr>
                                <td><input type="text" placeholder="" class="form-control empty-cell" value="  " disabled="" ></td>
                                @for ($j=1;$j<count($current_content[0]);$j++)
                                    <td><input type="text" placeholder="" class="form-control head" value="{{ $current_content[0][$j] }}" disabled="" ></td>
                                @endfor
                            </tr>
                            @for($i=1;$i<count($current_content);$i++)                                
                            <tr>
                                <td width="15%"><input type="text" placeholder="" class="form-control head" value="{{ $current_content[$i][0] }}" disabled=""></td>                               
                                @for($j=1;$j<count($current_content[0]);$j++)
                                    <?php
                                        $idx = $j."_".$i;
                                    ?>
                                    <td><input type="text" placeholder="" class="form-control" value="{{ $current_content[$i][$j] }}" id="{{$idx}}" onfocus="selectItemFunction(event)"></td>
                                @endfor
                            </tr>
                            @endfor
                        </table>
                        
                    </div> 
                </div>
            </div>     
        </div>        
            

        
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">Content</h3>          
        </div>
        <div class="card-body">
            <div class="logic_condition row clone_condition" style="padding-top:10px;">
                <div class="col-3" style="text-align:right">
                    <label> Type:</label>
                </div>

                <input class="chart_type" type="hidden" value="">
                <input id="chart_id" type="hidden" value="{{ $current_chart->id }}">
                <div class="col-5">
                    <select class="form-control btn-warning" id="chart_type" placeholder="Options">
                        <?php
                        $types=[
                            "pie chart",
                            "horizontal chart",
                            "stacked chart",
                            "vertical chart",
                            "line chart",
                            "point-styling chart",
                            "bubble chart",
                            "combo-bar-line chart",
                            "doughnut chart",
                            "multi-series-pie chart",
                            "polar-area chart",
                            "radar-chart",
                            "scatter chart",
                            "sortable-table",
                            "radar1-chart",
                            "responsive-table",
                            "not chart and table"
                        ];
                        ?>
                        @for($i=0;$i<count($types);$i++)
                            @if ($current_chart->type == $i)
                                <option value="{{ $i }}" selected>{{ $types[$i] }}</option>
                            @else
                                <option value="{{ $i }}">{{ $types[$i] }}</option>
                            @endif
                        @endfor
                    </select>
                </div>
                <div class="col-4">
                    <a id="create_chart"
                       class="btn btn-primary" style="color:white">Create Chart</a>
                    <a id="save_data"
                       class="btn btn-danger" style="color:white">Update Data</a>

                </div>

            </div>
            <div class="row">
{{--                <div class="col-12 form-group">--}}
{{--                    <div class="row" style="margin-top:10px!important">--}}
                        <div id="attr-list" class="col-2 "  style="margin-top:20px!important; margin-left: 50px; font-size: 1.6vw" >
                            <span class="col-12 row attr-li active" id="chart-attr"><a><b>Chart</b></a></span>
                            <span class="col-12 row attr-li" id="series-attr"><a><b>Series</b></a></span>
                            <span class="col-12 row attr-li" id="axes-attr"><a><b>Axes</b></a></span>
                            <span class="col-12 row attr-li" id="title-attr"><a><b>Title</b></a></span>
                            <span class="col-12 row attr-li" id="tooltip-attr"><a><b>Tooltip</b></a></span>
                            <span class="col-12 row attr-li" id="legend-attr"><a><b>Legend</b></a></span>
                        </div>
                        <div id="attr-div" class="form-group col-4"  style="margin-top:20px!important" >
                            <div id="chart-div" style="width: 100%; display: none">
                                <ul id="setting-list" style="list-style: none">
{{--                                    <li>--}}
{{--                                        <label class="col-12">Label</label>--}}
{{--                                        <input class="col-12 form-control " id="label_1" type="text" value="database1">--}}
{{--                                        <label class="col-12">Color</label>--}}
{{--                                        <input class="col-12 form-control input-small" type="color" id="color_1" value="#ff4323">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <label class="col-12">Label</label>--}}
{{--                                        <input class="col-12 form-control" id="label_2" type="text" value="database2">--}}
{{--                                        <label class="col-12">Color</label>--}}
{{--                                        <input class="col-12 form-control input-small" type="color" id="color_2" value="#85ff23">--}}
{{--                                    </li>--}}
                                </ul>

                                <label class="col-12">Chart Position</label>
                                <select class="form-control" id="chart_position" placeholder="Options">
                                    <option value="top" selected>Top Chart</option>
                                    <option value="bottom" >Bottom Chart</option>
                                    <option value="right" >Right Chart</option>
                                    <option value="left" >Left Chart</option>
                                </select>
                            </div>
                            <div id="series-div" style="width: 100%; display: none">
                                <label for="" >Series</label>
                                <input type="text" class="form-control">
                                <label for="" >Series List</label>
                                <ul id="series-list" style="list-style: none">

                                </ul>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div id="pie-chartdiv" class="col-4" style=" display: flex;">
                            <canvas id="pie-chart" class="col-12" style="margin:auto!important;" ></canvas>
                        </div>
{{--                    </div>--}}
{{--                </div>--}}
            </div>
      
       
        </div>
    </div>

    
    <script type="text/javascript" src="{{asset('js/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/ui-nestable.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.nestable.js')}}"></script>

    <!-- <script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/dataTables.bootstrap.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('js/table-editable.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--    <script src="{{asset('js/utils.js')}}"></script>--}}

    <script type="text/javascript" src="{{asset('js/chart-edit.js')}}"></script>

    <script src="{{ asset('assets/metronic_assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript" src="{{asset('js/3.5.1/jquery.min.js')}}"></script>

    {{-- <link href="{{asset('css/custom.css')}}"  rel="stylesheet" type="text/css"/> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/metronic_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}"/>   
    <script type="text/javascript" src="{{asset('assets/metronic_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"></script>

    {{-- ///////////////////////////////chart/////////////// --}}
{{--    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>--}}
{{--    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>--}}
{{--    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>--}}
{{--    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>--}}
{{--    <script src="https://cdn.amcharts.com/lib/4/themes/kelly.js"></script>--}}
{{--    <script src='https://cdn.plot.ly/plotly-2.9.0.min.js'></script>--}}
    <script src="{{asset('js/pie-chart.js')}}"></script>
    <script src="{{asset('js/stacked-chart.js')}}"></script>
    <script src="{{asset('js/vertical-chart.js')}}"></script>
    <script src="{{asset('js/horizontal_chart.js')}}"></script>
    <script src="{{asset('js/horizontal-bar.js')}}"></script>
    <script src="{{asset('js/line-chart.js')}}"></script>
    <script src="{{asset('js/radar-chart.js')}}"></script>
    <script src="{{asset('js/polar-chart.js')}}"></script>
    <script src="{{asset('js/bubble-chart.js')}}"></script>
    <script src="{{asset('js/radar1-chart.js')}}"></script>
    <script src="{{asset('js/responsive-table.js')}}"></script>
    <script src="{{asset('js/sortable-table.js')}}"></script>
    <script src="{{asset('js/no-table-chart.js')}}"></script>
    <script src="{{asset('js/point-styling chart.js')}}"></script>
    <script src="{{asset('js/combo-line-chart.js')}}"></script>
    <script src="{{asset('js/doughnut-chart.js')}}"></script>
    <script src="{{asset('js/multi-series-pie-chart.js')}}"></script>
    <script src="{{asset('js/polar-area-chart.js')}}"></script>
    <script src="{{asset('js/scatter-chart.js')}}"></script>

    <script>  

        jQuery(document).ready(function(e) {       
            // initiate layout and plugins
            // Metronic.init(); // init metronic core components
            // Layout.init(); // init current layout
            // QuickSidebar.init(); // init quick sidebar
            // Demo.init(); // init demo features
            UITree.init();  
            UINestable.init();
            TableEditable.init();
            ChartEdit.init();  
            //UIToastr.init();  
        });
    </script>








    
@stop

