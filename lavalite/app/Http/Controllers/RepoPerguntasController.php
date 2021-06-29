<?php

namespace App\Http\Controllers;

use App\Models\Repo_Perguntas;
use Illuminate\Http\Request;
use Theme;


class RepoPerguntasController extends Controller
{

    private $perguntas;

    public function __construct(Repo_Perguntas $repo__perguntas)
    {
        $this->perguntas = $repo__perguntas;
    }

    public function index()
    {

        $theme = Theme::uses('user')->layout('user');

        $perguntas = $this->perguntas
          ->orderBy('pergunta', 'ASC')
          ->paginate(10);
        
        
        return $theme->of('perguntas.index', ['perguntas' => $perguntas])->render();

    }

    public function create()
    {
        $theme = Theme::uses('user')->layout('user');

        return $theme->of('perguntas.create')->render();
        
    }

    public function store(Request $request)
    {
        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $newPergunta = $dataForm['pergunta'];

        //Verificar se a pergunta já existe
        $perguntas = $this->perguntas
            ->where('pergunta', '=', $newPergunta )
            ->get()->first();
            if($perguntas != null){
                return redirect()
                    ->route('perguntas.create')
                    ->withErrors(['errors' => 'Está Pergunta já existe!'])
                    ->withInput();
            }
        
            //Inserir a pergunta no BD
            $insert = $this->perguntas->insert([
                'pergunta' => $dataForm['pergunta']
            ]);

            if($insert)
            return redirect()
            ->route('perguntas.index')
            ->with(['sucess' => 'Registro Cadastrado com Sucesso'])
            ->withInput();
            else
            return redirect()
                ->route('perguntas/create')
                ->withErrors(['errors' => 'Erro ao cadastrar!'])
                ->withInput()
                ->render();

    }

    public function show($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $perguntas = $this->perguntas->find($id);

        return $theme->of('perguntas.show', ['perguntas' => $perguntas])->render();


    }

    public function edit($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $perguntas = $this->perguntas->find($id);

        return $theme->of('perguntas.edit', ['perguntas' => $perguntas])->render();
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::uses('user')->layout('user');

        $perguntas = $this->perguntas->find($id);
        $dataForm = $request->all();
        $newPergunta = $dataForm['pergunta'];
        //Verificar se a pergunta já foi cadastrado
        $busca = $this->perguntas
            ->where('pergunta', '=', $newPergunta)
            ->where('id', '<>', $id)
            ->get()->first();

        //Alterar 
        $update = $perguntas->update($dataForm);
        if($update){
            return redirect()
                ->route('perguntas.edit', $id)
                ->withErrors(['errors' => 'Perguntas já Cadastrada!'])
                ->withInput();
            }
        else 
            return redirect()
                ->route('perguntas.edit', $id)
                ->withErrors(['errors' => 'Erro no Update'])
                ->withInput()
                ->render();

    }

    public function destroy($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $perguntas = $this->perguntas->find($id);
        $delete = $perguntas->delete();
        if($delete)
            return redirect()
                ->route('perguntas.index')
                ->with(['success' => 'Registro excluido com Sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('perguntas.show', $id)
                ->with(['errors' => 'Erro ao Deletar'])
                ->withInput();

    }

}

