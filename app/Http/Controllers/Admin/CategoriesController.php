<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Validator, Str;

use App\Http\Models\Category;

class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($module){
        $cats = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['cats' => $cats];
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $messages = [
            'name.required' => 'Es requerido un nombre para la categoría.',
            'icon.required' => 'Es requerido un ícono para la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'se ha producido un error')
            ->with('typealert', 'danger');
        else:
            $c = new Category;
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if ($c->save()):
                return back()
                ->with('message', 'Datos almacenados exitosamente')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryEdit($id){
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $messages = [
            'name.required' => 'Es requerido un nombre para la categoría.',
            'icon.required' => 'Es requerido un ícono para la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'se ha producido un error')
            ->with('typealert', 'danger');
        else:
            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if ($c->save()):
                return back()
                ->with('message', 'Datos editados exitosamente')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryDelete($id){
        $c = Category::find($id);
        if ($c->delete()):
            return back()
            ->with('message', 'Datos eliminados exitosamente')
            ->with('typealert', 'success');
        endif;
    }
}
