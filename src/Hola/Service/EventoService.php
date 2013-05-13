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

	private function createObject($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $usuario, $id = null){
		$this->usuarioservice = new UsuarioService();
		$this->tiposervice = new TipoService();
		$this->evento = new Evento();
		if(!is_null($id))
			$this->evento->setId($id);
		$this->evento->setNome($nome);
		$this->evento->setDescricao($descricao);
		$this->evento->setData($data);
		$this->evento->setHora($hora);
		$this->evento->setEndereco($endereco);
		$this->evento->setComplemento($complemento);
		$this->evento->setCidade($cidade);
		$this->evento->setEstado($estado);
		$this->evento->setCep($cep);
		$this->evento->setTipo($this->tiposervice->search($tipo));
		$this->evento->setUsuario($this->usuarioservice->search($usuario));
		return $this->evento;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getEventoDAO();
	}

	public function post($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $usuario, $id = null){
		$this->dao->post(self::createObject($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $usuario, $id));
		unset($this->evento,$this->usuarioservice,$this->tiposervice);
	}

	public function search($input = null){
		if(is_numeric($input)) // busca por id
			return $this->dao->get($input);
		if(!is_null($input)) // busca por nome
			return $this->dao->read($input);
		else //busca todos
			return $this->dao->getAll();
	}

	public function getUsuario($input){ // busca por usuario
		return $this->dao->seek($input);
	}

	public function update($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $usuario, $id){
		$this->dao->update(self::createObject($nome, $descricao, $data, $hora, $endereco, $complemento, $cidade, $estado, $cep, $tipo, $usuario, $id));
		unset($this->evento,$this->usuarioservice,$this->tiposervice);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>