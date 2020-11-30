@extends('layouts.master')
@section('content')

<header>
    <h1 class="bg-dark text-white text-center p-4">Products</h1>
</header>

    <div class="container">
        <div class="card-lists">
            @csrf
            <div class="row" id="load_data">
              
            </div>
        </div>

        <div id="load_data_message" class="mb-3" style="width: 100%">
    
        </div>
    </div>
@endsection


@push('scripts')

<script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    $(document).ready(function(){
     var limit = 6;
     var start = 0;
     var action = 'inactive';
     function loadData(limit, start)
     {
      $.ajax({
       url:"loadmore",
       method:"POST",
       data:{limit:limit, start:start},
       cache:false,
       success:function(data)
       {
        $('#load_data').append(data);
        if(data == '')
        {
         $('#load_data_message').html("<div style='width: 100%;background:#fff;border-radius: 8px;padding:1px;margin-top: 10px;'><p style='text-align: center;font-weight: bold;'>End</p></div>'");
         action = 'active';
       }
       else
       {
         $('#load_data_message').html("<div style='width: 100%;background:#fff;border-radius: 8px;padding:1px;margin-top: 10px;'><p style='text-align: center;font-weight: bold;'>Loading</p></div>'");
         action = "inactive";
       }
  
     }
   });
    }
  
    if(action == 'inactive')
    {
      action = 'active';
      loadData(limit, start);
    }
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
       action = 'active';
       start = start + limit;
       setTimeout(function(){
        loadData(limit, start);
      }, 1000);
     }
   });
  });
  </script>

@endpush