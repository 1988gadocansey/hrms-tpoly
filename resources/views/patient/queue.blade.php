@extends('layouts.app')

 
@section('style')
 
@endsection
 @section('content')
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
<div class="uk-width-xLarge-1-1"style="margin-right:190px ">
    <div class="md-card">
        <div class="md-card-content">

            <form action=""  method="get" accept-charset="utf-8" novalidate id="group">
                {!!  csrf_field()  !!}
                <div class="uk-grid" data-uk-grid-margin="" >





                    <div class="uk-width-medium-1-10"  >
                        <div class="uk-margin-small-top">  
                            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                                <button class="md-btn md-btn-small md-btn-success uk-margin-small-top">Export <i class="uk-icon-caret-down"></i></button>
                                <div class="uk-dropdown">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <li><a href="#" onClick ="$('#gad').tableExport({type:'csv',escape:'false'});"><img src='{!! url("assets/icons/csv.png")!!}' width="24"/> CSV</a></li>

                                        <li class="uk-nav-divider"></li>
                                        <li><a href="#" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});"><img src='{!! url("assets/icons/xls.png")!!}' width="24"/> XLS</a></li>
                                        <li><a href="#" onClick ="$('#gad').tableExport({type:'doc',escape:'false'});"><img src='{!! url("assets/icons/word.png")!!}' width="24"/> Word</a></li>
                                        <li><a href="#" onClick ="$('#gad').tableExport({type:'powerpoint',escape:'false'});"><img src='{!! url("assets/icons/ppt.png")!!}' width="24"/> PowerPoint</a></li>
                                        <li class="uk-nav-divider"></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-medium-1-10"  style="" >                            
                        <div class="uk-margin-small-top">
                            <i title="click to print" onclick="javascript:printDiv('print')" class="material-icons md-36 uk-text-success"   >print</i>

                        </div>
                    </div>



                </div>

            </form> 
        </div>
    </div>
 </div>
 <div class="md-card">
     
 <div class="md-card-content">
<h5>Consulting Room</h5>  
  

     <div class="uk-overflow-container">
         <div id="print">
           <table class="uk-table uk-table-nowrap uk-table-hover" id="gad"> 
                                  <thead>
                                        <tr>
                                     <th>NO</th>
                                     <th>FOLDER N<u>O</u></th>
                                     <th >FIRST NAME</th>
                                      <th>LASTNAME</th>
                                      <th>LAB RESULT</th>
                                      <th>DOCTOR</th>
                                      @if(Auth::user()->role=='doctor')
                                       
                                      <th>ACTION</th>
                                         @endif  
                                        </tr>
                                    </thead>
                                    
                             </table>
         </div>
     </div>
   @if(Auth::user()->role=='records')
<div class="md-fab-wrapper">
    <a href='{!! url("old_visit") !!}' title="click to add more visit" class="md-fab md-fab-small md-fab-accent md-fab-wave"  >
            <i class="material-icons md-18">&#xE145;</i>
        </a>
    </div>
  @endif
 </div>
 </div>
@endsection
@section('js')
  
<script>
    
 
 var oTable = $('#gad').DataTable({
     
        dom: 'C<"clear">lfrtip',
        buttons: [
                'csv', 'excel', 'pdf', 'print', 'reset', 'reload'
            ],
        processing: true,
        serverSide: true,
        ajax: {
            url:  "{!! route('patient_queue.data') !!}",
            
        },
          columns: [
              {data: 'id', name: 'ID'},
              {data: 'PATIENT', name: 'PATIENT'},
            {data: 'firstname', name: 'firstname'}, 
            {data: 'surname', name: 'surname'}, 
            
             {data: 'LAB_RESULT', name: 'LAB_RESULT'},
             {data: 'FOR_DOCTOR', name: 'FOR_DOCTOR'},
             {data: 'action', name: 'action', orderable: false, searchable: false}
            
                     
                ]
    });
     
     
    
</script>
 

    
 
@endsection