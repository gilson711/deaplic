<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware( 'auth');
        $this->middleware('verified');
        /*MIDDLEWARE
        SIRVE PARA QUE UN USUARIO INICIE SESION Y PUEDA VER LOS REGISTROS, ES DECIR NO CUALQUIERA PODRA VER LOS REGISTROS
        A MENOS QUE ESTE LOGEADO
        */
    }
    
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::all();

            return DataTables::of($users)
            ->addColumn('rol', function($users){
                foreach($users->roles as $role){
                    return $role->name;
                }
            })
            ->addColumn('imagen', function($users){
                if(empty($users->imagen)){
                    return '';
                }
                return'<img src="imagenes/' .$users->imagen.'" width="50" height="50"/>';
            })
            ->addColumn('action', 'usuarios.actions')
            ->rawColumns(['imagen', 'action'])
            ->make(true);
        }
        return view ('usuarios.index');
        /*if($request){
                $query = trim($request->get('search'));
                $users = User::where('name', 'LIKE', '%'.$query.'%')
                ->orderBy('id', 'asc')
                ->simplepaginate(7);
                return view('usuarios.index', ['users' =>$users, 'search'=>$query]);
            }*/ 
        //$users = User::all(); 
        //return view('usuarios.index', ['users' => $users]);
    }

    
    public function create()
    {
        $roles = Role::all();
        return view ('usuarios.create', ['roles'=>$roles]);
    }

    
    public function store(UserFormRequest $request)
    {
        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = bcrypt($request->input('password'));
        if($request->hasFile('imagen')){
            $file = $request->imagen;
            $file->move(public_path(). '/imagenes', $file->getClientOriginalName());
            $usuario->imagen = $file->getClientOriginalName();

        }
        //$usuario->name = request(key: 'name');
        //$usuario->email = request(key: 'email');
        //$usuario->password = request(key: 'password');
        $usuario->save();
        $usuario->asignarRol($request->get('rol'));

        return redirect('/usuarios');
    }

   
    public function show($id)
    {
        return view ('usuarios.show', ['user'=>User::findOrFail($id)]);
    }

    
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::all();

        return view ('usuarios.edit', ['user'=>$users, 'roles' =>$roles]);
    }

    
    public function update(UserEditFormRequest $request, $id)
    {
        $this->validate(request(), ['email' => ['required', 'email', 'max:255', 'unique:users,email,'. $id]]);
        $usuario = User::findOrFail($id);
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        //$usuario->name = $request->get(key:'name');
        //$usuario->email = $request->get(key:'email');

        if($request->hasFile('imagen')){
            $file = $request->imagen;
            $file->move(public_path(). '/imagenes', $file->getClientOriginalName());
            $usuario->imagen = $file->getClientOriginalName();

        }
        //Actualizamos password
        $pass = $request->get('password');
        if($pass != null){
            $usuario->password = bcrypt($request->get('password'));
        }else{
            unset($usuario->password);
        }

        //Actualizamos rol
        //si tiene ol actalizamos rol
        //si no tiene le asignamos rol
        $role = $usuario->roles;
        
        if(count($role) > 0){
            $role_id = $role[0]->id;
            User::find($id)->roles()->updateExistingPivot($role_id, ['role_id'=>$request->get('rol')]);
        }else{
            $usuario->asignarRol($request->get('rol'));
        }
        
        

        $usuario->update();
        return redirect('/usuarios');
        }

    
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect('usuarios');
    }
}
