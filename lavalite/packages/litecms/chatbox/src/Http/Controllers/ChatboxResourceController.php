<?php

namespace Litecms\Chatbox\Http\Controllers;

use Litepie\Http\Controllers\ResourceController;
use Litecms\Chatbox\Http\Requests\ChatboxRequest;
use Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface;
use Litecms\Chatbox\Models\Chatbox;

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

}
