<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
   public function getCreate(){
       $data=DB::table('sort')->orderByRaw("CONCAT_WS(',',path,sid)")->get();
   }
}
