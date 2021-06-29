<?php

namespace App\Http\Controllers;

use App\Models\Conversas;
use App\Models\Funcoes;
use App\Models\Repo_Perguntas;
use App\Models\Repo_Respostas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Theme;

class ConversasController extends Controller
{
    private $conversas;
    private $funcoes;

    public function __construct(Conversas $conversas, Funcoes $funcoes)
    {
        $this->conversa = $conversas;
        $this->funcao = $funcoes;
    }

    public function index()
    {

        $theme = Theme::uses('user')->layout('user');

        $conversas = $this->conversa
          ->orderBy('nome_conversa', 'ASC')
          ->paginate(10);

        //concatenar query correta
        // $conversas = Conversa::select(DB::raw("CONCAT(func_1,nome_func,func_2,func_3,func_4,nome_prox,func_5) AS teste"),'id')
        //    ->pluck('teste', 'id');

        return $theme->of('conversas.index', ['conversas' => $conversas])->render();

    }

    public function create()
    {
        $theme = Theme::uses('user')->layout('user');

            $funcoes = Funcoes::pluck('nome');
            $conversas = $this->conversa;
            $perguntas = Repo_Perguntas::pluck('pergunta');
            $respostas = Repo_Respostas::pluck('resposta');

        return $theme->of('conversas.create', ['conversas' => $conversas, 'funcoes' => $funcoes, 'perguntas' => $perguntas, 'respostas' => $respostas])->render();

    }

    public function store(Request $request)
    {    
        
        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $nome_conversa = $dataForm['nome_conversa'];
        $nome = $dataForm['nome'];
        $pergunta = $dataForm['pergunta'];
        $resposta = $dataForm['resposta'];
        $nome_prox = $dataForm['nome_func'];

        $nome_func = $this->funcao
            ->where('nome', '=', $nome)
            ->value('nome_func');

        //Verificar se a conversa já existe
        $conversas = $this->conversa
            ->where('nome_func', '=', $nome_func )
            ->get()->first();
            if($conversas != null){
                return redirect()
                    ->route('conversas.create')
                    ->withErrors(['errors' => 'Está conversa já existe!'])
                    ->withInput();
            }
        //Pegar a função(pergunta) e concatenar para inserir no outro BD
        $parte_1 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value(DB::raw("CONCAT(' ',func_1,' ',nome_func,func_2)"));
        
        $parte_2 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value("func_3");

        $parte_3 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value("func_4");

        $parte_4 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value('func_5');

        //Inserir a conversa no BD
        $insert = $this->conversa->insert([
            'nome_conversa' => $nome_conversa,
            'nome_func' => $nome_func,
            'parte_1' => $parte_1,
            'pergunta' => $pergunta,
            'parte_2' => $parte_2,
            'resposta' => $resposta,
            'parte_3' => $parte_3,
            'nome_prox' => $nome_prox,
            'parte_4' => $parte_4,            
        ]);

        if($insert)
        return redirect()
        ->route('conversas.index')
        ->with(['sucess' => 'Registro Cadastrado com Sucesso'])
        ->withInput();
        else
        return redirect()
            ->route('conversas/create')
            ->withErrors(['errors' => 'Erro ao cadastrar!'])
            ->withInput()
            ->render();
    }

    public function show($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $conversas = $this->conversa->find($id);
        $funcoes = Funcoes::pluck('nome');
        $perguntas = Repo_Perguntas::pluck('pergunta');
        $respostas = Repo_Respostas::pluck('resposta');


        return $theme->of('conversas.show', ['conversas' => $conversas, 'funcoes' => $funcoes, 'perguntas' => $perguntas, 'respostas' => $respostas])->render();



    }

    public function edit($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $conversas = $this->conversa->find($id);
        $funcoes = Funcoes::all();
        $perguntas = Repo_Perguntas::pluck('pergunta');
        $respostas = Repo_Respostas::pluck('resposta');


        return $theme->of('conversas.edit', ['conversas' => $conversas, 'funcoes' => $funcoes, 'perguntas' => $perguntas, 'respostas' => $respostas])->render();
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::uses('user')->layout('user');

        $conversas = $this->conversa->find($id);
        $dataForm = $request->all();
        $nome_conversa = $dataForm['nome_conversa'];
        $nome = $dataForm['nome'];
        $pergunta = $dataForm['pergunta'];
        $resposta = $dataForm['resposta'];

        $nome_func = $this->funcao
            ->where('nome', '=', $nome)
            ->value('nome_func');

        //Pegar a função(pergunta) e concatenar para inserir no outro BD
        $parte_1 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value(DB::raw("CONCAT(' ',func_1,' ',nome_func,func_2)"));
        
        $parte_2 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value("func_3");

        $parte_3 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value("func_4");

        $nome_prox = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value('nome_prox');

        $parte_4 = $this->funcao
            ->where('nome_func', '=', $nome_func)
            ->value('func_5');

        //Verificar se a conversa já foi cadastrado
        $busca = $this->conversa
            ->where('nome_func', '=', $nome_func)
            ->where('id', '<>', $id)
            ->get()->first();
        if($busca != null){
            return redirect()
                ->route('conversas.create')
                ->withErrors(['errors' => 'Está conversa nao pode ser atualizada!'])
                ->withInput();
        }


        //Alterar 
        $update = $conversas->update([
            'nome_conversa' => $nome_conversa,
            'nome_func' => $nome_func,
            'parte_1' => $parte_1,
            'pergunta' => $pergunta,
            'parte_2' => $parte_2,
            'resposta' => $resposta,
            'parte_3' => $parte_3,
            'nome_prox' => $nome_prox,
            'parte_4' => $parte_4,            
        ]);
        if($update){
            return redirect()
                ->route('conversas.edit', $id)
                ->withErrors(['errors' => 'Atualizado!'])
                ->withInput();
            }
        else 
            return redirect()
                ->route('conversas.edit', $id)
                ->withErrors(['errors' => 'Erro no Update'])
                ->withInput()
                ->render();

    }

    public function destroy($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $conversas = $this->conversa->find($id);
        $delete = $conversas->delete();
        if($delete)
            return redirect()
                ->route('conversas.index')
                ->with(['success' => 'Registro excluido com Sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('conversas.show', $id)
                ->with(['errors' => 'Erro ao Deletar'])
                ->withInput();

    }

}
