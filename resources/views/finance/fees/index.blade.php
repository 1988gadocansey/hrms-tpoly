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
 
 <div class="uk-width-xLarge-1-1">
 <div class="md-card">
 <div class="md-card-content">
<h5>Proposed Fees</h5>  
  

     <div class="uk-overflow-container">
                <table class="uk-table uk-table-hover uk-table-align-vertical uk-table-nowrap" id="gad"> 
                                  <thead>
                                        <tr>
                                     <th>NO</th>
                                     <th>NAME</th>
                                     <th >AMOUNT</th>
                                     <th>STUDENT TYPE</th>
                                      <th>FEE TYPE</th> 
                                      <th>SEASON TYPE</th>
                                   
                                      <th>PROGRAMME</th>
                                      <th>LEVEL</th>
                                      <th>SEMESTER</th>
                                      <th>YEAR</th>
                                      
                                    
                                       
                                       <th>ACTION</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    
                             </table>
     </div>
 
 </div>
 </div></div>
@endsection
@section('js')
 
<script>
    
 
 var oTable = $('#gad').DataTable({
      
        processing: true,
        serverSide: true,
        ajax: {
            url:  "{!! route('view_fees.data') !!}" 
            
        },
        columns: [
            {data: 'ID', name: 'tpoly_fees.ID'},
              
                 
            {data: 'NAME', name: 'tpoly_fees.NAME'},
            {data: 'AMOUNT', name: 'tpoly_fees.AMOUNT'},
            {data: 'NATIONALITY', name: 'tpoly_fees.NATIONALITY'},
            {data: 'FEE_TYPE', name: 'tpoly_fees.FEE_TYPE'},
            {data: 'SEASON_TYPE', name: 'tpoly_fees.SEASON_TYPE'},
            {data: 'PROGRAMME', name: 'tpoly_programme.PROGRAMME'},
            {data: 'LEVEL', name: 'tpoly_fees.LEVEL'},
            {data: 'SEMESTER', name: 'tpoly_fees.SEMESTER'},
            {data: 'YEAR', name: 'tpoly_fees.YEAR'},
            
             
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
 <!--  notifications functions -->
    <script src="assets/js/components_notifications.min.js"></script>
@endsection