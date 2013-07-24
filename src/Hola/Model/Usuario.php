<?php

namespace Hola\Model;

use \JsonSerializable;

class Usuario implements JsonSerializable{

	private $login;
	private $senha;
	private $email;
	private $celular;
	private $oauth_uid;
	private $oauth_provider;
	private $twitter_oauth_token;
	private $twitter_oauth_token_secret;

	public function __construct($login = null, $senha = null, $email = null, $celular = null, $oauth_uid = null, $oauth_provider = null, $twitter_oauth_token = null, $twitter_oauth_token_secret = null){
		self::setLogin($login);
		self::setSenha($senha);
		self::setEmail($email);
		self::setCelular($celular);
		self::setOauthId($oauth_uid);
		self::setOauthProvider($oauth_provider);
		self::setTwitterOauthToken($twitter_oauth_token);
		self::setTwitterOauthTokenSecret($twitter_oauth_token_secret);
	}

	/*GETTERS*/
	public function getLogin(){ return $this->login; }
	public function getSenha(){ return $this->senha; }
	public function getEmail(){ return $this->email; }
	public function getCelular(){ return $this->celular; }
	public function getOauthId(){ return $this->oauth_uid; }
	public function getOauthProvider(){ return $this->oauth_provider; }
	public function getTwitterOauthToken(){ return $this->twitter_oauth_token; }
	public function getTwitterOauthTokenSecret(){ return $this->twitter_oauth_token_secret; }

	/*SETTERS*/
	public function setLogin($input){ $this->login = $input; }
	public function setSenha($input){ $this->senha = $input; }
	public function setEmail($input){ $this->email = $input; }
	public function setCelular($input){ $this->celular = $input; }
	public function setOauthId($input){ $this->oauth_uid = $input; }
	public function setOauthProvider($input){ $this->oauth_provider = $input; }
	public function setTwitterOauthToken($input){ $this->twitter_oauth_token = $input; }
	public function setTwitterOauthTokenSecret($input){ $this->twitter_oauth_token_secret = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'login' => $this->getLogin(),
            'senha' => $this->getSenha(),
            'email' => $this->getEmail(),
            'celular' => $this->getCelular(),
            'oauthUid' => $this->getOauthId(),
            'oauthProvider' => $this->getOauthProvider(),
            'twitterOauthToken' => $this->getTwitterOauthToken(),
            'twitterOauthTokenSecret' => $this->getTwitterOauthTokenSecret()
        	];
    }

}

?>