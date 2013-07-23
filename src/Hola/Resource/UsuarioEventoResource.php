<?php
namespace Hola\Resource;

use Hola\Service\EventoService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /:id/evento
 * @uri /:id/evento/:id_evento
 */
class UsuarioEventoResource extends Resource {

    private $eventoService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null, $id_evento = null) {
        if(is_null($id))
            throw new \Tonic\MethodNotAllowedException();
        try {
            $this->eventoService = new EventoService();
            if(is_null($id_evento))
                return new Response( Response::OK, $this->eventoService->search($id) );
            else
                return new Response( Response::OK, $this->eventoService->search($id,$id_evento) );

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\NotFoundException();
        }
    }

    /**
     * @method POST
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function criar($id = null) {
        if(!(isset($this->request->data->nome)
            &&isset($this->request->data->tipo)
            &&isset($this->request->data->usuario)))
            return new Response(Response::BADREQUEST);

        checkSessionUser::check($_SESSION['user']->getLogin(),$this->request->data->usuario);

        try {
            $this->eventoService = new EventoService();
            $this->eventoService->post(
                    $this->request->data->nome,
                    $this->request->data->descricao,
                    $this->request->data->data,
                    $this->request->data->hora,
                    $this->request->data->endereco,
                    $this->request->data->complemento,
                    $this->request->data->cidade,
                    $this->request->data->estado,
                    $this->request->data->cep,
                    $this->request->data->tipo,
                    $this->request->data->usuario
                    );
            $criada = $this->eventoService->search($this->request->data->usuario, $this->request->data->nome, $this->request->data->usuario)[0]->getId();

            unset($this->eventoService);
            return new Response(Response::CREATED, array('id' => $criada));

        } catch (RADUFU\DAO\Exception $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

    /**
     * @method PUT
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function atualizar($id = null) {
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();

        checkSessionUser::check($_SESSION['user']->getLogin(),$this->request->data->usuario);

        try {
            $this->eventoService = new EventoService();
            $this->eventoService->update(
                    $this->request->data->nome,
                    $this->request->data->descricao,
                    $this->request->data->data,
                    $this->request->data->hora,
                    $this->request->data->endereco,
                    $this->request->data->complemento,
                    $this->request->data->cidade,
                    $this->request->data->estado,
                    $this->request->data->cep,
                    $this->request->data->tipo,
                    $this->request->data->usuario,
                    $id
                    );

            unset($this->eventoService);
            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (RADUFU\DAO\DAO\Exception $e) {
            throw new Tonic\Exception($e->getMessage());
        }

    }

    /**
     * @method DELETE
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function remover($id = null) {
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();

        checkSessionUser::check($_SESSION['user']->getLogin(),$this->request->data->usuario);

        try {
            $this->eventoService = new EventoService();
            $this->eventoService->delete($id);

            unset($this->eventoService);
            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

    protected function json() {
        $this->before(function ($request) {
            if ($request->contentType == 'application/json') {
                $request->data = json_decode($request->data);
            }
        });

        $this->after(function ($response) {
         $response->contentType = 'application/json';
         $response->body = json_encode($response->body);
     });
    }
}

?>