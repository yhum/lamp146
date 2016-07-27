@extends('public.index')
@section('sort')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 分类列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
        <form method="get" action="/admin/sort/index">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label><input type="text" aria-controls="DataTables_Table_1" name="keywords" placeholder="请输入类别名称"/>
      <input type="submit" value="搜索">
      </label>
     </div>
            </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 30px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">类名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">父类</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Engine version: activate to sort column ascending">路径</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Engine version: activate to sort column ascending">图片</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($sorts as $sort)
       <tr class="odd"> 
        <td class="  sorting_1">{{ $sort->sid }}</td> 
        <td class=" ">{{ $sort->sname }}</td> 
        <td class=" ">{{ $sort->pid }}</td> 
      
        <td class=" ">{{ $sort->path }}</td> 
        <td class=" " align="center" ><img src="{{ $sort->img }}" width="60" height="20" ></td>
        
        <td class=" "> <a href="{{ url('/admin/sort/create/'.$sort->sid) }}" class="btn btn-warning btn-xs">添加子类</a> <a href="{{ url('/admin/sort/edit/'.$sort->sid) }}" class="btn btn-info">修改</a> <a href="" class="btn btn-info">删除</a></td> 
       </tr>
       @endforeach
      </tbody>
     </table>
     <div class="dataTables_info" id="DataTables_Table_1_info">
      Showing 1 to 10 of 57 entries
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {!! $sorts->appends($request)->render() !!}
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>


@endsection