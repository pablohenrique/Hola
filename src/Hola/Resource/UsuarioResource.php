<?php
namespace Hola\Resource;

use Hola\Service\UsuarioService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /
 * @uri /:id
 */
class UsuarioResource extends Resource {

    private $usuarioService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->usuarioService = new UsuarioService();
            return new Response(Response::OK, $this->usuarioService->search($id));

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }

    /**
     * @method PUT
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function atualizar($id = null) {
        if(!(isset($this->request->data->login)
            &&isset($this->request->data->email)
            &&isset($this->request->data->senha)))
            return new Response(Response::BADREQUEST);

        try {
            $this->usuarioService = new UsuarioService();
            $this->usuarioService->update(
                    $this->request->data->login,
                    $this->request->data->senha,
                    $this->request->data->email,
                    $this->request->data->celular,
                    $this->request->data->oauth_uid,
                    $this->request->data->oauth_provider,
                    $this->request->data->twitter_oauth_token,
                    $this->request->data->twitter_oauth_token_secret
                    );

            unset($this->usuarioService);
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
            $this->usuarioService = new UsuarioService();
            $this->usuarioService->delete($id);

            unset($this->usuarioService);
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
