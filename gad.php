@extends('layouts.app')


@section('style')

@endsection
@section('content')

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

<h5>Initiate a Visit Form</h5>  



<div class="uk-width-xLarge-1-1">
    <div class="md-card">
        <div class="md-card-content">


            <form  novalidate id="wizard_advanced_form" class="uk-form-stacked"   action="" method="post" accept-charset="utf-8"  name="employeeForm" enctype="multipart/form-data" v-form>

                {!!  csrf_field() !!}
                <div data-uk-observe="" id="wizard_advanced" role="application" class="wizard clearfix">
                    <div class="steps clearfix">
                        <ul role="tablist">
                            <li role="tab" class="fill_form_header first current" aria-disabled="false" aria-selected="true" v-bind:class="{ 'error' : !in_payment_section}">
                                <a aria-controls="wizard_advanced-p-0" href="#wizard_advanced-h-0" id="wizard_advanced-t-0">
                                    <span class="current-info audible">current step: </span><span class="number">I</span> <span class="title">Records</span>
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

                          <section id="fill_form_section" role="tabpanel" aria-labelledby="fill form section" class="body step-0 current" data-step="0" aria-hidden="false"   v-bind:class="{'uk-hidden': in_payment_section} ">

                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">First Name :</label><input type="text" id="fname" name="fname" class="md-input"   required="required"    value="{{ old('fname','') }}"   v-model="fname"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.fname.$error.required">Please enter your first name</p>                                      
                                    </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Last Name :</label><input type="text" id="surname" name="surname" class="md-input"   required="required"    value="{{ old('surname','') }}"   v-model="surname"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.surname.$error.required">Please enter your surname</p>                                      
                                    </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_skype">Other Names :</label><input type="text" id="oname" name="othernames" v-form-ctrl  class="md-input"   value="{{ old('othernames','') }}"  v-model="othernames"      /><span class="md-input-bar"></span></div>         

                                    </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <label for="">Title :</label>     
                                        <div class="md-input-wrapper md-input-filled">
                                            {!!   Form::select('title',array("Mr"=>"Mr",'Mrs'=>"Mrs",'Miss'=>'Miss'),old('title',''),array('placeholder'=>'Select title',"required"=>"required","class"=>"md-input","v-model"=>"title","v-form-ctrl"=>"","v-select"=>"title"))  !!}
                                            <span class="md-input-bar"></span>
                                        </div>    
                                        <p class="uk-text-danger uk-text-small"  v-if="employeeForm.title.$error.required">Title is required</p>                                        
                                    </div>
                                </div>

                            </div>



                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <label for="">Gender :</label>     
                                        <div class="md-input-wrapper md-input-filled">
                                            {!!   Form::select('gender',array("Male"=>"Male",'Female'=>"Female"),old('gender',''),array('placeholder'=>'Select gender',"required"=>"required","class"=>"md-input","v-model"=>"gender","v-form-ctrl"=>"","v-select"=>"gender"))  !!}
                                            <span class="md-input-bar"></span>
                                        </div>    
                                        <p class="uk-text-danger uk-text-small"  v-if="employeeForm.gender.$error.required">Gender is required</p>                                        
                                    </div>
                                </div>
                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <label for="">Marital Status :</label>     
                                        <div class="md-input-wrapper md-input-filled">
                                            {!!   Form::select('marital_status',array("Married"=>"Married",'Single'=>"Single"),old('marital_status',''),array('placeholder'=>'Select marital status',"required"=>"required","class"=>"md-input","v-model"=>"marital_status","v-form-ctrl"=>"","v-select"=>"marital_status"))  !!}
                                            <span class="md-input-bar"></span>
                                        </div>    
                                        <p class="uk-text-danger uk-text-small"  v-if="employeeForm.marital_status.$error.required">Marital Status is required</p>                                        
                                    </div>
                                </div>
                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Phone N<u>o</u> :</label><input type="text" id="tel" name="phone" class="md-input" data-parsley-type="digits" minlength="10"  required="required"   maxlength="10" value="{{ old('tel','') }}"  pattern='^[0-9]{10}$'  v-model="tel"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.tel.$invalid">Please enter a valid phone number of 10 digits</p>                                      
                                    </div>
                                </div>



                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">Date of Birth :</label><input type="text" name="dob" class="md-input" data-uk-datepicker="{format:'DD/MM/YYYY'}" required="required" value="{{  old('dob','') }}"  v-model="dob"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                        <p class="uk-text-danger uk-text-small " v-if="employeeForm.dob.$error.required" >Date of birth is required</p>                                           
                                    </div>
                                </div>

                            </div>

                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">
                                 <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">NHIS N<u>0</u> :</label><input type="text" name="nhis" class="md-input"   value="{{  old('nhis','') }}"  v-model="nhis"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                             </div>
                                </div>




                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">CS N<u>0</u> :</label><input type="text" name="csno" class="md-input"   value="{{  old('csno','') }}"  v-model="csno"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                             </div>
                                </div>



                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_skype">Occupation :</label><input type="text" id="occupation" name="occupation" v-form-ctrl  class="md-input"   value="{{ old('occupation','') }}"  v-model="occupation"      /><span class="md-input-bar"></span></div>         

                                    </div>
                                </div>
                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Contact Address :</label><input type="text" id="contact" name="contact" class="md-input"   required="required"    value="{{ old('contact','') }}"   v-model="contact"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.contact.$error.required">Contact Address is required</p>                                      
                                    </div>
                                </div>



                            </div>

                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Hometown :</label><input type="text" id="hometown" name="hometown" class="md-input"   required="required"    value="{{ old('hometown','') }}"   v-model="hometown"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.hometown.$error.required">Hometown is required</p>                                      
                                    </div>
                                </div>

                               <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">Last Visit :</label><input type="text" name="lastVisit" class="md-input" data-uk-datepicker="{format:'DD/MM/YYYY'}" required="required" value="{{  old('lastVisit','') }}"  v-model="lastVisit"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                     </div>
                                </div>


                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled">
                                            <label for="wizard_referer">Referer Clinic/Hospital :</label>
                                            <input type="text" id="referer" name="referer" class="md-input"  value="{{ old('referer','') }}"  v-model="referer"v-form-ctrl  ><span class="md-input-bar"></span></div>                                            
                                        
                                    </div>
                                </div>

                                


                            </div>


                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">


                               <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <label for="">Patient Type :</label>     
                                        <div class="md-input-wrapper md-input-filled">
                                            {!!   Form::select('type',array("staff"=>"staff",'student'=>"student"),old('type',''),array('placeholder'=>'Select patient type',"class"=>"md-input","v-model"=>"type","v-form-ctrl"=>"","v-select"=>"type"))  !!}
                                            <span class="md-input-bar"></span>
                                        </div>    
                                        
                                    </div>
                                </div>
                                <div class="parsley-row" v-if ="type=='student'">
                                    <div class="uk-input-group">

                                        <label for="">Student :</label>     
                                        <div class="md-input-wrapper md-input-filled">
                                          {!!   Form::select('student',$student,old('student',''),array("required"=>"required","class"=>"md-input","id"=>"student","v-model"=>"student","v-form-ctrl"=>"","style"=>"width: 226px;","v-select"=>"student")   )  !!}
                                    <span class="md-input-bar"></span>
                                        </div> 

                                      <p class="uk-text-danger uk-text-small"  v-if="employeeForm.student.$error.required">student is required</p>                                        
                                  </div>
                              </div>
                                <div class="parsley-row" v-if ="type=='staff'">
                                    <div class="uk-input-group">

                                        <label for="">Staff :</label>     
                                        <div class="md-input-wrapper md-input-filled">
                                          {!!   Form::select('staff',$staff,old('staff',''),array("required"=>"required","class"=>"md-input","id"=>"staff","v-model"=>"staff","v-form-ctrl"=>"","style"=>"width: 226px;","v-select"=>"staff")   )  !!}
                                    <span class="md-input-bar"></span>
                                        </div> 

                                      <p class="uk-text-danger uk-text-small"  v-if="employeeForm.staff.$error.required">staff is required</p>                                        
                                  </div>
                              </div>
                            </div>
                           
                        </section>

                        <!-- second section -->
                        {{-- <h3 id="payment-heading-1" tabindex="-1" class="title">Payment</h3> --}}
                        <section id="payment_section" role="tabpanel" aria-labelledby="payment section" class="body step-1 "  v-bind:class="{'uk-hidden': !in_payment_section} "  data-step="1"  aria-hidden="true">

                              <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">
                                 <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">BP :</label><input type="text" name="bp" class="md-input"   value="{{  old('bp','') }}"  v-model="bp"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                     <p class="uk-text-danger uk-text-small"  v-if="employeeForm.bp.$error.required">BP is required</p>                                        
                                   
                                    </div>
                                </div>




                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_twitter">Temperature :</label><input type="text" name="temperature" class="md-input"   value="{{  old('temperature','') }}"  v-model="temperature"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                        <p class="uk-text-danger uk-text-small"  v-if="employeeForm.temperature.$error.required">temerature  is required</p>                                        
                                   
                                    </div>
                                </div>



                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_skype">Height :</label><input type="text" id="occupation" name="height" v-form-ctrl  class="md-input"   value="{{ old('height','') }}"  v-model="height"      /><span class="md-input-bar"></span></div>         
                                         <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.height.$error.required">weight   is required</p>                                      
                                 
                                    </div>
                                </div>
                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_referer">Weight :</label><input type="text" id="weight" name="weight" class="md-input"   required="required"    value="{{ old('weight','') }}"   v-model="weight"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="employeeForm.weight.$error.required">weight   is required</p>                                      
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
                            <li class="button_next button"   v-on:click="go_to_payment_section()"  aria-hidden="false" aria-disabled="false"  v-show="employeeForm.$valid && in_payment_section==false"  > 
                                <a role="menuitem" href="#next"  >Next 
                                    <i class="material-icons">
                                    </i>
                                </a>
                            </li>
                            <li class="button_finish "    aria-hidden="true"  v-show="employeeForm.$valid && in_payment_section==true"  >
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
  department : "{{  old("department",'') }}",
  position : "{{  old("position",'') }}",
  grade : "{{  old("grade",'') }}",
  title : "{{  old("title",'') }}",
  marital: "{{  old("marital",'') }}",
  student : "{{  old("student",'') }}",
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
      return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Saving Data<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 50000) })();
    },
        
    go_to_fill_form_section : function (event){    
      vm.$data.in_payment_section=false
    }
  }
})

</script>
@endsection