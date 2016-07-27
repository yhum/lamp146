<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        //
//        dd($request->get('keywords'));
//        return "1";
        $sorts=DB::table('sort')->where('sname','like','%'.$request->get('keywords').'%')->orderByRaw("CONCAT_WS(',', path, sid)")->paginate(8);
//        dd($sorts);
        foreach($sorts as $key=>$value){
         $sorts[$key]->sname = str_repeat('--|',substr_count($value->path,',')).$value->sname;   
        }
        return view('admin.sort.index',['sorts'=>$sorts,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate($id=null)
    {
        //
//        return "1";
        if(!empty($id)){
          $data=DB::table('sort')->where('sid',$id)->first();
//          dd($data);
        }
        return view('admin.sort.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        //
        $this->validate($request,[
            'sname'=>'required',
        ],[
            'sname.required'=>'分类名称不能为空',
        ]);
        $data = $request->except('_token','upload');
//        dd($data);
       if(false !== $insertId = DB::table('sort')->insertGetId($data)){
           return redirect('/admin/sort')->with('success','添加成功');
       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
      $data=DB::table('sort')->where('sid',$id)->first();
//      dd($data);
      return view('admin.sort.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        //
//       dd($request->all());
        $data=$request->only('sname','img');
//        dd($data);
//        dd($request->get('sid'));
        if(false !== DB::table('sort')->where('sid',$request->get('sid'))->update($data)){
            return redirect('/admin/sort')->with('success','修改成功');
        }else{
            return back()->with('info','修改失败');
        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //文件上传
    public function postUpload(Request $request){
//         return response()->json(['status'=>0,'info'=>"上传失败"]);
        //获取文件
        $file=$request->file('Filedata');
        $name=$file->getClientOriginalExtension();
        $rename=date('YmdHis').rand(1000,9999).'.'.$name;
        $result=$file->move('./uploads/sort/create',$rename);
        if($result){
            return response()->json(['status'=>'1','info'=>"/uploads/sort/create/{$rename}"]);
        }else{
            return response()->json(['status'=>'0','info'=>'上传失败']);
        }
    }
}
