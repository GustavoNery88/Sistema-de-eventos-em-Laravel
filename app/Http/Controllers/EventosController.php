<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Log;

class EventosController extends Controller
{
    public function index() {

        $search = request('search');

        if($search){
           $eventos = Evento::where([
            ['nome', 'like', '%'.$search.'%']
           ])->get();
        } else{
             $eventos = Evento::all();
        }

        return view('home', ['eventos' => $eventos, 'search' => $search]);
    }

    public function criar() {
        return view('events.criar');
    }

    public function store(Request $request){
        Log::info('Acessou a função store');

        $evento = new Evento;
        $evento->nome = $request->nome;
        $evento->descricao = $request->descricao;
        $evento->data = $request->data;
        $evento->itens = $request->itens;
        $evento->local = $request->local;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->file('imagem');

            $extension = $requestImagem->extension();

            $imagemNome = md5($requestImagem->getClientOriginalName() . strtotime("now")) . '.' . $extension;

            $requestImagem->move(public_path('img/eventos'), $imagemNome);

            $evento->imagem = $imagemNome;
        }

        // Salva o id do usuário autenticado
        $user = Auth::user();
        $evento->id_user = $user->id;

        $evento->save();
        
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        $evento = Evento::findOrFail($id);

        $user = auth()->user();

        $hasUserJoined = false;

        if($user){
            $userEventos = $user->eventosComoParticipante->toArray();

            foreach ($userEventos as $userEvento) {
                if($userEvento['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventoDono = User::where('id', $evento->id_user)->first()->toArray();
        return view('events.show', ['evento' => $evento, 'eventoDono' => $eventoDono, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {
        Log::info('Acessou a dashboard');
        $user = auth()->user();
        $eventos = Evento::where('id_user', $user->id)->get();

        

        $eventosComoParticipante = $user->eventosComoParticipante;
    
        return view('events.dashboard', ['eventos' => $eventos, 'eventosComoParticipante' => $eventosComoParticipante]);
    }

     public function destroy($id) {
        $evento = Evento::findOrFail($id);

        // Verifica se o evento pertence ao usuário autenticado
        if ($evento->id_user != Auth::id()) {
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para deletar este evento!');
        }

        $evento->delete();
        return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso!');
    }



    public function edit($id) {
        $evento = Evento::findOrFail($id);

        // Verifica se o evento pertence ao usuário autenticado
        if ($evento->id_user != Auth::id()) {
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para editar este evento!');
        }

        return view('events.edit', ['evento' => $evento]);
    }

    public function update(Request $request, $id) {
        $evento = Evento::findOrFail($id);

        // Verifica se o evento pertence ao usuário autenticado
        if ($evento->id_user != Auth::id()) {
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para editar este evento!');
        }

        $evento->nome = $request->nome;
        $evento->descricao = $request->descricao;
        $evento->data = $request->data;
        $evento->local = $request->local;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->file('imagem');

            $extension = $requestImagem->extension();

            $imagemNome = md5($requestImagem->getClientOriginalName() . strtotime("now")) . '.' . $extension;

            $requestImagem->move(public_path('img/eventos'), $imagemNome);

            $evento->imagem = $imagemNome;
        }

        $evento->save();

        return redirect('/dashboard')->with('msg', 'Evento atualizado com sucesso!');
    }

    public function joinEvent($id){
        Log::info('Se inscreveu no evento');
        $user = auth()->user();
        $user->eventosComoParticipante()->attach($id);
        $evento = Evento::findOrFail($id);
    
        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento!');
    }
    
   public function leaveEvent($id) {
    $user = auth()->user();
    $user->eventosComoParticipante()->detach($id);
    $evento = Evento::findOrFail($id);

    return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento ' . $evento->nome);
   }
    
}

