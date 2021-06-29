<?php

namespace App\Http\Controllers;

use App\Models\Conversas;
use App\Models\Funcoes;
use App\Models\Repo_Perguntas;
use App\Models\Repo_Respostas;
use App\Models\CriarClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Theme;

class CriarClasseController extends Controller
{
    private $conversas;
    private $funcoes;
    private $classe;


    public function __construct(Conversas $conversas, Funcoes $funcoes, CriarClasse $classe, Repo_Perguntas $perguntas, Repo_Respostas $respostas)
    {
        $this->conversa = $conversas;
        $this->funcao = $funcoes;
        $this->classe = $classe;
        $this->perguntas = $perguntas;
        $this->respostas = $respostas;

    }

    public function index()
    {

        $theme = Theme::uses('user')->layout('user');

        $classes = $this->classe
          ->orderBy('nome_classe', 'ASC')
          ->paginate(10);

        return $theme->of('classes.index', ['classes' => $classes])->render();

    }

    public function create()
    {
        $theme = Theme::uses('user')->layout('user');

            $conversas = Conversas::pluck('nome_conversa');
            $classes = $this->classe;

        return $theme->of('classes.create', ['conversas' => $conversas, 'classes' => $classes ])->render();

    }

    public function store(Request $request)
    {    
        
        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $parte_1 = $dataForm['parte_1'];
        $nome_classe = $dataForm['nome_classe'];

        //Verificar se a classe já existe
        $classes = $this->classe
            ->where('nome_classe', '=', $nome_classe )
            ->get()->first();
            if($classes != null){
                return redirect()
                    ->route('classes.create')
                    ->withErrors(['errors' => 'Está conversa já existe!'])
                    ->withInput();
            }

        //Restante das informações para criar classe
        $parte_2 = ' extends Conversation { ' ;

        $conversa_ordens = Conversas::where('nome_conversa', '=', $nome_classe)
        ->selectRaw("CONCAT(parte_1,pergunta,parte_2,resposta,parte_3,nome_prox,parte_4) AS funcao")->pluck('funcao')->toArray();
            
        $conversa_ordem = implode(" ", $conversa_ordens);

        $conversa_ordem;
        $final = ' } ';
        
        //Inserir a conversa no BD
        $insert = $this->classe->insert([
            'parte_1' => $parte_1,
            'nome_classe' => $nome_classe,
            'parte_2' => $parte_2,
            'conversa_ordem' => $conversa_ordem,
            'final' => $final,
        ]);

        if($insert)
        return redirect()
        ->route('classes.index')
        ->with(['sucess' => 'Registro Cadastrado com Sucesso'])
        ->withInput();
        else
        return redirect()
            ->route('classes/create')
            ->withErrors(['errors' => 'Erro ao cadastrar!'])
            ->withInput()
            ->render();
    }

    public function show($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $classes = $this->classe->find($id);
        $conversas = Conversas::pluck('nome_conversa');

        return $theme->of('classes.show', ['conversas' => $conversas, 'classes' => $classes])->render();

    }

    public function edit($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $classes = $this->classe->find($id);
        $conversas = Conversas::pluck('nome_conversa');


        return $theme->of('classes.edit', ['conversas' => $conversas, 'classes' => $classes ])->render();
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::uses('user')->layout('user');

        $classes = $this->classe->find($id);
        $dataForm = $request->all();
        $parte_1 = $dataForm['parte_1'];
        $nome_classe = $dataForm['nome_classe'];


        //Verificar se a classe já existe
        $busca = $this->classe
            ->where('nome_classe', '=', $nome_classe )
            ->where('id', '<>', $id)
            ->get()->first();
            if($busca != null){
                return redirect()
                    ->route('classes.create')
                    ->withErrors(['errors' => 'Está classe nao pode ser atualizada!'])
                    ->withInput();
            }

        //Restante das informações para criar classe
        $parte_2 = ' extends Conversation { ' ;

        $conversa_ordens = Conversas::where('nome_conversa', '=', $nome_classe)
        ->selectRaw("CONCAT(parte_1,pergunta,parte_2,resposta,parte_3,nome_prox,parte_4) AS funcao")->pluck('funcao')->toArray();
        
        $conversa_ordem = implode(" ", $conversa_ordens);

        $conversa_ordem;

        $final = ' } ';

        //Alterar 
        $update = $classes->update([
            'parte_1' => $parte_1,
            'nome_classe' => $nome_classe,
            'parte_2' => $parte_2,
            'conversa_ordem' => $conversa_ordem,
            'final' => $final,
        ]);
        if($update){
            return redirect()
                ->route('classes.edit', $id)
                ->withErrors(['errors' => 'Classe atualizada!'])
                ->withInput();
            }
        else 
            return redirect()
                ->route('classes.edit', $id)
                ->withErrors(['errors' => 'Erro no Update'])
                ->withInput()
                ->render();

    }

    public function gerarClasse(Request $request)
    {

        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $nome_classe = $dataForm['nome_classe'];

        $classeBD = CriarClasse::where('nome_classe', '=', $nome_classe)
        ->value(DB::raw("CONCAT(parte_1,' ',nome_classe,' ',parte_2,' ',conversa_ordem,' ',final,' ')"));

        //Criar e reescrever arquivo 
        $file_handle = fopen('/var/www/html/lavalite (cópia)/app/Http/Conversations/OnboardingConversation.php', 'a+');
        fwrite($file_handle, $classeBD);
        fwrite($file_handle, "\n");
        fclose($file_handle);

        if($file_handle)
            return redirect()
                ->route('classes.index')
                ->with(['success' => 'Arquivo .php gerado com sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('classes.index', $id)
                ->with(['errors' => 'Erro ao gerar arquivo pp'])
                ->withInput();

    }

    public function destroy($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $classes = $this->classe->find($id);
        $delete = $classes->delete();
        if($delete)
            return redirect()
                ->route('classes.index')
                ->with(['success' => 'Registro excluido com Sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('classes.show', $id)
                ->with(['errors' => 'Erro ao Deletar'])
                ->withInput();

    }


}
