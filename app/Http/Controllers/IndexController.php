<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Todo;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $items = Todo::where("title", "LIKE", "%{$request->get('search')}%")
                ->paginate(5);
        }else{
          $items = Todo::paginate(5);
        }
        return response($items);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $create = Todo::create($input);
        return response($create);
    }
    public function edit($id)
    {
        $item = Todo::find($id);
        return response($item);
    }
    public function update(Request $request,$id)
    {
        $input = $request->all();
        Todo::where("id",$id)->update($input);
        $item = Todo::find($id);
        return response($item);
    }
    public function destroy($id)
    {
        return Todo::where('id',$id)->delete();
    }
}
