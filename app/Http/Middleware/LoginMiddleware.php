<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->Session()->has('id')){
            //查找一下所有启用的权限列表  判断当前的操作是否需要权限验证
            $result=DB::table('rules')->where('status',1)->get();
//            var_dump($result);
            $rules=array();
            foreach($result as $val){
              $rules[$val->name]=$val->title;
//                var_dump($key);
            }
//            var_dump($result);
//             var_dump($rules);
             
//            echo $_SERVER['REQUEST_URI'];
             $subject = preg_replace("/\?.+$/","",$_SERVER['REQUEST_URI']);
             $subject = preg_replace("/\/\d+/","",$subject);
//             echo $subject;
             if(array_key_exists($subject,$rules)){
//                 echo $subject;
                 $groupid=DB::table('user')->Leftjoin('group','user.id','=','group.id')->
                         where('user.id','5')->pluck('group.group_id');
//                 echo $groupid;
//                 echo "1";
                 $list=DB::table('rule')->where('id',$groupid)->pluck('rules');
//                 var_dump($list);   ////字符串 1,2,3,4,5
                 //当前操作的权限
                 $rule=DB::table('rules')->where('name',$subject)->pluck('id');
//                 echo $rule;
                 if(!in_array($rule,explode(',',$list))){
                   if(in_array($subject,["/admin/user/group"])){
                       return response()->json(['status'=>0,'info'=>'你没有'.$rules[$subject].'权限']);
                   } else{
                          return back()->with('rule','你没有'.$rules[$subject].'权限');
                   }
                   
                 }
             }
        return $next($request);
        }else{
            return "登录";
        }
    }
}
