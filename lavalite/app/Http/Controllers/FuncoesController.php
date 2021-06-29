<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcoes;
use Illuminate\Support\Facades\DB;
use Theme;



class FuncoesController extends Controller
{
    private $funcoes;

    public function __construct(Funcoes $funcoes)
    {
        $this->funcao = $funcoes;
    }

    public function index()
    {

        $theme = Theme::uses('user')->layout('user');

        $funcoes = $this->funcao
          ->orderBy('nome', 'ASC')
          ->paginate(10);

        //$funcoes = Funcoes::select(DB::raw("CONCAT(func_1,nome_func,func_2,func_3,func_4,nome_prox,func_5) AS teste"), 'id')
          //  ->get()
            //->pluck('teste', 'id');

        //concatenar query correta
        // $funcoes = Funcoes::select(DB::raw("CONCAT(func_1,nome_func,func_2,func_3,func_4,nome_prox,func_5) AS teste"),'id')
        //    ->pluck('teste', 'id');

        
        
        return $theme->of('funcoes.index', ['funcoes' => $funcoes])->render();

    }

    public function create()
    {
        $theme = Theme::uses('user')->layout('user');

        $funcoes = $this->funcao->find(1);

        return $theme->of('funcoes.create', ['funcoes' => $funcoes])->render();
        
    }

    public function store(Request $request)
    {
        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $newFuncao = $dataForm['tipo'];
        $newFuncao = $dataForm['nome'];
        $newFuncao = $dataForm['func_1'];
        $newFuncao = $dataForm['nome_func'];
        $newFuncao = $dataForm['func_2'];
        $newFuncao = $dataForm['func_3'];
        $newFuncao = $dataForm['func_4'];
        $newFuncao = $dataForm['nome_prox'];
        $newFuncao = $dataForm['func_5'];


        //Verificar se a funcao já existe
        $funcoes = $this->funcao
            ->where('nome_func', '=', $dataForm['nome_func'] )
            ->get()->first();
            if($funcoes != null){
                return redirect()
                    ->route('funcoes.create')
                    ->withErrors(['errors' => 'Está Funcao já existe!'])
                    ->withInput();
            }
        
            //Inserir a funcao no BD
            $insert = $this->funcao->insert([
                'tipo' => $dataForm['tipo'],
                'nome' => $dataForm['nome'],
                'func_1' => $dataForm['func_1'],
                'nome_func' => $dataForm['nome_func'],
                'func_2' => $dataForm['func_2'],
                'func_3' => $dataForm['func_3'],
                'func_4' => $dataForm['func_4'],
                'nome_prox' => $dataForm['nome_prox'],
                'func_5' => $dataForm['func_5'],
            ]);

            if($insert)
            return redirect()
            ->route('funcoes.index')
            ->with(['sucess' => 'Registro Cadastrado com Sucesso'])
            ->withInput();
            else
            return redirect()
                ->route('funcoes/create')
                ->withErrors(['errors' => 'Erro ao cadastrar!'])
                ->withInput()
                ->render();

    }

    public function show($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $funcoes = $this->funcao->find($id);

        return $theme->of('funcoes.show', ['funcoes' => $funcoes])->render();


    }

    public function edit($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $funcoes = $this->funcao->find($id);

        return $theme->of('funcoes.edit', ['funcoes' => $funcoes])->render();
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::uses('user')->layout('user');

        $funcoes = $this->funcao->find($id);
        $dataForm = $request->all();
        $newFuncao = $dataForm['tipo'];
        $newFuncao = $dataForm['nome'];
        $newFuncao = $dataForm['func_1'];
        $newFuncao = $dataForm['nome_func'];
        $newFuncao = $dataForm['func_2'];
        $newFuncao = $dataForm['func_3'];
        $newFuncao = $dataForm['func_4'];
        $newFuncao = $dataForm['nome_prox'];
        $newFuncao = $dataForm['func_5'];


        //Verificar se a funcao já foi cadastrado
        $busca = $this->funcao
            ->where('nome_func', '=', $dataForm['nome_func'])
            ->where('id', '<>', $id)
            ->get()->first();

        //Alterar 
        $update = $funcoes->update($dataForm);
        if($update){
            return redirect()
                ->route('funcoes.edit', $id)
                ->withErrors(['errors' => 'Funcao já Cadastrada!'])
                ->withInput();
            }
        else 
            return redirect()
                ->route('funcoes.edit', $id)
                ->withErrors(['errors' => 'Erro no Update'])
                ->withInput()
                ->render();

    }

    public function destroy($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $funcoes = $this->funcao->find($id);
        $delete = $funcoes->delete();
        if($delete)
            return redirect()
                ->route('funcoes.index')
                ->with(['success' => 'Registro excluido com Sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('funcoes.show', $id)
                ->with(['errors' => 'Erro ao Deletar'])
                ->withInput();

    }

}
