<?php
/*
 * Esta parte foi parada devido a uma mudanca no Hola. Sera continuada quando sair da versao alpha.
*/
namespace Hola\Resource;

use Hola\Service\ItemService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /item
 * @uri /item/:id
 */
class ItemResource extends Resource {

    private $itemService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->itemService = new ItemService();
            if(is_null($id))
                return new Response(Response::OK, $this->itemService->search());
            else
                return new Response(Response::OK, $this->itemService->search($id));

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
    public function criar($id = null) {
        if(!(isset($this->request->data->nome)))
            return new Response(Response::BADREQUEST);

        try {
            $this->itemService = new ItemService();
            $this->itemService->post(
                    $this->request->data->nome,
                    $this->request->data->usuario
                    );
            
            $criada = $this->itemService->search($this->request->data->nome)[0]->getId();

            unset($this->itemService);
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
            $this->itemService = new ItemService();
            $this->itemService->update(
                    $this->request->data->nome,
                    $this->request->data->usuario,
                    $id
                    );

            unset($this->itemService);
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
            $this->itemService = new ItemService();
            $this->itemService->delete($id);

            unset($this->itemService);
            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
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
