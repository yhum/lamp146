<script src="/js/jquery-1.8.3.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<button>ajax</button>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
   $('button').click(function () 
   {
      $.post('/post',{"12":"11"},function (data){
          alert(data);
      });
   });
</script>