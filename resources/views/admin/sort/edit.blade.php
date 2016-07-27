@extends('public.index')
@section('sort_edit')
<script src="/b/js/libs/jquery-1.8.3.min.js"></script>
  <div class="mws-panel grid_8">
      <a href='javascript:history.back();'><font color='red'>>>>返回</font></a>
      
          <div class="mws-panel-header">
               <span>分类修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="{{ url('/admin/sort/update') }}" method="post" class="mws-form" name='fm'>
                    @if(session('info'))
                    <div class="mws-form-message error">
                  {{session('info')}}
                    </div>
                    @endif 
                    <!-- 显示验证错误 -->
                    @if (count($errors) > 0)
                    <div class="mws-form-message error">

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                    @endif

                    <div class="mws-form-inline">
                        
                         <div class="mws-form-row">
                              <label class="mws-form-label">分类名称:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="sname" class="small" value='{{ $data->sname }}'>
                              </div>
                         </div>
                        <div class="mws-form-row">
                              <label class="mws-form-label">图片:</label>
                               <div class="mws-form-item">
                                  <p><div id='pre'><img src='{{ $data->img }}' width=150 ></div></p>
                                  <input type="file" name="upload" id='upload' >
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <input type="hidden" name="img" id="img" value="{{ $data->img }}">
                          <input type="hidden" name="sid" value="{{ $data->sid }}">
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
<script src='/js/sort/sort_create.js'></script>
@endsection
