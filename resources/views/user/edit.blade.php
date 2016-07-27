@extends('public.index')
@section('edit')

  <div class="mws-panel grid_8">
      <a href='javascript:history.back();'><font color='red'>>>>返回</font></a>
      
          <div class="mws-panel-header">
               <span>用户修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="{{ url('/admin/user/update') }}" method="post" class="mws-form">
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
                              <label class="mws-form-label">用户名:</label>
                              <div class="mws-form-item">
                                   <input value="{{ $data->username }}" type="text" class="small" name="username">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" class="small" placeholder='空则不修改'>
                              </div>
                         </div>
                        <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                               
                                  <input type="radio" name="status" value='1' @if($data->status=='1') checked @endif>启用、
                                
                                  <input type="radio" name="status"  value='0'@if($data->status=='0') checked @endif><font color='red'>禁用</font>
                                
                                    
                                  
                              </div>
                         </div>
                     
                       
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input value="{{ $data->email }}" type="text" name="email" class="small">
                              </div>
                         </div>
                        
                           <div class="mws-form-row">
                              <label class="mws-form-label">权限:</label>
                              <div class="mws-form-item">
                                  <select name="groupid">
                                      @foreach($group as $val)
                                      @if($data->group_id == $val->id)
                                      <option value="{{ $val->id }}" selected>{{ $val->title }}</option>
                                      @else
                                      <option value="{{ $val->id }}" >{{ $val->title }}</option>
                                      @endif
                                      
                                      @endforeach
                                  </select>
                              </div>
                         </div>
                        
                        
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                        <input type='hidden' name='id' value='{{ $data->id }}'>
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>

@endsection