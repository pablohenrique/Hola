<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\ConvidadoDAO,
	Hola\Model\Convidado;

class ConvidadoService {

	private $dao;
	private $convidado;
	private $usuarioservice;
	private $eventoservice;

 	private function createObject($sms, $email, $evento, $usuario, $twitter, $facebook, $id = null){
		$this->usuarioservice = new UsuarioService();
		$this->eventoservice = new EventoService();
		$this->convidado = new Convidado();
		if(!is_null($id))
			$this->convidado->setId($id);
		$this->convidado->setSms($sms);
		$this->convidado->setEmail($email);
		$this->convidado->setTwitter($twitter);
		$this->convidado->setFacebook($facebook);
		$this->convidado->setEvento($this->eventoservice->search($evento));
		$this->convidado->setUsuario($this->usuarioservice->search($usuario));
		return $this->convidado;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getConvidadoDAO();
	}

	public function post($sms, $email, $evento, $usuario, $twitter, $facebook, $id = null){
		$this->dao->post(self::createObject($sms, $email, $evento, $usuario, $twitter, $facebook, $id));
		unset($this->convidado,$this->eventoservice,$this->usuarioservice);
	}

	public function search($input = null){
		if(is_numeric($input)) //busca por id
			return $this->dao->get($input);
		else //busca todos
			return $this->dao->getAll();
	}

	public function getEvento($input){
		return $this->dao->read($input);
	}

	public function getUsuario($input){ // busca por usuario
		return $this->dao->seek($input);
	}

	public function update($sms, $email, $evento, $usuario, $twitter, $facebook, $id){
		$this->dao->update(self::createObject($sms, $email, $evento, $usuario, $twitter, $facebook, $id));
		unset($this->convidado,$this->eventoservice,$this->usuarioservice);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>