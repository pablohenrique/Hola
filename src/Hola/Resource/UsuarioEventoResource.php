<?php
namespace Hola\Resource;

use Hola\Service\EventoService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /usuario/:id/evento
 * @uri /usuario/:id/evento/:$id_evento
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