@extends('layouts.app')

 
   
@section('style')
 
        <script src="{!! url('assets/js/jquery.min.js') !!}"></script>
 
        <script src="{!! url('assets/js/jquery-ui.min.js') !!}"></script>
 
<style>
    .md-card{
        width: auto;
         
    
    
    
    }
</style>
@endsection
 @section('content')
  @inject('sys', 'App\Http\Controllers\SystemController')
 <div align="center">
     <div class="uk-width-xLarge-1-1">
  <h5 > Medical Records update for | {!! $year !!} Academic Year</h5>
             <hr>
             <form method="POST" action="{{ url('store_medicals') }}"  enctype="multipart/form-data"  accept-charset="utf-8"  name="medicals"  v-form>
                  <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
             <div class="uk-grid" data-uk-grid-margin>
                 
                   
                  <div align="center">
                      <center align=" " class="style1">Personal Records of {!! $data[0]->TITLE.$data[0]->NAME!!}</center>
                  </div>
     <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                <div class="uk-width-medium-1-2">
                    <div class="md-card">
                        <div class="md-card-content">
                            <table width="741" border="0">
                        <tr>
                            <td width="495"><div class="divcurve" style=" ">



                                    <table   class="">
                                         <tr>
                                            <th  align=""> <div  align="right" >Admission Number</div></th>
                                        <td>
                                      
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" >Index Number</div></th>
                                        <td>
                                            {{ $data[0]->INDEXNO}}
                                             
                                        </td>
                                        </tr>
                                         
                                        <tr>
                                            <th  align=""> <div  align="right" >Full Name</div></th>
                                        <td>
                                            {{ $data[0]->NAME}}
                                            <input type="hidden" name="student" id="student" value="{{ $data[0]->INDEXNO}}" />
                                            
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" >Level</div></th>
                                        <td>
                                            {{ $data[0]->LEVEL}}
                                            <input type="hidden" name="level" id="level" value="{{ $data[0]->LEVEL}}" />
                                            <input type="hidden" name="phone" id="phone" value="{{ $data[0]->TELEPHONENO}}" />
                                             
                                        </td>
                                        </tr>
                                         <tr>
                                             <th  align=""> <div  align="right" >Phone N<u>o</u></div></th>
                                        <td>
                                            {{ '0'.$data[0]->TELEPHONENO}}
                                            
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" >Programme</div></th>
                                        <td>
                                       
                                            {!! $sys->getProgram($data[0]->PROGRAMMECODE )!!}
                                            <input type="hidden" name="programme"   value="{{ $data[0]->PROGRAMMECODE}}" />
                                            
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" class="uk-text-danger"> Blood Group</div></th>
                                        <td>
                                          A+
                                            
                                        </td>
                                        </tr>
                                          
                                         <tr>
                                            <th  align=""> <div  align="right" class="uk-text-primary">NHIS</div></th>
                                        <td> 
                                        393993
                                        </td>
                                        </tr>
                                         
                                    </table>
                                </div>
                            </td></tr>
                        
                                        
                         
                                     </table>
                        </div>
                    </div>
                </div>
                <div class="uk-grid uk-grid-medium uk-grid-width-medium-1-2 uk-grid-width-large-1-3">
                               <table   border="0" bordercolor="">
                         <tr>
                             <td><a href=" "><img class="" style="width:150px;height: auto;margin-top: -46px"  <?php
                                     $pic = $data[0]->INDEXNO;
                                     echo $sys->picture("{!! url(\"albums/students/$pic.JPG\") !!}", 90)
                                     ?>   src='{{url("albums/students/$pic.JPG")}}' alt=" Picture of Student Here"    /></a></td> 

                         <p align="center">&nbsp;</p></td>
                         </tr>


                     </table>
                        
                </div>
             <div id="wizard_vertical">

                 <h3>Laboratory</h3>
                 <section>
                     <h3 class="heading_b">
                         Heamatology Report
                         
                     </h3>
                     <hr class="md-hr">
                     (<small class="uk-text-danger">Fields mark in red are required</small>)
                     <h3 class="heading_a"></h3>
                      
                           <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             @if($data[0]->SEX=='Male')
                               <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">HB Male<span class="uk-text-danger">*</span> </label><input type="text" id="" name="hb_male" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                              @else
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">HB Female<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="hb_female" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                           </div>
                                </div>
                              @endif
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Plate<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="plates" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Hbs, AG<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="hbs" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                         
                                    </div>
                                </div>
                              <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">WBCs<span class="uk-text-danger">*</span> </label><input type="text" id="" name="wbc" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>


                            </div>
                 
                     <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                              <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">G6DP<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="g6dp" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                         
                                    </div>
                                </div>
                                
                                 @if($data[0]->SEX=='Male')
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">PCV Male<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="pcv_male" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                           </div>
                                </div>
                                 @else
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">PVC Female<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="pcv_female" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                                 @endif
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Hbs, AG<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="hbs" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                         
                                    </div>
                                </div>
                                  @if($data[0]->SEX=='Male')
                                  <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">ESR Male<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="esr_male" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                         
                                    </div>
                                </div>
                                  @else
                                 <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">ESR Female<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="esr_female" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                         
                                    </div>
                                </div>
                                  @endif

                            </div>
                     
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Reticulocytes<span class="uk-text-danger">*</span> </label><input type="text" id="" name="reticulocytes" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div> 
                          
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Sickling<span class="uk-text-danger">*</span>  </label>
                                            <p></p>
                                               {!!  Form::select('sickling', array('AS'=>'AS','AA'=>'AA'), null, ['placeholder' => 'select sickling','id'=>'parent','class'=>'md-input parent'],old("sickling","")); !!}
                    
                                            <span class="md-input-bar"></span></div>                
                                           </div>
                                </div>
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">B/F<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="bf" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                                 
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Blood Grouping<span class="uk-text-danger">*</span>  </label>
                                            <p></p>
                                               {!!  Form::select('blood_group', array('A+'=>'A+','A-'=>'A-'), null, ['placeholder' => 'select type','id'=>'parent','class'=>'md-input parent'],old("blood_group","")); !!}
                    
                                            <span class="md-input-bar"></span>
                                        </div>                
                                         
                                    </div>
                                </div>
                                  
                                  
                                  

                            </div>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                            <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">HB Electrophoresis<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="electrophoresis" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                         
                                    </div>
                                </div>
                                 
                                
                      </div>
                     
                      <h3 class="heading_b">
                        Parasitology Laboratory (Stool Form)
                         
                     </h3>
                     <hr class="md-hr">
                     <h4>Macroscopy</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Macroscopy<span class="uk-text-danger">*</span> </label><input type="text" id="" name="macroscopy" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                                 

                     </div>
                      <hr class="md-hr">
                     <h4>Microscopy</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Microscopy<span class="uk-text-danger">*</span> </label><input type="text" id="" name="microscopy" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div> 
                          
                               <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Ova<span class="uk-text-danger">*</span> </label><input type="text" id="" name="ova" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Larvae<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="larvae" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                                 
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Vegetative Form<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="vegitative" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                      </div>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                  <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Cytes<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="cytes" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                           <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Red Blood Cells<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="rbc" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                          <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">White Blood Cells<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="wbc" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                      </div>  
                      <hr class="md-hr">
                     <h4>Chemistry</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Occult Blood Cells<span class="uk-text-danger">*</span> </label><input type="text" id="" name="obc" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                                 

                     </div>
                    <h3 class="heading_b">
                        Parasitology Laboratory (Urine Form)
                         
                     </h3>
                     <hr class="md-hr">
                     <h4>Macroscopy</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Macroscopy<span class="uk-text-danger">*</span> </label><input type="text" id="" name="macroscopy_urine" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                                 

                     </div>
                      <hr class="md-hr">
                     <h4>Chemisty</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Ph<span class="uk-text-danger">*</span> </label><input type="text" id="" name="ph_" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div> 
                          
                               <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Blood<span class="uk-text-danger">*</span> </label><input type="text" id="" name="blood_" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Ketones<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="ketones_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                                 
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Glucose<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="glucose_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                      </div>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                  <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Sp Gravity<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="gravity_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                           <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Bile Pigments<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="bile_pigments_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                          <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Protein<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="protein_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                          <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Bile Salts<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="bile_salt_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                      </div>  
                     
                     
                          <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                  <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Urobilinnogen<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="uro_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                           <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Bilrubin<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="bilrubin" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                          
                      </div> 
                      <hr class="md-hr">
                     <h4>Microscopy</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Microscopy<span class="uk-text-danger">*</span> </label><input type="text" id="" name="microscopy_" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div> 
                          
                               <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Plus cells per high power field<span class="uk-text-danger">*</span> </label><input type="text" id="" name="plus_" class="md-input"   required=""       v-model="hb"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                       
                                    </div>
                                </div>
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">RBCs<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="rbc_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                                 
                                
                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Epith<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="epith_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                      </div>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                  <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Crystals<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="crystals_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                           <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">S.Haematobium ova<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="haematobium_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                          <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">T.Vaginalis<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="vagina_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                      </div> 
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                  <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Candida<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="candida_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                                </div>
                           <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Cast<span class="uk-text-danger">*</span>  </label><input type="text" id="plates" name="cast_" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                              </div>
                            </div>
                           
                      </div>      
                     
                      <hr class="md-hr">
                     <h4>Widal</h4>
                      <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                             <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Widal<span class="uk-text-danger">*</span> </label>
                                            <p></p>
                                            {!!  Form::select('widal', array('Salmonella Typhi antigen O'=>'Salmonella Typhi antigen O','Salmonella Typhi antigen H'=>'Salmonella Typhi antigen H'), null, ['placeholder' => 'select type','id'=>'parent','class'=>'md-input parent'],old("widal","")); !!}
                    
                                            <span class="md-input-bar"></span>
                                        </div>                
                                       
                                    </div>
                                </div>
                                 

                     </div>

                            
                 </section>
                 <h3>X-Ray</h3>
                 <section>
                     <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                            <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled">
                                            <label for="wizard_email">X-Ray<span class="uk-text-danger">*</span>  </label>
                                            <input type="text" id="plates" name="xray" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span>
                                        </div>                
                                         
                                    </div>
                                </div>
                                 
                                  
                                
                      </div>      

                            
                 </section>
                 <h3>Physical Exams</h3>
                 <section>
                     <div data-uk-grid-margin=""style="margin-left: -37px" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                       
                                        <div class="md-input-wrapper md-input-filled">
                                            <label for="wizard_email">Physical Exam<span class="uk-text-danger">*</span>  </label>
                                            <input type="text" id="plates" name="physicals" class="md-input"   required=""       v-model="plates"  v-form-ctrl><span class="md-input-bar"></span>
                                        </div>                
                                         
                                    </div>
                                </div>
                                
                      </div>
                 
                 <!-- parasitology -- urine -->
                 <div class="uk-width-medium-1-10" style=" ">
                            <div class="uk-margin-small-top">                            
                          
                            <button class="md-btn   md-btn-success uk-margin-small-top" type="submit">Save<i class="material-icons">save</i></button> 
                            </div>
                        </div>
                 
                 </section>
                  

             </div>
            </div>
                 
             </div>
                  
             </div>
             </form>
 </div>
 </div>
 @endsection
 
@section('js')
 
  <script>
 
    // load parsley config (altair_admin_common.js)
    altair_forms.parsley_validation_config();
    // load extra validators
    altair_forms.parsley_extra_validators();
    

</script>
@endsection