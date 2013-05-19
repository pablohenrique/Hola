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

	/*GETTERS*/
	public function getId(){ return $this->id; }
	public function getSms(){ return $this->sms; }
	public function getEmail(){ return $this->email; }
	public function getEvento(){ return $this->evento; }
	public function getUsuario(){ return $this->usuario; }
	public function getTwitter(){ return $this->twitter; }
	public function getFacebook(){ return $this->facebook; }

	/*SETTERS*/
	public function setId($input){ $this->id = $input; }
	public function setSms($input){ $this->sms = $input; }
	public function setEmail($input){ $this->email = $input; }
	public function setEvento(Evento $input){ $this->evento = $input; }
	public function setUsuario(Usuario $input){ $this->usuario = $input; }
	public function setTwitter($input){ $this->twitter = $input; }
	public function setFacebook($input){ $this->facebook = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'sms' => $this->getSms(),
            'email' => $this->getEmail(),
            'evento' => $this->getEvento(),
            'usuario' => $this->getUsuario(),
            'twitter' => $this->getTwitter(),
            'facebook' => $this->getFacebook()
        	];
    }

}

?>