<?php

namespace App\Http\Controllers;

use App\Models\Conversas;
use App\Models\Funcoes;
use App\Models\Repo_Perguntas;
use App\Models\Repo_Respostas;
use App\Models\CriarClasse;
use App\Models\Dinamica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Theme;

class DinamicaController extends Controller
{
    private $conversas;
    private $funcoes;
    private $classe;
    private $dinamica;



    public function __construct(Dinamica $dinamica,Conversas $conversas, Funcoes $funcoes, CriarClasse $classe, Repo_Perguntas $perguntas, Repo_Respostas $respostas)
    {
        $this->conversa = $conversas;
        $this->funcao = $funcoes;
        $this->classe = $classe;
        $this->perguntas = $perguntas;
        $this->respostas = $respostas;
        $this->dinamica = $dinamica;
        

    }

    public function index()
    {

        $theme = Theme::uses('user')->layout('user');

        $dinamica = $this->dinamica
          ->orderBy('nome_classe', 'ASC')
          ->paginate(10);

        return $theme->of('dinamica.index', ['dinamica' => $dinamica])->render();

    }

    public function create()
    {
        $theme = Theme::uses('user')->layout('user');

            $conversas = Conversas::pluck('nome_conversa');
            $dinamica = $this->dinamica;

            

        return $theme->of('dinamica.create', ['conversas' => $conversas, 'dinamica' => $dinamica ])->render();

    }

    public function store(Request $request)
    {    
        
        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $parte_1 = $dataForm['parte_1'];
        $nome_classe = $dataForm['nome_classe'];

        //Verificar se a dinamica já existe
        $dinamica = $this->dinamica
            ->where('nome_classe', '=', $nome_classe )
            ->get()->first();
            if($dinamica != null){
                return redirect()
                    ->route('dinamica.create')
                    ->withErrors(['errors' => 'Está conversa já existe!'])
                    ->withInput();
            }

        //Restante das informações para criar dinamica
        $parte_2 = ' extends Conversation { ' ;

        $conversa_ordens = Conversas::where('nome_conversa', '=', $nome_classe)
        ->selectRaw("CONCAT(parte_1,pergunta,parte_2,resposta,parte_3,nome_prox,parte_4) AS funcao")->pluck('funcao')->toArray();
            
        $conversa_ordem = implode(" ", $conversa_ordens);

        $conversa_ordem;
        $final = ' } ';
        
        //Inserir a conversa no BD
        $insert = $this->dinamica->insert([
            'parte_1' => $parte_1,
            'nome_classe' => $nome_classe,
            'parte_2' => $parte_2,
            'conversa_ordem' => $conversa_ordem,
            'final' => $final,
        ]);

        if($insert)
        return redirect()
        ->route('dinamica.index')
        ->with(['sucess' => 'Registro Cadastrado com Sucesso'])
        ->withInput();
        else
        return redirect()
            ->route('dinamica/create')
            ->withErrors(['errors' => 'Erro ao cadastrar!'])
            ->withInput()
            ->render();
    }

    public function show($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $dinamica = $this->dinamica->find($id);
        $conversas = Conversas::pluck('nome_conversa');

        return $theme->of('dinamica.show', ['conversas' => $conversas, 'dinamica' => $dinamica])->render();

    }

    public function edit($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $dinamica = $this->dinamica->find($id);
        $conversas = Conversas::pluck('nome_conversa');


        return $theme->of('dinamica.edit', ['conversas' => $conversas, 'dinamica' => $dinamica ])->render();
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::uses('user')->layout('user');

        $dinamica = $this->dinamica->find($id);
        $dataForm = $request->all();
        $parte_1 = $dataForm['parte_1'];
        $nome_classe = $dataForm['nome_classe'];


        //Verificar se a classe já existe
        $busca = $this->dinamica
            ->where('nome_classe', '=', $nome_classe )
            ->where('id', '<>', $id)
            ->get()->first();
            if($busca != null){
                return redirect()
                    ->route('dinamica.create')
                    ->withErrors(['errors' => 'Está dinamica nao pode ser atualizada!'])
                    ->withInput();
            }

        //Restante das informações para criar dinamica
        $parte_2 = ' extends Conversation { ' ;

        $conversa_ordens = Conversas::where('nome_conversa', '=', $nome_classe)
        ->selectRaw("CONCAT(parte_1,pergunta,parte_2,resposta,parte_3,nome_prox,parte_4) AS funcao")->pluck('funcao')->toArray();
        
        $conversa_ordem = implode(" ", $conversa_ordens);

        $conversa_ordem;

        $final = ' } ';

        //Alterar 
        $update = $dinamica->update([
            'parte_1' => $parte_1,
            'nome_classe' => $nome_classe,
            'parte_2' => $parte_2,
            'conversa_ordem' => $conversa_ordem,
            'final' => $final,
        ]);
        if($update){
            return redirect()
                ->route('dinamica.edit', $id)
                ->withErrors(['errors' => 'dinamica atualizada!'])
                ->withInput();
            }
        else 
            return redirect()
                ->route('dinamica.edit', $id)
                ->withErrors(['errors' => 'Erro no Update'])
                ->withInput()
                ->render();

    }

    public function gerarClasse(Request $request)
    {

        $theme = Theme::uses('user')->layout('user');

        $dataForm = $request->all();
        $nome_classe = $dataForm['nome_classe'];

        $classeBD = Dinamica::where('nome_classe', '=', $nome_classe)
        ->value(DB::raw("CONCAT(parte_1,' ',nome_classe,' ',parte_2,' ',conversa_ordem,' ',final,' ')"));

        //Criar e reescrever arquivo 
        $file_handle = fopen('/var/www/html/lavalite (cópia)/app/Http/Conversations/OnboardingConversation.php', 'a+');
        fwrite($file_handle, $classeBD);
        fwrite($file_handle, "\n");
        fclose($file_handle);

        if($file_handle)
            return redirect()
                ->route('dinamica.index')
                ->with(['success' => 'Arquivo .php gerado com sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('dinamica.index', $id)
                ->with(['errors' => 'Erro ao gerar arquivo pp'])
                ->withInput();

    }

    public function destroy($id)
    {
        $theme = Theme::uses('user')->layout('user');

        $dinamica = $this->dinamica->find($id);
        $delete = $dinamica->delete();
        if($delete)
            return redirect()
                ->route('dinamica.index')
                ->with(['success' => 'Registro excluido com Sucesso'])
                ->withInput();
        
        else
            return redirect()
                ->route('dinamica.show', $id)
                ->with(['errors' => 'Erro ao Deletar'])
                ->withInput();

    }


}
