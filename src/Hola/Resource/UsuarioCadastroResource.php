<?php
namespace Hola\Resource;

use Hola\Service\UsuarioService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /usuario/
 * @uri /usuario/:login
 */
class UsuarioCadastroResource extends Resource {

    private $usuarioService = null;


    /**
     * @method POST
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function criar($login = null) {
        if(!(isset($login)
            &&isset($this->request->data->email)
            &&isset($this->request->data->senha)))
            return new Response(Response::BADREQUEST);

        try {
            $this->usuarioService = new UsuarioService();
            $this->usuarioService->post(
                    $login,
                    $this->request->data->senha,
                    $this->request->data->email,
                    $this->request->data->celular,
                    $this->request->data->oauthUid,
                    $this->request->data->oauthProvider,
                    $this->request->data->twitterOauthToken,
                    $this->request->data->twitterOauthTokenSecret
                    );
            $criada = $this->usuarioService->search($login)->getLogin();

            unset($this->usuarioService);
            return new Response(Response::CREATED, array('login' => $criada));

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
