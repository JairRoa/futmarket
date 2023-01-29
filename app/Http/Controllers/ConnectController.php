<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserSendRecover, App\Mail\UserSendNewPassword;

use Validator, Hash, Auth, Mail, Str;

class ConnectController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin()
    {
        return view('connect.login');
    }

    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
            ];
            $messages = [
                'email.required' => 'El correo electrónico requerido.',
                'email.email' => 'Correo no es correcto.',
                'password.required' => 'por favor introduzca una contraseña.',
                'password.min' => 'Contraseña incorrecta.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
             if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'se ha producido un error')
            ->with('typealert', 'danger');
             else:
                if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
                    if(Auth::user()->status == "100"):
                        return redirect('/logout');
                    else:
                        return redirect('/');
                    endif;
                else:
                    return back()->with('message', 'Error de inicio de sesión')->with('typealert', 'danger');
                endif;
             endif;
    }

    public function getRegister()
    {
        return view('connect.register');
    }

    public function postRegister(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];



        $messages = [
            'name.required' => 'El Nombre es requerido.',
            'lastname.required' => 'El Apellido es requerido.',
            'phone.required' => 'El número telefónico requerido.',
            'email.required' => 'El correo electrónico requerido.',
            'email.email' => 'El formato de correo electrónico no es correcto.',
            'email.unique' => 'Este correo ya ha sido registrado con otro usuario.',
            'password.required' => 'por favor introduzca una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'cpassword.required' => 'Se requiere confirmar su contraseña.',
            'cpassword.min' => 'La confirmación de contraseña debe tener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', '')
            ->with('typealert', 'danger');
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->phone = e($request->input('phone'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));

            if($user->save()):
                return redirect('/login')
                ->with('message',  'Bienvenido, tu usuario se ha creado exitosamente, ya puedes iniciar sesión')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getLogout(){
        $status = Auth::user()->status;
        Auth::logout();
        if($status == "100"):
            return redirect('/login')->with('message',  'Hola, tu usuario se encuentra temporalmente suspendido')
            ->with('typealert', 'danger');
        else:
            return redirect('/');
        endif;
    }

    public function getRecover(){
        return view('connect.recover');
    }

    public function postRecover(Request $request){
        $rules = [
            'email' => 'required|email'
        ];
        $messages = [
            'email.required' => 'El correo electrónico requerido.',
            'email.email' => 'El formato de correo electrónico no es correcto.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', '')
            ->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->count();
            if ($user == "1"):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'code' => $code];
                $u = User::find($user->id);
                $u->password_code = $code;
                if($u->save()):
                Mail::to($user->email)->send(new UserSendRecover($data));
                return redirect('/reset?email=' . $user->email)
                ->with('message', 'Hemos enviado un correo con las instrucciones para que recuperes tu contraseña')
                ->with('typealert', 'success');
                endif;
            else:
                return back()
                ->with('message',  'Correo electrónico no existe')
                ->with('typealert', 'danger');
            endif;
        endif;
    }

    public function getReset(Request $request){
        $data = ['email' => $request->get('email')];
        return view('connect.reset', $data);
    }

    public function postReset(Request $request){
        $rules = [
            'email' => 'required|email',
            'code' => 'required'
        ];
        $messages = [
            'email.required' => 'El correo electrónico requerido.',
            'email.email' => 'El formato de correo electrónico no es correcto.',
            'code.required' => 'Introduzca el cógido enviado a su correo'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error')
            ->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();
            if ($user == "1"):
                $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
                $new_password = Str::random(8);
                $user->password = Hash::make($new_password);
                $user->password_code = null;
                if($user->save()):
                    $data = ['name' => $user->name, 'password' => $new_password];
                    Mail::to($user->email)->send(new UserSendNewPassword($data));
                    return redirect('/login')
                    ->with('message', 'Contraseña restablecida exitosamente, dirígete a tu correo para poder iniciar sesión')
                    ->with('typealert', 'success');
                endif;
            else:
                return back()
                ->with('message', 'El correo electónico o el código son erroneos, reviselos e intente nuevamente')
                ->with('typealert', 'danger');
            endif;
        endif;
    }

}
