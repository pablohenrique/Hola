<?php
/*
 * Esta parte foi parada devido a uma mudanca no Hola. Sera continuada quando sair da versao alpha.
*/
namespace Hola\Resource;

use Hola\Service\TipoItemService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /tipo/:id/item/:id_item
 */
class TipoItemResource extends Resource {

    private $tipoItemService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null, $id_item = null) {
        try {
            $this->tipoItemService = new TipoItemService();
            if(is_null($id_item))
                return new Response(Response::OK, $this->tipoItemService->search($id));
            else
                return new Response(Response::OK, $this->tipoItemService->search($id,$id_item));

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }


    /**
     * @method POST
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function criar($id = null, $id_item = null) {
        if( !(isset($id)) && !(isset($id_item)) )
            return new Response(Response::BADREQUEST);

        try {
            $this->tipoItemService = new TipoItemService();
            $this->tipoItemService->post( $id, $id_item );

            unset($this->tipoItemService);
            //SE TIVER RETORNO, DEVERA RETORNAR AS DUAS IDS PASSADAS COMO ARGUMENTO.
            //return new Response(Response::CREATED, array('id' => $criada));

        } catch (RADUFU\DAO\Exception $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

    /**
     * Transforma as requisições json para array e as repostas array para json
     */
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
