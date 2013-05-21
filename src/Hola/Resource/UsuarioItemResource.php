<?php
namespace Hola\Resource;

use Hola\Service\ItemService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /:id/item
 * @uri /:id/item/:$id_item
 */
class UsuarioItemResource extends Resource {

    private $itemService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null, $id_item = null) {
        if(is_null($id))
            throw new \Tonic\MethodNotAllowedException();
        try {
            $this->itemService = new ItemService();
            if(is_null($id_item))
                return new Response( Response::OK, $this->itemService->searchUser($id) );
            else
                return new Response( Response::OK, $this->itemService->searchUser($id,$id_item) );

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