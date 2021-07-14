<?php

namespace Litecms\Chatbox\Http\Controllers;

use Litepie\Http\Controllers\ResourceController;
use Litecms\Chatbox\Http\Requests\ChatboxRequest;
use Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface;
use Litecms\Chatbox\Models\Chatbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Resource controller class for Chatbox.
 */
class ChatboxResourceController extends ResourceController
{

    /**
     * Initialize Chatbox resource controller.
     *
     * @param type ChatboxRepositoryInterface $chatbox
     *
     * @return null
     */
    public function __construct(ChatboxRepositoryInterface $chatbox)
    {
        parent::__construct();
        $this->repository = $chatbox;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litecms\Chatbox\Repositories\Criteria\ChatboxResourceCriteria::class);
    }

    /**
     * Display a list of chatbox.
     *
     * @return Response
     */
    public function index(ChatboxRequest $request)
    {
        $chatboxLimit = $request->input('chatboxLimit', 10);
        $data = $this->repository
            ->setPresenter(\Litecms\Chatbox\Repositories\Presenter\ChatboxListPresenter::class)
            ->paginate($chatboxLimit);
        extract($data);
        $view = 'chatbox::chatbox.index';
        if ($request->ajax()) {
            $view = 'chatbox::chatbox.more';
        }
        return $this->response->setMetaTitle('Chatbox Conversa')
            ->view($view)
            ->data(compact('data', 'meta'))
            ->output();

    }

    /**
     * Display chatbox.
     *
     * @param Request $request
     * @param Model   $chatbox
     *
     * @return Response
     */
    public function show(ChatboxRequest $request, Chatbox $data)
    {
        if ($data->exists) {

            $view = 'chatbox::chatbox.show';
        } else {
            $view = 'chatbox::chatbox.new';
        }

        return $this->response
            ->setMetaTitle('Chatbox Mostrar Conversa')
            ->data(compact('data'))
            ->view($view)
            ->output();
    }

    /**
     * Show the form for creating a new chatbox.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(ChatboxRequest $request)
    {
        $data = $this->repository->newInstance([]);
        return $this->response
            ->setMetaTitle('Chatbox Criar Conversa')
            ->view('chatbox::chatbox.create', true)
            ->data(compact('data'))
            ->output();        
        
    }

    /**
     * Create new chatbox.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ChatboxRequest $request)
    {
        try {
            $attribute['user_id'] = user_id();
            $attribute['user_type'] = user_type();

            $conversa = $request->conversa;
            $tipo = $request->tipo;
            $nome = $request->nome;
            $ouvir = $request->ouvir;
            $validar = $request->validar;
            $pergunta = $request->pergunta;
            $resposta = $request->resposta;
            $nome_prox = $request->nome_prox;
            $upload_folder = $request->upload_folder;

            $count = count($request->tipo);

            for($i=0; $i< $count; $i++){
                if ($tipo[$i] == 'Pergunta'){
                    $attribute = array(
                        'conversa' => $conversa,
                        'tipo' => $tipo[$i],
                        'nome' => $nome[$i],
                        'validar' => $validar[$i],
                        'pergunta' => $pergunta[$i],
                        'resposta' => $resposta[$i],
                        'nome_prox' => $nome_prox[$i],
                    );
                }
                if ($tipo[$i] == 'Resposta'){
                    $attribute = array(
                        'conversa' => $conversa,
                        'tipo' => $tipo[$i],
                        'ouvir' => $ouvir[$i],
                        'nome' => $nome[$i],
                        'resposta' => $resposta[$i],
                        'nome_prox' => $nome_prox[$i],
                    );
                }
                if ($tipo[$i] == 'Anexo'){
                    $attribute = array(
                        'conversa' => $conversa,
                        'tipo' => $tipo[$i],
                        'nome' => $nome[$i],
                        'ouvir' => $ouvir[$i],
                        'pergunta' => $pergunta[$i],
                        'resposta' => $resposta[$i],
                        'nome_prox' => $nome_prox[$i],
                        'upload_folder' => $upload_folder                    
                        );
                }
                if ($tipo[$i] == 'Imagem'){
                    $attribute = array(
                        'conversa' => $conversa,
                        'tipo' => $tipo[$i],
                        'nome' => $nome[$i],
                        'ouvir' => $ouvir[$i],
                        'pergunta' => $pergunta[$i],
                        'resposta' => $resposta[$i],
                        'nome_prox' => $nome_prox[$i],
                        'upload_folder' => $upload_folder                    
                        );
                }

                /*
                Todos os request
                $attribute = array(
                    'conversa' => $conversa,
                    'tipo' => $tipo[$i],
                    'nome' => $nome[$i],
                    'ouvir' => $ouvir[$i],
                    'validar' => $validar[$i],
                    'pergunta' => $pergunta[$i],
                    'resposta' => $resposta[$i],
                    'nome_prox' => $nome_prox[$i],
                    'upload_folder' => $upload_folder[$i]                    
                );*/
                $data = $this->repository
                    ->setPresenter(\Litecms\Chatbox\Repositories\Presenter\ChatboxShowPresenter::class)
                    ->create($attribute);
                $data = current($data);
            }

            return $this->response->message("Conversa criada com sucesso")
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('chatbox/chatbox/' . $data['id']))
                ->redirect();
            } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->data(compact('data'))
                ->url(guard_url('chatbox/chatbox'))
                ->redirect();
        }
    }

    /**
     * Show chatbox for editing.
     *
     * @param Request $request
     * @param Model   $chatbox
     *
     * @return Response
     */
    public function edit(ChatboxRequest $request, Chatbox $data)
    {
        return $this->response->setMetaTitle('Chatbox Editar Conversa')
            ->view('chatbox::chatbox.edit')
            ->data(compact('data'))
            ->output();
    }

    /**
     * Update the chatbox.
     *
     * @param Request $request
     * @param Model   $chatbox
     *
     * @return Response
     */
    public function update(ChatboxRequest $request, Chatbox $chatbox)
    {
        try {
            $attribute = $request->all();
            $data = $this->repository
                ->setPresenter(\Litecms\Chatbox\Repositories\Presenter\ChatboxShowPresenter::class)
                ->update($attribute, $chatbox->getRouteKey());
            $data = current($data);
            return $this->response
                ->message("Conversa atualizada")
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('chatbox/chatbox/' . $chatbox->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response
                ->message($e->getMessage())
                ->data(compact('data'))
                ->code(400)
                ->status('error')
                ->url(guard_url('chatbox/chatbox/' . $chatbox->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the chatbox.
     *
     * @param Model   $chatbox
     *
     * @return Response
     */
    public function destroy(ChatboxRequest $request, Chatbox $chatbox)
    {
        try {
            $chatbox->delete();
            return $this->response->message('Conversa destruida')
                ->code(202)
                ->status('success')
                ->url(guard_url('chatbox/chatbox/'. $chatbox->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('chatbox/chatbox/' . $chatbox->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove multiple chatbox.
     *
     * @param Model   $chatbox
     *
     * @return Response
     */
    public function delete(ChatboxRequest $request, $type)
    {
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }
            return $this->response->message("Conversa deletada")
                ->status("success")
                ->code(202)
                ->url(guard_url('chatbox/chatbox'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('chatbox/chatbox'))
                ->redirect();
        }
    }

    /**
     * Restore deleted chatboxs.
     *
     * @param Model   $chatbox
     *
     * @return Response
     */
    public function restore(ChatboxRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);
            return $this->response->message("Conversa restaurada")
                ->status("success")
                ->code(202)
                ->url(guard_url('chatbox/chatbox'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('chatbox/chatbox/'))
                ->redirect();
        }
    }

    /**
     * Return the form elements in the for of json.
     *
     * @param String   $element
     *
     * @return json
     */
    public function form($element = 'fields')
    {
        $form = new \Litecms\Chatbox\Form\Chatbox();
        return $form->form($element, true);
    }

    public function gerarConversa()
    {
        $conversas = DB::table('chatboxs')->distinct()->pluck('conversa')->toArray();

        $count = count($conversas);

        for($i=0; $i< $count; $i++){

            $conversa  = DB::table('chatboxs')->select('*')->where('conversa', '=', $conversas[$i])->get()->toArray();

            $count2 = count($conversa);

            $funcao = '';

            for($a=0; $a< $count2; $a++){


                $nomeConversa = $conversa[$a]->conversa;
                $tipoFunc = $conversa[$a]->tipo;
                $nomeFunc = $conversa[$a]->nome;
                $ouvir = $conversa[$a]->ouvir;
                $validar = $conversa[$a]->validar;
                $pergunta = $conversa[$a]->pergunta;
                $resposta = $conversa[$a]->resposta;
                $nome_prox = $conversa[$a]->nome_prox;
                $file =  explode(',',$conversa[$a]->file);
                $file = trim($file[6], '"');
                $file = trim($file, '"');
                $file = explode(':' ,$file);
                $file = trim($file[1], '"');
                $file;
                $upload_folder = $conversa[$a]->upload_folder;

                if ($tipoFunc == 'Pergunta'){
                    if($validar == 'naovalidar'):
                    $funcao .= ' 
                    public function ask'.$nomeFunc.'()
                    {
                        $this->ask(\''.$pergunta.'\', function(Answer $answer) {
                            
                            $this->bot->userStorage()->save([
                                \'name\' => $answer->getText(),
                            ]);
                            
                            $this->name = $answer->getText();
                
                            $this->say(\''.$resposta.'\'. $answer->getText());
                            $this->ask'.$nome_prox.'();
                        });
                    }';

                    elseif($validar == 'cpf'):
                        $funcao .= ' 
                        public function ask'.$nomeFunc.'()
                        {
                            $this->ask(\''.$pergunta.'\', function(Answer $answer) {

                                $validator = Validator::make([\'Cpf\' => $answer->getText()], [
                                    \'Cpf\' => \'Cpf\',
                                ]);
                    
                                if ($validator->fails()) {
                                    return $this->repeat(\'Isso não parece ser um CPF válido. Por favor digite um numero de CPF válido.\');
                                }
                    
                                $this->bot->userStorage()->save([
                                    \'Cpf\' => $answer->getText(),
                                ]);
                                                                        
                                $this->say(\''.$resposta.'\'. $answer->getText());
                                $this->ask'.$nome_prox.'();
                            });
                        }';
                    
                    elseif($validar == 'email'):
                        $funcao .= ' 
                        public function ask'.$nomeFunc.'()
                        {
                            $this->ask(\''.$pergunta.'\', function(Answer $answer) {

                                $validator = Validator::make([\'email\' => $answer->getText()], [
                                    \'email\' => \'email\',
                                ]);
                    
                                if ($validator->fails()) {
                                    return $this->repeat(\'Isso não parece ser um e-mail válido. Por favor digite um email válido.\');
                                }
                    
                                $this->bot->userStorage()->save([
                                    \'email\' => $answer->getText(),
                                ]);
                                                                                            
                                $this->say(\''.$resposta.'\'. $answer->getText());
                                $this->ask'.$nome_prox.'();
                            });
                        }';
                    
                        elseif($validar == 'celular'):
                            $funcao .= ' 
                            public function ask'.$nomeFunc.'()
                        {
                            $this->ask(\''.$pergunta.'\', function(Answer $answer) {

                                $validator = Validator::make([\'mobile\' => $answer->getText()], [
                                    \'celular_com_ddd\' => \'celular_com_ddd\'
                                ]);
                    
                                if ($validator->fails()) {
                                    return $this->repeat(\'Isso não parece ser um numero de celular válido. Por favor digite um numero válido.\');
                                }
                                $this->bot->userStorage()->save([
                                    \'celular_com_ddd\' => $answer->getText(),
                                ]);
                                                                                                                
                                $this->say(\''.$resposta.'\'. $answer->getText());
                                $this->ask'.$nome_prox.'();
                            });
                        }';
                        endif;

                }elseif ($tipoFunc == "Resposta"){
                    $funcao .= ' 
                    public function ask'.$nomeFunc.'()
                    {
                        $this->ask(\''.$resposta.'\', function(Answer $answer) {

                            $this->ask'.$nome_prox.'();
                        });
                    }';

                }elseif ($tipoFunc == "Anexo"){

                    //$urlFile = url('/file/download')/$file["path"];
                    $urlFile = url($file);

                    $funcao .= ' 
                    public function ask'.$nomeFunc.'(BotMan $bot)
                    {
                        $attachment = new Image(\''.$urlFile.'\');

                        $message = OutgoingMessage::create(\''.$resposta.'\')
                                    ->withAttachment($attachment);
                    
                        $bot->reply($message);
                    }';

                }elseif ($tipoFunc == "Imagem"){
                    $urlFile = url($file);

                    $funcao .= ' 
                    public function ask'.$nomeFunc.'(BotMan $bot)
                    {
                        $attachment = new Image(\''.$urlFile.'\');

                        // Build message object
                        $message = OutgoingMessage::create(\'This is my text\')
                                    ->withAttachment($attachment);
                    
                        // Reply message object
                        $bot->reply($message);
                                        }';
                }
            }
        }

        $classInit = '<?php

        namespace App\Http\Conversations;
        
        use BotMan\BotMan\Messages\Conversations\Conversation;
        use Illuminate\Support\Facades\Validator;
        use Illuminate\Http\Request;
        use BotMan\BotMan\Messages\Incoming\Answer;
        use BotMan\BotMan\Messages\Outgoing\Question;
        use BotMan\BotMan\Messages\Outgoing\Actions\Button;
        use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
        use BotMan\BotMan\Messages\Attachments\Image;
        use BotMan\BotMan\Messages\Attachments\File;
        use BotMan\BotMan\Messages\Attachments\Audio;

        
        class '.$nomeConversa.'Conversation extends Conversation
        { 
            ';

        $classFinal = '    public function saveSimulacao() 
        {
            //Pegar conversa atual e salvar em variaveis
            $userStorage = $this->bot->userStorage()->find();
            $name = $userStorage->get(\'name\');
            '.($validar == 'cpf' ? '$Cpf = $userStorage->get(\'Cpf\');' : '').'
            '.($validar == 'email' ? '$email = $userStorage->get(\'email\');' : '').'
            '.($validar == 'celular_com_ddd' ? '$celular_com_ddd = $userStorage->get(\'celular_com_ddd\');' : '').'
            $ipAddr = $_SERVER["REMOTE_ADDR"];    
            //Save in database
            $simulacao = new SimulacaoEmprestimo;
            $simulacao->name = $name;
            '.($validar == 'cpf' ? '$simulacao->Cpf = $Cpf;' : '').'
            '.($validar == 'email' ? '$simulacao->email = $email;' : '').'
            '.($validar == 'celular_com_ddd' ? '$simulacao->celular_com_ddd = $celular_com_ddd;' : '').'            
            $simulacao->ip_address = $ipAddr;
            $simulacao->save();    
            //$this->bot->userStorage()->delete();
    
        }
    
        public function run()
        {
            $this->ask'.$nomeFunc[0].'();
        }
    }';

        $newConversa = $classInit.$funcao.$classFinal;

        //Criar e reescrever arquivo 
        $file_handle = fopen(url('app/Http/Conversations/'.$nomeConversa.'Conversation.php'), 'a+');

        fwrite($file_handle, $newConversa);
        fwrite($file_handle, "\n");
        fclose($file_handle);

        if($file_handle)
            return redirect()
                ->route('classes.index')
                ->with(['success' => 'Arquivo .php gerado com sucesso'])
                ->withInput();        
        else
            return redirect()
                ->route('classes.index')
                ->with(['errors' => 'Erro ao gerar arquivo pp'])
                ->withInput();
    }
}
