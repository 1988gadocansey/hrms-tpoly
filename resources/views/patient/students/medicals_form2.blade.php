@extends('layouts.app')

 
   
@section('style')
        
 
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
                             <td><a href=" "><img class="" style="width:480px;height:162px;"  <?php
                                     $pic = "0".$data[0]->INDEXNO;
                                     echo $sys->picture("{!! url(\"albums/students/$pic.JPG\") !!}", 90)
                                     ?>   src='{{url("albums/students/$pic.JPG")}}' alt=" Picture of Student Here"    /></a></td> 

                         <p align="center">&nbsp;</p></td>
                         </tr>


                     </table>
                        
                </div>
    
             
          <div class="uk-width-xLarge-1-1">
                <div class="md-card">
                    <div class="md-card-content">
                    <div style=" " id="payment_div">

          <form method="post" action="{{ url('store_medicals') }}" name="new_payment_individual_form" id="new_payment_individual_form" class="form-horizontal">
<input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
              
                        <input type="hidden" name="patient" id="patient" value="{{ $data[0]->INDEXNO}}" />
                                            
  <table id="paymentTable" class="uk-table"border="0" style="font-weight:bold">
	  <tr id="paymentRow" payment_row="payment_row"><td valign="top"><strong>Tests</strong></td>
	  <td>
	  {!! Form::select('test[]', 
                                (['' => 'select test'] +$test ), 
                                  old("test",""),
                                    ['class' => 'md-input parent'] )  !!}
	 
	  </td>
	  <td valign="top">Source &nbsp;<input type="text"    class="md-input md-input"  name="source[]" style="width:auto;"></td>

    
          <td valign="top">Specimen &nbsp;<input type="text"   class="md-input md-input"  name="specimen[]" style="width:auto;"></td>

          <td valign="top">Diagnosis &nbsp;<input type="text"   class="md-input md-input" required="" v-model='diagnosis' v-form-ctrl=''  name="diagnosis[]" style="width:auto;"></td>

          
          <td valign="top">Result &nbsp;<input type="text"    class="md-input md-input" required="" v-model='result[]' v-form-ctrl=''  name="result[]" style="width:auto;"></td>

          
	  <td valign="top" id="insertPaymentCell"><button  type="button" id="insertPaymentRow" class="md-btn md-btn-primary md-btn-small " ><i class="sidebar-menu-icon material-icons">add</i>Test</button></td></tr>
	   
      </table>
      <table align="center">
       
        <tr><td><input type="submit" value="Save" id='save'  class="md-btn   md-btn-success uk-margin-small-top">
      <input type="reset" value="Cancel" class="md-btn   md-btn-default uk-margin-small-top">
    </td></tr></table>

          </form>



</div>
                                    
                        
                    </div>
                </div>
          </div>
             </div>
                  
             </div>
              
 </div>
 </div>
  
 @endsection
 
@section('js')
  
        <script src="{!! url('assets/js/jquery.form.js') !!}"> </script>
        <script src="{!! url('assets/js/jquery.validate.min.js') !!}"> </script>
         
          <script>
 

$(document).ready(function(){
 
function checkFormElements(){}
 


$("#insertPaymentRow").bind('click',function(){

    var numOrgs=$(" table#paymentTable tr[payment_row]").length+1;
	  var newOrg=$("table#paymentTable tr:first ").clone(true);

   $(newOrg).children(' td#insertPaymentCell ').html('<button  type="button" id="removePaymentRow_'+numOrgs+'" class="md-btn md-btn-danger md-btn-small uk-margin-small-top" ><i class="sidebar-menu-icon material-icons">remove</i>  Remove</button>');

    var amountLine=$(newOrg).children('td')[2];
    $(amountLine).children(':last-child').prop('value','');

  var amountInput=$(amountLine).children(':last-child');

  $(amountInput).prop('id','amt_'+numOrgs);

    $(newOrg).attr('id','paymentRow_'+numOrgs);

    $(newOrg).insertAfter($("table#paymentTable tr:last"));

   $('#removePaymentRow_'+numOrgs).bind("click",function(){
   // $(amountInput).trigger('keyup');
    $('#paymentRow_'+numOrgs).remove();
    var count=0; 
  });

  // $('#amt_'+numOrgs).bind('focus',function(){
  //   console.log('hello from here');
  // });

//});


  $('#paymentTable .pay_type  :selected').parent().each(function(){
    if($(this).prop('selectedIndex') <= 0){
      //$('#new_payment_individual_form :submit').prop('disabled','disabled');
    //  $('#alertInfo').css('display','block').html("Please select a payment type!");
     }
   });
//console.log($(this).prop('name')+"->"+$('#paymentTable .pay_type  :selected').parent().length);

});



$('#save').on('click', function(e) {
       return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Processing data<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 50000) })();

   
});    

});
</script>
@endsection