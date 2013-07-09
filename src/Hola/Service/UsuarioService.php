<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\UsuarioDAO,
	Hola\Model\Usuario;

class UsuarioService {

	private $dao;
	private $usuario;

	private function createObject($login, $senha, $email, $celular, $oauth_uid, $oauth_provider, $twitter_oauth_token, $twitter_oauth_token_secret){
		$this->usuario = new Usuario();
		$this->usuario->setLogin($login);
		$this->usuario->setSenha($senha);
		$this->usuario->setEmail($email);
		$this->usuario->setCelular($celular);
		$this->usuario->setOauthId($oauth_uid);
		$this->usuario->setOauthProvider($oauth_provider);
		$this->usuario->setTwitterOauthToken($twitter_oauth_token);
		$this->usuario->setTwitterOauthTokenSecret($twitter_oauth_token_secret);
		return $this->usuario;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getUsuarioDAO();
	}

	public function post($login, $senha, $email, $celular, $oauth_uid, $oauth_provider, $twitter_oauth_token, $twitter_oauth_token_secret){
		if($login == $senha)
			throw new Exception("Login and Password MUST be NOT equal.");
		$this->dao->post(self::createObject(Security::filterCharacters($login), Security::filterCharacters($senha), Security::preventXSS($email), Security::preventXSS($celular), Security::preventXSS($oauth_uid), Security::preventXSS($oauth_provider), Security::preventXSS($twitter_oauth_token), Security::preventXSS($twitter_oauth_token_secret)));
		unset($this->usuario);
	}

	public function search($input = null){
		if(!is_null($input))
			return $this->dao->get($input);
		else
			return $this->dao->getAll();
	}

	public function update($login, $senha, $email, $celular, $oauth_uid, $oauth_provider, $twitter_oauth_token, $twitter_oauth_token_secret){
		if($login == $senha)
			throw new Exception("Login and Password MUST be NOT equal.");
		$this->dao->update(self::createObject(Security::filterCharacters($login), Security::filterCharacters($senha), Security::preventXSS($email), Security::preventXSS($celular), Security::preventXSS($oauth_uid), Security::preventXSS($oauth_provider), Security::preventXSS($twitter_oauth_token), Security::preventXSS($twitter_oauth_token_secret)));
		unset($this->usuario);
	}

	public function delete($input){
		$this->dao->delete(Security::filterCharacters($input));
	}

	public function login($login,$senha){
		if($this->dao->login(Security::filterCharacters($login),Security::filterCharacters($senha)) == 1)
			return self::search(Security::filterCharacters($login));
		else
			return null;
	}

}

?>