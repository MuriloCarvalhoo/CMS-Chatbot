<?php

namespace App\Http\Controllers;

use App\Models\Repo_Respostas;
use Illuminate\Http\Request;
use Theme;


class RepoRespostasController extends Controller
{
    private $respostas;

    public function __construct(Repo_Respostas $repo__respostas)
    {
        $this->respostas = $repo__respostas;
    }

    public function index()
    {

        $theme = Theme::uses('user')->layout('user');

        $respostas = $this->respostas
          ->orderBy('resposta', 'ASC')
          ->paginate(10);
        
        
        return $theme->of('respostas.index', ['respostas' => $respostas])->render();

    }

    public function create()
    {
        $theme = Theme::uses('user')->layout('user');

        return $theme->of('respostas.create')->render();
        
    }

    public function store(Request $request)
    {
        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $newResposta = $dataForm['resposta'];

        //Verificar se a resposta já existe
        $respostas = $this->respostas
            ->where('resposta', '=', $newResposta )
            ->get()->first();
            if($respostas != null){
                return redirect()
                    ->route('respostas.create')
                    ->withErrors(['errors' => 'Está Resposta já existe!'])
                    ->withInput();
            }
        
            //Inserir a pergunta no BD
            $insert = $this->respostas->insert([
                'resposta' => $dataForm['resposta']
            ]);

            if($insert)
            return redirect()
            ->route('respostas.index')
            ->with(['sucess' => 'Registro Cadastrado com Sucesso'])
            ->withInput();
            else
            return redirect()
                ->route('respostas/create')
                ->withErrors(['errors' => 'Erro ao cadastrar!'])
                ->withInput()
                ->render();

    }

    public function show($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $respostas = $this->respostas->find($id);

        return $theme->of('respostas.show', ['respostas' => $respostas])->render();


    }

    public function edit($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $respostas = $this->respostas->find($id);

        return $theme->of('respostas.edit', ['respostas' => $respostas])->render();
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::uses('user')->layout('user');

        $respostas = $this->respostas->find($id);
        $dataForm = $request->all();
        $newResposta = $dataForm['resposta'];
        //Verificar se a resposta já foi cadastrado
        $busca = $this->respostas
            ->where('resposta', '=', $newResposta)
            ->where('id', '<>', $id)
            ->get()->first();

        //Alterar 
        $update = $respostas->update($dataForm);
        if($update){
            return redirect()
                ->route('respostas.edit', $id)
                ->withErrors(['errors' => 'Respostas já Cadastrada!'])
                ->withInput();
            }
        else 
            return redirect()
                ->route('respostas.edit', $id)
                ->withErrors(['errors' => 'Erro no Update'])
                ->withInput()
                ->render();

    }

    public function destroy($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $respostas = $this->respostas->find($id);
        $delete = $respostas->delete();
        if($delete)
            return redirect()
                ->route('respostas.index')
                ->with(['success' => 'Registro excluido com Sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('respostas.show', $id)
                ->with(['errors' => 'Erro ao Deletar'])
                ->withInput();

    }

}
