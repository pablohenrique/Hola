<?php

namespace Hola\Model;

use \JsonSerializable;

class Convidado implements JsonSerializable{

	private $id;
	private $sms;
	private $email;
	private $evento;
	private $usuario;
	private $twitter;
	private $facebook;
	private $status;

 	public function __construct($id = null, $sms = null, $email = null, $twitter = null, $facebook = null, $status = null, $evento = null, $usuario = null){
		if(!is_null($id))
			self::setId($id);
		self::setSms($sms);
		self::setEmail($email);
		self::setTwitter($twitter);
		self::setFacebook($facebook);
		self::setStatus($status);
		self::setEvento($evento);
		self::setUsuario($usuario);
	}

	/*GETTERS*/
	public function getId(){ return $this->id; }
	public function getSms(){ return $this->sms; }
	public function getEmail(){ return $this->email; }
	public function getEvento(){ return $this->evento; }
	public function getUsuario(){ return $this->usuario; }
	public function getTwitter(){ return $this->twitter; }
	public function getFacebook(){ return $this->facebook; }
	public function getStatus(){ return $this->status; }

	/*SETTERS*/
	public function setId($input){ $this->id = $input; }
	public function setSms($input){ $this->sms = $input; }
	public function setEmail($input){ $this->email = $input; }
	public function setEvento(Evento $input){ $this->evento = $input; }
	public function setUsuario(Usuario $input){ $this->usuario = $input; }
	public function setTwitter($input){ $this->twitter = $input; }
	public function setFacebook($input){ $this->facebook = $input; }
	public function setStatus($input){ $this->status = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'sms' => $this->getSms(),
            'email' => $this->getEmail(),
            'evento' => $this->getEvento(),
            'usuario' => $this->getUsuario(),
            'twitter' => $this->getTwitter(),
            'facebook' => $this->getFacebook(),
            'status' => $this->getStatus()
        	];
    }

}

?>