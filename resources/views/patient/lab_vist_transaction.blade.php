@extends('layouts.app')


@section('style')

@endsection
@section('content')
 @inject('sys', 'App\Http\Controllers\SystemController')
<div class="md-card-content">

    @if($messages=Session::get("success"))

    <div class="uk-form-row">
        <div style="text-align: center" class="uk-alert uk-alert-success" data-uk-alert="">

            <ul>
                @foreach ($messages as $message)
                <li> {!!  $message  !!} </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif


    @if (count($errors) > 0)


    <div class="uk-alert uk-alert-danger  uk-alert-close" style="background-color: red;color: white" data-uk-alert="">

        <ul>
            @foreach ($errors->all() as $error)
            <li>{!!$error  !!} </li>
            @endforeach
        </ul>
    </div>

    @endif


</div>

<h5>Patient Form</h5>  
<div class="uk-width-xLarge-1-1">
     
                <div align="center">
                      <center align=" " class="style1">Personal Records of {!! $data[0]->title.' '.$data[0]->firstname.' '.$data[0]->othername.' '. $data[0]->surname!!}</center>
                  </div>
                  <div class="uk-grid uk-grid-medium uk-grid-width-medium-1-2 uk-grid-width-large-1-3" style="float: right">
                               <table   border="0" bordercolor="">
                         <tr>
                             <td><a href=" "><img class="" style=" margin-top: "  <?php
                                     $pic = $data[0]->INDEXNO;
                                     echo $sys->picture("{!! url(\"albums/students/07130252.JPG\") !!}", 190)
                                     ?>   src='{{url("albums/students/07130252.JPG")}}' alt=" Picture of Patient here"    /></a></td> 

                         <p align="center">&nbsp;</p></td>
                         </tr>


                     </table>
                        
                </div>
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                <div class=" ">
                    <div class="md-card">
                        <div class="md-card-content">
                            <table class="uk-table-no-border" border="0">
                        <tr>
                            <td width="495"><div class="divcurve" style=" ">



                                    <table   class="">
                                         <tr>
                                             <th  align=""> <div  align="right" >Folder N<u>o</u></div></th>
                                        <td>
                                                  {{ $data[0]->hospital_id}}
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" >Full Name</div></th>
                                        <td>
                                          {!! $data[0]->title.' '.$data[0]->firstname.' '.$data[0]->othername.' '. $data[0]->surname!!}   
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" >Gender</div></th>
                                        <td>
                                            {{ $data[0]->sex}}
                                             
                                        </td>
                                        </tr>
                                         
                                        
                                        <tr>
                                            <th  align=""> <div  align="right" >Age</div></th>
                                        <td>
                                            {{ $data[0]->age}}yr(s)
                                             
                                        </td>
                                        </tr>
                                         <tr>
                                             <th  align=""> <div  align="right" >NHIS N<u>o</u></div></th>
                                        <td>
                                            {{  $data[0]->nhis_id}}
                                            
                                        </td>
                                        </tr>
                                        <tr>
                                            <th  align=""> <div  align="right" >Last Visit</div></th>
                                        <td>
                                              {{  $data[0]->lastVisit}}
                                        </td>
                                        </tr>
                                         
                                         
                                    </table>
                                </div>
                            </td></tr>
                        
                                        
                         
                                     </table>
                        </div>
                    </div>
                </div>
                    
            </div>
    <p>&nbsp;</p>
        <div class=" ">
                    <div class="md-card">
                        <div class="md-card-content">
                             <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1_content'}" id="tabs_1">
                                <li class="uk-active"><a href="#">Visit History</a></li>
                                  <li class="named_tab"><a href="#">Lab Tests</a></li>
                                <li><a href="#">Drugs</a></li>
                              
                                <li class="uk-disabled"><a href="#">NHIS</a></li>
                            </ul>
                            <ul id="tabs_1_content" class="uk-switcher uk-margin">
                                <div>
                                    <table id="dt_scroll" class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Diagnosis 1</th>
                                                <th>Diagnosis 2</th>
                                                <th>Diagnosis 3</th>
                                                <th>Diagnosis 4</th>
                                                <th>Outcome</th>
                                                <th>Insurance</th>
                                                <th>Doctor</th>
                                                
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Diagnosis 1</th>
                                                <th>Diagnosis 2</th>
                                                <th>Diagnosis 3</th>
                                                <th>Diagnosis 4</th>

                                                 
                                                <th>Outcome</th>
                                                <th>Insurance</th>
                                                <th>Doctor</th>
                                                 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($history as $index=> $row) 
                                         
                                        
                                        
                                         
                                        <tr align="">
                                            <td> {{@$row->date }}</td>
                                            <td> {{ @$row->diagnosis1 }}</td>
                                            <td> {{ @$row->diagnosis2 }}</td>
                                            <td> {{ @$row->diagnosis3 }}</td>
                                            <td> {{ @$row->diagnosis4 }}</td>
                                            <td> {{ @$row->outcome }}</td>
                                            <td> {{ @$row->nhis_status }}</td>

                                            <td> {{ @$row->doctor->name }}</td>

                                        </tr>
                                         @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                 <div>
                                    <table id="dt_tableTools" class="uk-table   uk-table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Test</th>
                                                <th>Specimen</th>
                                                <th>Diagnosis</th>
                                                <th>Result</th>
                                                <th>Comment</th>
                                                <th>Lab Technician</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>Date</th>
                                                <th>Test</th>
                                                <th>Specimen</th>
                                                <th>Diagnosis</th>
                                                <th>Result</th>
                                                <th>Comment</th>
                                                <th>Lab Technician</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($lab as $key=> $rows) 
                                          
                                            <tr align="">
                                                <td> {{ @$rows->DATE }}</td>
                                                <td> {{ @$rows->testName->NAME }}</td>
                                                <td> {{ @$rows->SPECIMEN }}</td>
                                                <td> {{ @$rows->DIAGNOSIS }}</td>
                                                <td> {{ @$rows->RESULT }}</td>
                                                <td> {{ @$rows->COMMENT }}</td>
                                                <td> {{ @$rows->doctor->name }}</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                 <div>
                                    <table id="dt_individual_search" class="uk-table   uk-table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Case History</th>
                                                <th>Drug</th>
                                                <th>Quantity</th>
                                                <th>Dosage</th>
                                                <th>Pharmacist</th>
                                                
                                            </tr>
                                        </thead>

                                         
                                        <tbody>
                                            @foreach($drug as $k=> $rox) 
                                          
                                            <tr align="">
                                                <td> {{ @$rox->timestamp }}</td>
                                                <td> {{ @$rox->case_history }}</td>
                                                <td> {{ @$rox->drugName->NAME }}</td>
                                                <td> {{ @$rox->quantity }}</td>
                                                <td> {{ @$rox->dosage }}</td>
                                                 
                                                <td> {{ @$rox->doctor->name }}</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <li>Content 4</li>
                            </ul>
                        </div>
                    </div>
                        </div>
                    </div>
        </div>
</div>
<p></p>
<div class="uk-width-xLarge-1-1">
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid" data-uk-grid-margin>
                 
                   
                  

            <form  novalidate id="wizard_advanced_form" class="uk-form-stacked"   action="" method="post" accept-charset="utf-8"  name="patientForm"  v-form>

                {!!  csrf_field() !!}
                <div data-uk-observe="" id="wizard_advanced" role="application" class="wizard clearfix">
                    <div class="steps clearfix">
                        <ul role="tablist">
                            <li role="tab" class="fill_form_header first current" aria-disabled="false" aria-selected="true" v-bind:class="{ 'error' : !in_payment_section}">
                                <a aria-controls="wizard_advanced-p-0" href="#wizard_advanced-h-0" id="wizard_advanced-t-0">
                                    <span class="current-info audible">current step: </span><span class="number">1</span> <span class="title">Biodata</span>
                                </a>
                            </li>
                            <li role="tab" class="payment_header disabled" aria-disabled="true"   v-bind:class="{ 'error' : in_payment_section}" >
                                <a aria-controls="wizard_advanced-p-1" href="#wizard_advanced-h-1" id="wizard_advanced-t-1">
                                    <span class="number">2</span> <span class="title">Vitals</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class=" clearfix " style="box-sizing: border-box;display: block;padding:15px!important;position: relative;">

                        <!-- first section -->
                        {{-- <h3 id="wizard_advanced-h-0" tabindex="-1" class="title current">Fill Form</h3> --}}
                        <section id="fill_form_section" role="tabpanel" aria-labelledby="fill form section" class="body step-0 current" data-step="0" aria-hidden="false"   v-bind:class="{'uk-hidden': in_payment_section} ">

                             <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">
                                 <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">BP :</label><input type="text" name="bp" class="md-input" required=""  value="{{  old('bp','') }}"  v-model="bp"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                     <p class="uk-text-danger uk-text-small"  v-if="patientForms.bp.$error.required">BP is required</p>                                        
                                   
                                    </div>
                                </div>




                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">Temperature :</label><input type="text" name="temperature" required=""class="md-input"   value="{{  old('temperature','') }}"  v-model="temperature"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                        <p class="uk-text-danger uk-text-small"  v-if="patientForms.temperature.$error.required">temerature  is required</p>                                        
                                   
                                    </div>
                                </div>



                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_skype">Height :</label><input type="text" id="height"required=""   name="height" v-form-ctrl  class="md-input"   value="{{ old('height','') }}"  v-model="height"      /><span class="md-input-bar"></span></div>         
                                         <p  class=" uk-text-danger uk-text-small  "   v-if="patientForms.height.$error.required">weight   is required</p>                                      
                                 
                                    </div>
                                </div>
                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Weight :</label><input type="text" id="weight" required=""name="weight" class="md-input"        value="{{ old('weight','') }}"   v-model="weight"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="patientForms.weight.$error.required">weight   is required</p>                                      
                                    </div>
                                </div>



                            </div>

                             
              
                             
                              


                        </section>

      <!-- second section -->
      {{-- <h3 id="payment-heading-1" tabindex="-1" class="title">Payment</h3> --}}
      <section id="payment_section" role="tabpanel" aria-labelledby="payment section" class="body step-1 "  v-bind:class="{'uk-hidden': !in_payment_section} "  data-step="1"  aria-hidden="true">
        <h2 class="heading_a">
         
         <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">
                                 <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">BP :</label><input type="text" name="bp" class="md-input"   value="{{  old('bp','') }}"  v-model="bp"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                     <p class="uk-text-danger uk-text-small"  v-if="patientForms.bp.$error.required">BP is required</p>                                        
                                   
                                    </div>
                                </div>




                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">Temperature :</label><input type="text" name="temperature" class="md-input"   value="{{  old('temperature','') }}"  v-model="temperature"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                        <p class="uk-text-danger uk-text-small"  v-if="patientForms.temperature.$error.required">temerature  is required</p>                                        
                                   
                                    </div>
                                </div>



                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_skype">Height :</label><input type="text" id="height"  name="height" v-form-ctrl  class="md-input"   value="{{ old('height','') }}"  v-model="height"      /><span class="md-input-bar"></span></div>         
                                         <p  class=" uk-text-danger uk-text-small  "   v-if="patientForms.height.$error.required">weight   is required</p>                                      
                                 
                                    </div>
                                </div>
                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Weight :</label><input type="text" id="weight" name="weight" class="md-input"        value="{{ old('weight','') }}"   v-model="weight"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="patientForms.weight.$error.required">weight   is required</p>                                      
                                    </div>
                                </div>



                            </div>


</section>

</div>
<div class="actions clearfix "  >
    <ul aria-label="Pagination" role="menu">
        <li class="button_previous " aria-disabled="true"  v-on:click="go_to_fill_form_section()"  v-show="in_payment_section==true"  >
            <a role="menuitem" href="#previous" >
                <i class="material-icons"></i> Previous
            </a>
        </li>
        <li class="button_next button"   v-on:click="go_to_payment_section()"  aria-hidden="false" aria-disabled="false"  v-show="patientForm.$valid && in_payment_section==false"  > 
            <a role="menuitem" href="#next"  >Next 
                <i class="material-icons">
                </i>
            </a>
        </li>
        <li class="button_finish "    aria-hidden="true"  v-show="patientForm.$valid && in_payment_section==true"  >
            <input class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit_order"  value="Submit"   v-on:click="submit_form"  />
        </li>
    </ul>
</div>
</div>
</form>

            <div class="uk-modal" id="confirm_modal"   >
                <div class="uk-modal-dialog"  v-el:confirm_modal>
                    <div class="uk-modal-header uk-text-large uk-text-success uk-text-center" >Confirm Order Details?</div>
                    Are you certain of all the info
                    {{-- <div class="uk-modal-footer ">
        <center>
          <button class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit_order" > Cancel</button>
          <button class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit_order" > Ok</button>
          </center>
        </div> --}}
                </div>
            </div>
        </div>

    </div>



</div>


@endsection
@section('js')
<script src="{!! url('assets/js/select2.min.js') !!}"></script>
<script>


//code for ensuring vuejs can work with select2 select boxes
Vue.directive('select', {
  twoWay: true,
  priority: 1000,
  params: [ 'options'],
  bind: function () {
    var self = this
    $(this.el)
      .select2({
        data: this.params.options,
         width: "resolve"
      })
      .on('change', function () {
        self.vm.$set(this.name,this.value)
        Vue.set(self.vm.$data,this.name,this.value)
      })
  },
  update: function (newValue,oldValue) {
    $(this.el).val(newValue).trigger('change')
  },
  unbind: function () {
    $(this.el).off().select2('destroy')
  }
})


var vm = new Vue({
  el: "body",
  ready : function() {
  },
 data : {
  
 options: [      
    ],
    in_payment_section : false,
  },
  methods : {
    go_to_payment_section : function (event){
    UIkit.modal.confirm(vm.$els.confirm_modal.innerHTML, function(){
        
      vm.$data.in_payment_section=true
})

    },
    submit_form : function(){
      return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Saving Data<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 50000) })();
    },
        
    go_to_fill_form_section : function (event){    
      vm.$data.in_payment_section=false
    }
  }
})

</script>
@endsection