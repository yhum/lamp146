@extends('public.index')
@section('add')
       <div class="mws-panel grid_8">
            <a href='javascript:history.back();'><font color='red'>>>>返回</font></a>
          <div class="mws-panel-header">
               <span>用户添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="{{ url('/admin/user/insert') }}" method="post" class="mws-form">
                  <!--   @if(session('error'))
                    <div class="mws-form-message error">
                  {{session('error')}}
                      
                    </div>
                    @endif -->
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
                                   <input value="" type="text" class="small" name="username">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">确认密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="repassword" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input value="" type="text" name="email" class="small">
                              </div>
                         </div>
                        <div class="mws-form-row">
                              <label class="mws-form-label">权限:</label>
                              <div class="mws-form-item">
                                  <select name="group_id">
                                      @foreach($data as $key)
                                      <option value="{{ $key->id }}">{{ $key->title }}</option>
                                      @endforeach
                                  </select>
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                        {{csrf_field()}}
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection