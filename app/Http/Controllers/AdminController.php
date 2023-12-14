<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminEditRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateRequest $request)
    {
        try {
            $admin = new Admin($request->all());
            if($request->hasFile('photo') && $request->file('photo')->isValid()) {
                // Guardamos el archivo en una variable
                $archivo = $request->file('photo');
                // Crea la carpeta images si no existe la carpeta
                //$path2 = $archivo->storeAs('public/images', $archivo->getClientOriginalName());
                // Cotejamos el tipo de archivo que suben.
                // Es fundamental comprobar que sea los archivo que queremos permitir 
                // para que no tengamos problemas de seguridad ni de nada
                //$mime = $archivo->getMimeType();
                // Obtengo la url donde se sube automatico
                $path = $archivo->getRealPath();
                // Obtenemos el contenido del archivo
                $imagen = file_get_contents($path);
                // Guardamos la imagen en el modelo en base64
                $admin->photo = base64_encode($imagen);
            }
            $passwdHash = password_hash($admin->password, PASSWORD_DEFAULT);
            $admin->password = $passwdHash;
            $result = $admin->save();  
            return redirect('back/admin')->with(['message'=> 'New admin registered.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The user could not register']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.show', ['admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminEditRequest $request, Admin $admin)
    {
        try {
            if($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $archivo = $request->file('photo');
                // Cotejamos el tipo de archivo que suben.
                // Es fundamental comprobar que sea los archivo que queremos permitir 
                // para que no tengamos problemas de seguridad ni de nada
                //$mime = $archivo->getMimeType();
                $path = $archivo->getRealPath();
                $imagen = file_get_contents($path);
                $admin->photo = base64_encode($imagen);
            }
            if($request->password != $admin->password) {
                $admin->password = password_hash($request->password, PASSWORD_DEFAULT);
            }
            
            $admin->username = $request->username;
            
            // guardamos cambios
            $result = $admin->save();  
            return redirect('back/admin')->with(['message'=> 'Admin successfully edited.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The admin could not edit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Admin $admin)
    {
        try {
            $sesionAdmin = Admin::where('username', session('userSesion'))->get();
            if($admin->id == $sesionAdmin[0]->id) {
                $admin->delete();
                session(['userDeleted' => 'Your user account has been deleted']);
                $request->session()->forget('check');
                $request->session()->forget('userSesion');
                $request->session()->forget('urlUserSesion');
                $request->session()->forget('userPhoto');
                return redirect('back');
            } else {
                $admin->delete();
            }
            return redirect('back/admin')->with(['message'=> 'This admin has been deleted.']);
        } catch (\Exception $e) {
            return redirect('back/admin')->withErrors(['message' => $e .'This admin has not been deleted.']);
        }
    }
}
