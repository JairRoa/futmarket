<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Models\Category, App\Http\Models\Products, App\Http\Models\PGallery;

use Validator, Str, Config, Image;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }
    public function getHome($status){
        switch($status){
            case '0':
                $products = Products::with(['cat'])->where('status' , '0')->orderBy('id', 'desc')->paginate(10);
                break;
            case '1':
                $products = Products::with(['cat'])->where('status' , '1')->orderBy('id', 'desc')->paginate(10);
                break;
            case 'all':
                $products = Products::with(['cat'])->orderBy('id', 'desc')->paginate(10);
                break;
            case 'trash':
                $products = Products::with(['cat'])->onlyTrashed()->orderBy('id', 'desc')->paginate(10);
                break;
        }

        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    public function getProductAdd(){
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el producto',
            'img.required' => 'Seleccione una imagen del dispositivo',
            'img.image' => 'El archivo seleccionado no corresponde a un formato de imagen',
            'price.required' => 'El producto requiere un precio',
            'content.required' => 'Por favor incluir la descripción del producto'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'se ha producido un error')
            ->with('typealert', 'danger')->withInput();
        else:
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt,'', $request->file('img')->getClientOriginalName()));
            $filename = rand(1, 9999).'-'.$name.'.'.$fileExt;
            $final_file = $upload_path . '/' . $path . '/' . $filename;


            $product = new Products;
            $product->status = '0';
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->inventory = e($request->input('inventory'));
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));
            if ($product->save()):
                if ($request->hasFile('img')):
                    $fl = $request->img->storeAs($path , $filename , 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path. '/' . $path . '/t_' . $filename);
                endif;
                return redirect('/admin/products')
                ->with('message', 'Producto creado exitosamente')
                ->with('typealert', 'success');
            endif;
        endif;


    }

    public function getProductEdit($id){
        $p = Products::findOrFail($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p'=>$p];
        return view('admin.products.edit', $data);
    }

    public function postProductEdit($id, Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el producto',
            'img.image' => 'El archivo seleccionado no corresponde a un formato de imagen',
            'price.required' => 'El producto requiere un precio',
            'content.required' => 'Por favor incluir la descripción del producto'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'se ha producido un error')
            ->with('typealert', 'danger')->withInput();
        else:

            $product = Products::findOrFail($id);
            $ipp = $product->file_path;
            $ip = $product->image;
            $product->status = $request->input('status');
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->category_id = $request->input('category');
            if ($request->hasFile('img')):
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt,'', $request->file('img')->getClientOriginalName()));
                $filename = rand(1, 9999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path . '/' . $path . '/' . $filename;
                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;
            $product->price = $request->input('price');
            $product->inventory = e($request->input('inventory'));
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));
            if ($product->save()):
                if ($request->hasFile('img')):
                    $fl = $request->img->storeAs($path , $filename , 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path. '/' . $path . '/t_' . $filename);
                    unlink($upload_path . '/' . $ipp . '/' . $ip);
                    unlink($upload_path . '/' . $ipp . '/t_' . $ip);
                endif;
                return back()
                ->with('message', 'Producto actualizado exitosamente')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function postProductGalleryAdd($id, Request $request){
        $rules = [
            'file_image' => 'required'
        ];

        $messages = [
            'file_image.required' => 'Seleccione una imagen del dispositivo'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'se ha producido un error')
            ->with('typealert', 'danger')->withInput();
        else:
            if ($request->hasFile('file_image')):
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt,'', $request->file('file_image')->getClientOriginalName()));

                $filename = rand(1, 9999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path . '/' . $path . '/' . $filename;

                $g = new PGallery;
                $g->product_id = $id;
                $g->file_path = date('Y-m-d');
                $g->file_name = $filename;

                if ($g->save()):
                    if ($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path , $filename , 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function ($constraint) {
                            $constraint->upsize();
                        });
                        $img->save($upload_path. '/' . $path . '/t_' . $filename);
                    endif;
                    return back()->with('message', 'Imagen almacenada exitosamente')->with('typealert', 'success');
                endif;
            endif;


        endif;
    }

    public function getProductGalleryDelete($id, $gid){
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->product_id != $id){
            return back()->with('message', 'la imagen no puede ser eliminada')->with('typealert', 'danger');
        }else{
            if ($g->delete()):
                unlink($upload_path . '/' . $path . '/' . $file);
                unlink($upload_path . '/' . $path . '/t_' . $file);
                return back()->with('message', 'La imagen ha sido borrada')->with('typealert', 'success');
            endif;
        }
    }

    public function postProductSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => ' Por favor introduzca una consulta'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', ' se ha producido un error')
            ->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $products = Products::with(['cat'])->where('name', 'LIKE', '%' .$request->input('search').'%')->where('status' , '0')->orderBy('id', 'desc')->get();
                    break;

                    case '1':
                    $products = Products::with(['cat'])->where('code', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['products' => $products];
            return view('admin.products.search', $data);

        endif;
    }
}
