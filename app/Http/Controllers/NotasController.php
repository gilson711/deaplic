<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notas;
class NotasController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth');
        $this->middleware('verified');
    }
    public function index(){
        return view('notas.todas.index', ['notas'=>notas::all()->where('user_id', auth()->id())]);
    }
    public function edit($id){
        return view('notas.todas.edit', ['notas'=>notas::findOrFail($id)]);
    }
    public function update(Request $request, $id){
        $nota = Notas::findOrFail($id);
        $nota->titulo = $request->get('titulo');
        $nota->texto = $request->get('texto'); 
        $nota->update();
        
        return redirect('notas/todas'); 
    }
    public function store(Request $request){
        $nota = new Notas();
        $nota->titulo = request('titulo');
        $nota->texto = request('texto');
        $nota->user_id = auth()->id();
        $nota->save();

        return redirect('notas/todas');
    }
    public function destroy($id){
        $nota = Notas::findOrFail($id);
        $nota->delete();

        return redirect('notas/todas');
    }
    public function favoritas(){
        return view('notas.favoritas');
    }
    public function archivadas(){
        return view('notas.archivadas');
    }
}
