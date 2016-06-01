@extends('layouts.master')

</style>
@section('style')
 
@endsection
 
 <h5>Students</h5>  
  
 
 <div class="md-card-content">


     <div class="uk-overflow-container">
                <table class="uk-table uk-table-nowrap uk-table-hover" id="gad"> 
                                  <thead>
                                        <tr>
                                     <th>NO</th>
                                     <th>Photo</th>
                                     <th >INDEX</th>
                                      <th>NAME</th> 
                                      <th>PROGRAM</th>
                                   
                                      <th>LEVEL</th>
                                      <th>GENDER</th>
                                      <th>AGE</th>
                                      <th>PHONE</th>
                                     
                                      <th>NATIONALITY</th>
                                      <th>YEAR GROUP</th>
                                      <th>STATUS</th>
                                       
                                       <th>ACTION</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    
                             </table>
     </div>
 </div>
@endsection
@section('js')
 
<script>
    
 
 var oTable = $('#gad').DataTable({
     
        dom: 'C<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "http://localhost/srms-laravel/public/swf/flashExport.swf"
        },
        processing: true,
        serverSide: true,
        ajax: {
            url:  "{!! route('students.data') !!}",
            data: function (d) {
                d.level = $('select[name=level]').val();
                d.gender = $('select[name=gender]').val();
            }
        },
        columns: [
            {data: 'ID', name: 'tpoly_students.ID'},
            {data: 'Photo', name: 'Photo', orderable: false, searchable: false},
            
            {data: 'INDEXNO', name: 'tpoly_students.INDEXNO'},
            {data: 'NAME', name: 'tpoly_students.NAME'},
            {data: 'PROGRAMME', name: 'tpoly_programme.PROGRAMME'},
            {data: 'LEVEL', name: 'tpoly_students.LEVEL'},
            {data: 'SEX', name: 'tpoly_students.SEX'},
            {data: 'AGE', name: 'tpoly_students.AGE'},
            {data: 'TELEPHONENO', name: 'tpoly_students.TELEPHONENO'},
           
            {data: 'COUNTRY', name: 'tpoly_students.COUNTRY'},
            {data: 'GRADUATING_GROUP', name: 'tpoly_students.GRADUATING_GROUP'},
            {data: 'STATUS', name: 'tpoly_students.STATUS'},
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