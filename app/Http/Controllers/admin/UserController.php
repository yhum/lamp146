<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB,Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //用户模板
   public function getAdd(){
//       echo "1";
       $data=DB::table('rule')->orderBy('id','desc')->get();
//       dd($data);
       return view('user.add',['data'=>$data]);
   }
   
   
   //添加用户
   public function postInsert(Request $request){
//       echo "1";
//       dd($request->all());
       $this->validate($request,[
           'username'=>'required',
           'password'=>'required',
           'repassword'=>'required|same:password',
           'email'=>'required|email'
       ],[
           'username.required'=>'账号不能为空',
           'password.required'=>'密码不能为空',
           'repassword.required'=>'确认密码不能为空',
           'repassword.same'=>'两次密码输入不一致',
           'email.required'=>'邮箱不能为空',
           'email.email'=>'邮箱格式不正确',
       ]);
       $data=$request->except('_token','repassword','group_id');
       $data['status']=1;
       $data['token']=str_random(50);
     
       $data['password']=Hash::make($data['password']);
//       dd($data);
       if(false !== $insertId=DB::table('user')->insertGetId($data)){
           DB::table('group')->insert(['id'=>$insertId,'group_id'=>$request->get('group_id')]);
           return redirect('/admin/user/index')->with('success','添加成功');
       }else{
           return redirect('/admin/user/index')->with('error','添加失败');
       }
   }
   
   //用户首页列表
   public function getIndex(Request $request){
       $data=DB::table('user')->LeftJoin('group','user.id','=','group.id')->where('user.username','like','%'.$request->input('keywords').'%')->orderBy('user.id','desc')->paginate(5);
//       dd($data);
       $groups=DB::table('rule')->get();
//       dd($groups);
       return view('user.index',['data'=>$data,'request'=>$request->all(),'groups'=>$groups]);
   }
   //修改用户模板
   public function getEdit($id){
//       echo $id;die;
       $data=DB::table('user')->leftJoin('group','user.id','=','group.id')->where('user.id',$id)->first();
//       dd($data);
       $group=DB::table('rule')->get();
       return view('user.edit',['data'=>$data,'group'=>$group]);
   }
   //修改用户
   public function postUpdate(Request $request){
//       dd($request->all());
       $this->validate($request,[
           'username'=>'required',
           'email'=>'required|email',
       ],[
           'username.required'=>'账号不能为空',
           'email.required'=>'邮箱不能为空',
           'email.email'=>'邮箱格式不正确',
       ]);
       $data=$request->except('_token','id','groupid');
        if($data['password']==''){
            unset($data['password']);
        }else{
            $data['password']=Hash::make($data['password']);
        }
//       dd($request->get('id'));
//        dd($data);
       if(DB::table('user')->where('id',$request->get('id'))->update($data)){
           DB::table('group')->where('id',$request->get('id'))->update(['group_id'=>$request->get('groupid')]);
           return redirect('/admin/user/index')->with('success','修改成功');
       }else{
           return back()->with('info','修改失败');
       }
   }
   public function getDelete($id){
//       echo $id;
       if(DB::table('user')->where('id',$id)->delete()){
           DB::table('group')->where('id',$id)->delete();
           return redirect('/admin/user/index')->with('success','删除成功');
       }
   }
   public function getGroup($uid,$id){
//       return response()->json(['info'=>$id]);
       if(false !== DB::table('group')->where('id',$uid)->update(['group_id'=>$id])){
           return response()->json(['ststua'=>1,'info'=>'修改成功']);
       }else{
           return response()->json(['ststua'=>0,'info'=>'修改失败']);
       }
   }
}
