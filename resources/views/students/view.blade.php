@extends('layouts.printlayout')

@section('content')
&nbsp;
<center><img src='{!! url("assets/img/health.png")!!}' style="width:100px;height: auto"/></center>
<center><h3>Takoradi Polytechnic Health System</h3></center> 
<center><div><h4>Patient Information</h4></div></center>
<div class="uk-grid" data-uk-grid-margin>
   
    <div></div>
    <div class="uk-width-large-7-10">
  @inject('sys', 'App\Http\Controllers\SystemController')
         <table  border="0" align="left" class="uk-table uk-table-nowrap uk-table-hover uk-table-no-border" style="border:1px solid #fff">
        <tr>
          <td width="210" class="uppercase" align="right"><strong>INDEXNO N<u>O</u></strong></td>
          <td width="408" class="capitalize"><?php echo $data->INDEXNO ?></td>
            <td width="260" rowspan="8" >
                <img class="" style="width:150px;height: auto;margin-top: -123px"  <?php
                                     $pic = $data->INDEXNO;
                                     echo $sys->picture("{!! url(\"albums/students/$pic.JPG\") !!}", 90)
                                     ?>   src='{{url("albums/students/$pic.JPG")}}' alt=" Picture of Student Here"    />
            </td>							
        </tr>
        
        
        <tr>
          <td class="uppercase" align="right"><strong>SURNAME:</strong></td>
          <td class="capitalize"><?php echo $data->SURNAME  ?></td>
        </tr>
         <tr>
          <td class="uppercase" align="right"><strong>FIRST NAME:</strong></td>
          <td class="capitalize"><?php echo $data->FIRSTNAME ?></td>
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>AGES</strong>:</td>
          <td class="capitalize"><?php   echo $data->DOB?></td>
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>GENDER</strong>:</td>
          <td class="capitalize"><?php   echo $data->SEX?></td>
        </tr>
        <tr>
          <td height="51" align="right" class="uppercase" style="vertical-align:top"><strong>RELIGION:</strong></td>
          <td class="capitalize"><?php echo $data->RELIGION ?></td>
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>PHONE:</strong></td>
          <td class="capitalize">0<?php echo $data->TELEPHONENO ?></td>
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>EMAIL:</strong></td>
          <td class="capitalize"><?php echo $data->EMAIL ?></td>
          
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>PROGRAMME:</strong></td>
          <td class="capitalize">{!! $sys->getProgram($data->PROGRAMMECODE )!!}</td>
          
        </tr>
        <tr>
          <td class="uppercase" align="right"><strong>CONTACT ADDRESS</strong></td>
          <td class="capitalize">{!! $data->ADDRESS !!}</td>
          
        </tr>
        
        
        <tr>
         <td class="uppercase" align="right"><strong>NATIONALITY:</strong></td>
          <td class="capitalize"><?php ?></td>
          
        </tr> 
      </table>
	 		 
  <center><p>Laboratory</p></center>    
                         <div class="school">
                      
                           
                             <div class="row-fluid">
                                     <div class="span12">
                                         <div class="box">
                                             <div class="box-title">
                                                 <h4><Center><p class="uk-text-bold uk-text-success full_width_in_card heading_c">HEAMATOLOGY</p></center></h4>
                                             </div>

                                            <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
        
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>HB (MALE):</strong></td>
                                                        <td class="capitalize">{{ @$heamatology->HB_MALE }}</td>
                                                         <td class="uppercase" ><strong>HB (FEMALE):</strong></td>
                                                        <td class="capitalize">{{ @$heamatology->HB_FEMALE }}</td>
                                                    </tr>
                                                   <tr>
                                                        <td class="uppercase" ><strong>PCV (MALE):</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->PCV_MALE }}</td>
                                                         <td width="210" class="uppercase" align=""><strong>PCV (FEMALE)</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->PCV_FEMALE }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" ><strong>ESR (MALE):</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->ESR_MALE }}</td>
                                                         <td width="210" class="uppercase" align=""><strong>ESR (FEMALE)</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->ESR_FEMALE }}</td>
                                                    </tr>
                                                    
                                                     <tr>
                                                        <td class="uppercase" ><strong>RETICULOCYTES %</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->RETICULOCYTES }}</td>
                                                         <td width="210" class="uppercase" align=""><strong>SICKLING</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->SICKLING }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" ><strong>B/F %</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->BF }}</td>
                                                         <td width="210" class="uppercase" align=""><strong>BLOOD GROUP</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->BLOOD_GROUP }}</td>
                                                    </tr>
                                                     <tr>
                                                         <td class="uppercase" ><strong>HB ELECTROPHORESIS</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->HB_ELECTROPHORESIS }}</td>
                                                         <td width="210" class="uppercase" align=""><strong>G6DP</strong></td>
                                                        <td class="capitalize" >{{ @$heamatology->G6DP }}</td>
                                                    </tr>
                                                    
                                            </table>
                                         </div>
                                         <p>&nbsp;</p>
                                          <div class="box" id="micro">
                                             <div class="box-title">
                                                 <h4><Center><p class="uk-text-bold uk-text-success full_width_in_card heading_c">PARASITOLOGY | STOOL FORM</p></center></h4>
                                             </div>

                                            <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>Microscopy</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>OVA:</strong></td>
                                                        <td class="capitalize">{{ @$micro_stool->OVA }}</td>
                                                         <td class="uppercase" ><strong>MICROSCOPY:</strong></td>
                                                        <td class="capitalize">{{ @$micro_stool->MICROSCOPY }}</td>
                                                    </tr>
                                                   <tr>
                                                        <td class="uppercase" align=""><strong>LARVAE</strong></td>
                                                        <td class="capitalize">{{ @$micro_stool->LARVAE }}</td>
                                                         <td class="uppercase" ><strong>VEGETATIVE FORMS:</strong></td>
                                                        <td class="capitalize">{{ @$micro_stool->VEGETATIVE }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>CYTES</strong></td>
                                                        <td class="capitalize">{{ @$micro_stool->CYTES }}</td>
                                                         <td class="uppercase" ><strong>RED BLOOD CELL</strong></td>
                                                        <td class="capitalize">{{ @$micro_stool->RBC }}</td>
                                                    </tr>
                                                    
                                                     <tr>
                                                        <td class="uppercase" ><strong>WHITE BLOOD CELL</strong></td>
                                                        <td class="capitalize" >{{ @$micro_stool->WBC }}</td>
                                                        
                                                    </tr>
                                                    
                                                    
                                            </table>
                                                                 <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>Chemistry</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>Occult blood cell:</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_stool->OBC }}</td>
                                                    </tr>
                                                   
                                                    
                                                    
                                            </table>
                                         </div>
                                         <p>&nbsp;</p>
                                          <div class="box" id="urine">
                                             <div class="box-title">
                                                 <h4><Center><p class="uk-text-bold uk-text-success full_width_in_card heading_c">PARASITOLOGY | URINE FORM</p></center></h4>
                                             </div>

                                            <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>Chemistry</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>PH:</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->PH }}</td>
                                                         <td class="uppercase" ><strong>BLOOD:</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->BLOOD }}</td>
                                                    </tr>
                                                   <tr>
                                                        <td class="uppercase" align=""><strong>KETONES</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->KETONES }}</td>
                                                         <td class="uppercase" ><strong>GLUCOSE:</strong></td>
                                                        <td class="capitalize">{{  @$chemistry_urine->GLUCOSE }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>PROTEIN</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->PROTIEN }}</td>
                                                         <td class="uppercase" ><strong>SP GRAVITY</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->SP_GRAVITY }}</td>
                                                    </tr>
                                                    
                                                     <tr>
                                                        <td class="uppercase" ><strong>BILE PIGMENTS</strong></td>
                                                        <td class="capitalize" >{{ @$chemistry_urine->BILE_PIGMENTS }}</td>
                                                        <td class="uppercase" ><strong>BILE SALTS</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->BILE_SALTS }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" ><strong>Urobilinnogen</strong></td>
                                                        <td class="capitalize" >{{ @$chemistry_urine->UROBILINNOGEN }}</td>
                                                        <td class="uppercase" ><strong>BILIRUBIN</strong></td>
                                                        <td class="capitalize">{{ @$chemistry_urine->BILIRUBIN }}</td>
                                                    </tr>
                                                    
                                                    
                                                    
                                            </table>
                                            <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>Microscopy</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>PLUS CELL PER HIGH POWER FIELD</strong></td>
                                                        <td class="capitalize">{{ @$micro_urine->PLUS_CELL_PER_HIGH }}</td>
                                                         <td class="uppercase" ><strong>RBCs:</strong></td>
                                                       <td class="capitalize">{{ @$micro_urine->RBC }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>EPITH</strong></td>
                                                        <td class="capitalize">{{ @$micro_urine->EPITH }}</td>
                                                         <td class="uppercase" ><strong>CRYSTALS</strong></td>
                                                        <td class="capitalize">{{ @$micro_urine->CRYSTALS }}</td>
                                                    </tr>
                                                    
                                                     <tr>
                                                        <td class="uppercase" align=""><strong>S. HAEMATOBIUM OVA</strong></td>
                                                        <td class="capitalize">{{ @$micro_urine->HAEMOTOBIUM_OVA }}</td>
                                                         <td class="uppercase" ><strong>T.VAGINALIS</strong></td>
                                                        <td class="capitalize">{{ @$micro_urine->TVAGINALIS }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="uppercase" ><strong>	CANDIDA</strong></td>
                                                        <td class="capitalize" >{{ @$micro_urine->CANDIDA }}</td>
                                                        <td class="uppercase" ><strong>CAST</strong></td>
                                                        <td class="capitalize">{{ @$micro_urine->CAST }}</td>
                                                    </tr>
                                                    
                                                    
                                                    
                                                    
                                            </table>
                                               <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>Widal</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>SALMONELLA:</strong></td>
                                                        <td class="capitalize">{{ @$widal->ANTIGEN }}</td>
                                                    </tr>
                                                   
                                                    
                                                    
                                            </table>
                                         </div>
                                         <p>&nbsp;</p>
                                          <div class="box" id="urine">
                                             <div class="box-title">
                                                 <h4><Center><p class="uk-text-bold uk-text-success full_width_in_card heading_c">X-RAY AND PHYSICALS</p></center></h4>
                                             </div>

                                            <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>X-RAY</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>X RAY:</strong></td>
                                                        <td class="capitalize">{{ @$xray->TYPE }}</td>
                                                             
                                                    </tr>
                             
                                                    
                                            </table>
                                            <table width="100px" align="left" class="uk-table uk-table-nowrap uk-table-hover" >
                                                <caption>PHYSICALS</caption>
                                                    <tr>
                                                        <td class="uppercase" align=""><strong>PHYSICALS</strong></td>
                                                        <td class="capitalize">{{ @$physical->TYPE }}</td>
                                                         
                                                    </tr>
                                                    
                                                     
                                                    
                                                    
                                                    
                                            </table>
                                               
                                         </div>
                                     
                 </div>
   

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