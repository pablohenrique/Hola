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

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getConvidadoDAO();
	}

 	private function createObject($sms, $email, $evento, $usuario, $twitter, $facebook, $status, $id = null){
		$this->usuarioservice = new UsuarioService();
		$this->eventoservice = new EventoService();
		$this->convidado = new Convidado($id, $sms, $email, $twitter, $facebook, $status, $this->eventoservice->search($evento), $this->usuarioservice->search($usuario));
		return $this->convidado;
	}

	public function post($sms, $email, $evento, $usuario, $twitter, $facebook, $status, $id = null){
		$this->dao->post(self::createObject(Security::preventXSS($sms), Security::preventXSS($email), Security::preventXSS($evento), Security::filterCharacters($usuario), Security::preventXSS($twitter), Security::preventXSS($facebook), Security::filterNumbers($status), Security::filterNumbers($id)));
		unset($this->convidado,$this->eventoservice,$this->usuarioservice);
	}

	public function getEvento($input){
		return $this->dao->read(Security::filterNumbers($input));
	}

	public function getUsuario($input){
		return $this->dao->seek(Security::filterCharacters($input));
	}

	public function search($usuario, $evento){
		$evento = Security::filterNumbers($evento);
		$usuario = Security::filterCharacters($usuario);
		$output = self::getEvento($evento);
		foreach ($output as $value)
			if($value->getUsuario->getLogin() == $usuario)
				return $value->getId();
		return null;
	}

	public function update($sms, $email, $evento, $usuario, $twitter, $facebook, $status, $id){
		$this->dao->update(self::createObject(Security::preventXSS($sms), Security::preventXSS($email), Security::preventXSS($evento), Security::filterCharacters($usuario), Security::preventXSS($twitter), Security::preventXSS($facebook), Security::filterNumbers($status), Security::filterNumbers($id)));
		unset($this->convidado,$this->eventoservice,$this->usuarioservice);
	}

	public function delete($input){
		$this->dao->delete(Security::filterNumbers($input));
	}

}

?>