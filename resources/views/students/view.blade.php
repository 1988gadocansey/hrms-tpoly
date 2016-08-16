@extends('layouts.printlayout')

@section('content')
&nbsp;
<center><img src='{!! url("assets/img/health.png")!!}' style="width:100px;height: auto"/></center>
<center><h3>Takoradi Technical University</h3></center> 
<center><div><h4>Student Medical Report</h4></div></center>
<div class="uk-grid" data-uk-grid-margin>
   
    <div></div>
    <div class="uk-width-large-7-10">
  @inject('sys', 'App\Http\Controllers\SystemController')
         <table   class="uk-table uk-table-nowrap "  >
        <tr>
          <td width="210" class="uppercase" align="right"><strong>INDEXNO N<u>O</u></strong></td>
          <td width="408" class="capitalize">{{ $student->INDEXNO }}</td>
            <td width="260" rowspan="8" >
                <img class="" style="width:150px;height: auto;margin-top: -123px"  <?php
                                     $pic = $student->INDEXNO;
                                     echo $sys->picture("{!! url(\"albums/students/$pic.JPG\") !!}", 90)
                                     ?>   src='{{url("albums/students/$pic.JPG")}}' alt="  Affix student picture here"    />
            </td>							
        </tr>
        
        
        <tr>
          <td class="uppercase" align="right"><strong>SURNAME:</strong></td>
          <td class="capitalize"><?php echo $student->SURNAME  ?></td>
        </tr>
         <tr>
          <td class="uppercase" align="right"><strong>FIRST NAME:</strong></td>
          <td class="capitalize"><?php echo $student->FIRSTNAME ?></td>
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>AGE</strong>:</td>
          <td class="capitalize"><?php   echo $student->AGE?></td>
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>GENDER</strong>:</td>
          <td class="capitalize"><?php   echo $student->SEX?></td>
        </tr>
         
        <tr>
          <td class="uppercase" align="right"><strong>PHONE:</strong></td>
          <td class="capitalize">0<?php echo $student->TELEPHONENO ?></td>
        </tr>
       
        <tr>
          <td class="uppercase" align="right"><strong>PROGRAMME:</strong></td>
          <td class="capitalize">{!! $sys->getProgram($student->PROGRAMMECODE )!!}</td>
          
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>CONTACT ADDRESS</strong></td>
          <td class="capitalize">{!! $student->ADDRESS !!}</td>
          
        </tr>
        
        
         
      </table>
	 		 
    
   

      <h4><Center><p class="uk-text-bold uk-text-success full_width_in_card heading_c">LABORATORY TEST</p></center></h4>

      <table class="uk-table uk-table-nowrap" id=""> 
                                           <thead>
                                            <tr>
                                                
                                                <th class="uk-width-1-10">Test</th>
                                                <th class="uk-width-2-10">Specimen</th>
                                                <th class="uk-width-2-10">Diagnosis</th>
                                                <th class="uk-width-2-10">Result</th>
                                                <th class="uk-width-2-10">Comment</th>
                                                 
                                            </tr>
                                        </thead>

                                         
                                        <tbody>
                                            @foreach($data as $key=> $rows) 
                                          
                                            <tr align="">
                                                 
                                                <td> {{ @$rows->testName->NAME }}</td>
                                                <td> {{ @$rows->SPECIMEN }}</td>
                                                <td> {{ @$rows->DIAGNOSIS }}</td>
                                                <td> {{ @$rows->RESULT }}</td>
                                                <td> {{ @$rows->COMMENT }}</td>
                                               
                                            </tr>
                                            @endforeach
                                        </tbody>
                                         <p>&nbsp;</p>
                                <table width="809" height="90" border="0">
                                    <tr>
                                        <td width="362"><p>.................................................................</p>
                                            <p align='center'>Student's Signature</p></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td width="362"><p>.................................................................</p>
                                            <p align='center'>Laboratory Technician Signature</p></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td width="431"><p align="">.................................................................</p>
                                            <p align="center">Doctor Signature</p></td>
                                    </tr>
                                </table>
                                 <div class="visible-print text-center" align='center'>
                                       {!! QrCode::size(100)->generate(Request::url()); !!}
                                </div>
                               
  
   
    </div> 
        
 @endsection
 
@section('js')
 <script type="text/javascript">
  
$(document).ready(function(){
window.print();
//window.close();
});

</script>
  
@endsection