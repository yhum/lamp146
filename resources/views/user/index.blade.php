@extends('public.index')
@section('index')
<script src="/b/js/libs/jquery-1.8.3.min.js"></script>
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 用户列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
        <form action="{{ url('/admin/user/index') }}" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label><input type="text" aria-controls="DataTables_Table_1" name="keywords"  placeholder='请输入用户名' />
          <input type="submit" value="搜索">
      </label>
     </div>
            </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">用户名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 200px;" aria-label="Platform(s): activate to sort column ascending">邮箱</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-label="Engine version: activate to sort column ascending">状态</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-label="Engine version: activate to sort column ascending">权限</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      	@foreach($data as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{ $row->id}}</td> 
        <td class=" ">{{ $row->username }}</td> 
        <td class=" ">{{ $row->email }}</td> 
        @if($row->status =='1')
        <td class=" ">启用</td> 
        @elseif($row->status =='0')
        <td class=" "><font color='red'>禁用</font></td> 
        @endif
        <td>
            <select name="groupid" uid='{{ $row->id }}'>
            @foreach($groups as $group)
            @if($row->group_id == $group->id)
            <option value="{{ $group->id }}" selected>{{ $group->title }}</option>
            @else
             <option value="{{ $group->id }}">{{ $group->title }}</option>
            @endif
            
            @endforeach
            </select>
        </td>

        <td class=" "><a href="{{ url('/admin/user/edit/'.$row->id) }}" class="btn btn-success">修改</a> <a href="{{ url('/admin/user/delete/'.$row->id) }}" class="btn btn-info">删除</a></td> 
       
       </tr>
       	@endforeach
      </tbody>
     </table>
     <div class="dataTables_info" id="DataTables_Table_1_info">
      Showing 1 to 10 of 57 entries
     </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {!!$data->appends($request)->render() !!}
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
<script src='{{ asset('/js/user/index_update.js') }}'></script>

@endsection
