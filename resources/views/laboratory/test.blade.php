@extends('layouts.app')

 
@section('style')
 
@endsection
 @section('content')
   <div class="md-card-content">
@if(Session::has('success'))
            <div style="text-align: center" class="uk-alert uk-alert-success" data-uk-alert="">
                {!! Session::get('success') !!}
            </div>
 @endif
 
     @if (count($errors) > 0)

    <div class="uk-form-row">
        <div class="uk-alert uk-alert-danger" style="background-color: red;color: white">

              <ul>
                @foreach ($errors->all() as $error)
                  <li> {{  $error  }} </li>
                @endforeach
          </ul>
    </div>
  </div>
@endif
  </div>
 <div class="uk-width-large-8-10">
 <div class="md-card">
 <div class="md-card-content" style="">
 <div class="uk-modal" id="new_task">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h4 class="uk-modal-title">Create Banks for Fee Payment here</h4>
            </div>
                        <form action="create_bank" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
                    <div id="inn">
                    <div id="clonedInput1" class="clonedInput">
                  
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <label>Bank Name</label>
                                        <input type="text" class="md-input md-input-success" required="" name="bank[]"/>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <label>Account Number</label>
                                        <input type="text" class="md-input md-input-success" required="" name="account[]"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row" style="margin-top:25px">
                                 
                                   <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <button class="md-btn md-btn-primary md-btn-small clone"  >Add More</button>
                                    </div>
                                   

                                        <button   class="md-btn md-btn-danger md-btn-small remove"  >Remove</button>

                                    </div>
                                 
                            </div>

                        </div>
                    </div>
                    </div>
                    </div>
                    
                <div class="uk-modal-footer uk-text-right">
                    <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary md-btn-wave" id="snippet_new_save">Add Bank</button>    
                    <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-wave">Close</button>
                </div>
            </form>
        </div>
    </div>

 
<h5>Laboratory Tests</h5>  
  

     <div class="uk-overflow-container">
         <table class="uk-table uk-table-hover uk-table-align-vertical uk-table-nowrap " id="gad"> 
             <thead>
               <tr>
                <th>N<u>O</u></th>
                <th>NAME</th>
                <th>CATEGORY</u></th>
                <th>PRICE</th>
                <th>ACTION</th>
                </tr>
             </thead>

         </table>
     </div>
<div class="md-fab-wrapper">
        <a class="md-fab md-fab-small md-fab-accent md-fab-wave" href="#new_task" data-uk-modal="{ center:true }">
            <i class="material-icons md-18">&#xE145;</i>
        </a>
    </div>
 </div>
 </div>
 </div>
 
@endsection
@section('js')
 
<script>
    
 
 var oTable = $('#gad').DataTable({
     
        
        processing: true,
        serverSide: true,
        ajax: {
            url:  "{!! route('tests.data') !!}"
             
        },
        columns: [
        {data: 'ID', name: 'ID'},
            
            {data: 'NAME', name: 'NAME'},
            {data: 'CATEGORY', name: 'CATEGORY'},
            {data: 'PRICE', name: 'PRICE'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    

    
</script>
 
@endsection