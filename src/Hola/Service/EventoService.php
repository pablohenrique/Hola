<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\EventoDAO,
	Hola\Model\Evento;

class EventoService {

	private $dao;
	private $evento;
	private $usuarioservice;
	private $tiposervice;

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getEventoDAO();
	}

	private function createObject($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $status, $usuario, $id = null){
		$this->usuarioservice = new UsuarioService();
		$this->tiposervice = new TipoService();
		$this->evento = new Evento($id, $nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $this->tiposervice->search($tipo), $status, $this->usuarioservice->search($usuario));
		return $this->evento;
	}

	public function post($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $status, $usuario, $id = null){
		$this->dao->post(self::createObject(Security::preventXSS($nome), Security::preventXSS($descricao), Security::preventXSS($data), Security::preventXSS($hora), Security::preventXSS($endereco), Security::preventXSS($complemento), Security::preventXSS($cidade), Security::preventXSS($estado), Security::preventXSS($cep), Security::preventXSS($tipo), Security::filterNumbers($status), Security::filterCharacters($usuario), Security::filterNumbers($id)));
		unset($this->evento,$this->usuarioservice,$this->tiposervice);
	}

	public function search($usuario, $input = null){
		if(is_null($input))
			return $this->dao->getAll(Security::filterCharacters($usuario));
		if(is_numeric($input))
			return $this->dao->seek(Security::filterCharacters($usuario), Security::filterNumbers($input));
		if(is_string($input))
			return $this->dao->read(Security::filterCharacters($usuario), Security::preventXSS($input));
	}

	public function update($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $status, $usuario, $id){
		$this->dao->update(self::createObject(Security::preventXSS($nome), Security::preventXSS($descricao), Security::preventXSS($data), Security::preventXSS($hora), Security::preventXSS($endereco), Security::preventXSS($complemento), Security::preventXSS($cidade), Security::preventXSS($estado), Security::preventXSS($cep), Security::preventXSS($tipo), Security::filterNumbers($status), Security::filterCharacters($usuario), Security::filterNumbers($id)));
		unset($this->evento,$this->usuarioservice,$this->tiposervice);
	}

	public function delete($input){
		$this->dao->delete(Security::filterNumbers($input));
	}

}

?>