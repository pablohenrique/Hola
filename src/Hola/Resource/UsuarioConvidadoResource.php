<?php
namespace Hola\Resource;

use Hola\Service\ConvidadoService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /:id/convidado
 */
class UsuarioConvidadoResource extends Resource {

    private $convidadoService = null;

    private function checkCredentials($evento, $sessionUser){
        $evento = $convidadoService->getEvento($evento);
        checkSessionUser::check($sessionUser,$evento->getUsuario()->getLogin());
    }

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        if(is_null($id))
            throw new \Tonic\MethodNotAllowedException();
        try {
            $this->convidadoService = new ConvidadoService();
            return new Response( Response::OK, $this->convidadoService->getUsuario($id) );

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
        if(!(isset($this->request->data->tipo)
            &&isset($this->request->data->usuario)))
            return new Response(Response::BADREQUEST);

        try {
            self::checkCredentials($this->request->data->evento, $_SESSION['user']->getLogin());

            $this->convidadoService = new ConvidadoService();
            $this->convidadoService->post(
                    $this->request->data->sms,
                    $this->request->data->email,
                    $this->request->data->evento,
                    $this->request->data->usuario,
                    $this->request->data->twitter,
                    $this->request->data->facebook,
                    $this->request->data->status
                    );
            $criada = $this->convidadoService->search($this->request->data->usuario, $this->request->data->evento);

            unset($this->convidadoService);
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

        try {
            self::checkCredentials($this->request->data->evento, $_SESSION['user']->getLogin());

            $this->convidadoService = new ConvidadoService();
            $this->convidadoService->update(
                    $this->request->data->sms,
                    $this->request->data->email,
                    $this->request->data->evento,
                    $this->request->data->usuario,
                    $this->request->data->twitter,
                    $this->request->data->facebook,
                    $this->request->data->status,
                    $id
                    );

            unset($this->convidadoService);
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

        try {
            self::checkCredentials($this->request->data->evento, $_SESSION['user']->getLogin());
            
            $this->convidadoService = new ConvidadoService();
            $this->convidadoService->delete($id);

            unset($this->convidadoService);
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