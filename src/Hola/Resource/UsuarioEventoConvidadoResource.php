<?php
namespace Hola\Resource;

use Hola\Service\ConvidadoService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /:id/evento/:$id_evento/convidado
 */
class UsuarioEventoConvidadoResource extends Resource {

    private $convidadoService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null, $id_evento = null) {
        if(is_null($id_evento))
            throw new \Tonic\MethodNotAllowedException();
        try {
            $this->convidadoService = new ConvidadoService();
            return new Response( Response::OK, $this->convidadoService->getEvento($id_evento) );

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