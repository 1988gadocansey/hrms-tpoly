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
<h5>Patients Register</h5>  
  

     <div class="uk-overflow-container">
         <div id="print">
                <table class="uk-table uk-table-nowrap uk-table-hover" id="gad"> 
                                  <thead>
                                        <tr>
                                     <th>NO</th>
                                     <th>FOLDER N<u>O</u></th>
                                     <th >TITLE</th>
                                      <th>FIRST NAME</th> 
                                      <th>OTHER NAMES</th>
                                      <th>LAST NAME</th>
                                      <th>DOB</th>
                                   
                                      <th>AGE</th>
                                      <th>GENDER</th>
                                      <th>CS NO</th>
                                      <th>NHIS</th>
                                      <th>EXPIRED BY</th>
                                     
                                      <th>LAST VISIT</th>
                                      <th>ACTION</th>
                                           
                                        </tr>
                                    </thead>
                                    
                             </table>
         </div>
     </div>
<div class="md-fab-wrapper">
    <a href='{!! url("new_visit") !!}' title="click to add more patients" class="md-fab md-fab-small md-fab-accent md-fab-wave"  >
            <i class="material-icons md-18">&#xE145;</i>
        </a>
    </div>
 </div>
 </div>
@endsection
@section('js')
 <script src="{!! url('assets/js/select2.min.js') !!}"></script>
<script>
    
 
 var oTable = $('#gad').DataTable({
     
        dom: 'C<"clear">lfrtip',
        buttons: [
                'csv', 'excel', 'pdf', 'print', 'reset', 'reload'
            ],
        processing: true,
        serverSide: true,
        ajax: {
            url:  "{!! route('patients.data') !!}",
            
        },
          columns: [
              {data: 'id', name: 'id'},
            {data: 'hospital_id', name: 'hospital_id'}, 
            {data: 'title', name: 'title'},
             {data: 'firstname', name: 'firstname'},
              {data: 'othername', name: 'othername'},
            {data: 'surname', name: 'surname'},
            {data: 'date_of_birth', name: 'date_of_birth'},
              {data: 'age', name: 'age'},
               {data: 'sex', name: 'sex'},
                {data: 'cs_number', name: 'cs_number'},
                 {data: 'nhis_id', name: 'nhis_id'},
                 {data: 'date', name: 'date'},
                   {data: 'date', name: 'date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
    });
     $(document).ready(function(){
// console.log($('select[name="status"]'));
$(".jump").on('change',function(e){
 
  $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
 
});
});

    
</script>
@endsection