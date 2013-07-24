<?php

namespace Hola\Model;

use \JsonSerializable;

class Evento implements JsonSerializable{

	private $id;
	private $nome;
	private $descricao;
	private $data;
	private $hora;
	private $endereco;
	private $complemento;
	private $cidade;
	private $estado;
	private $cep;
	private $tipo;
	private $status;
	private $usuario;

	public function __construct($id = null, $nome = null, $descricao = null, $data = null, $hora = null, $endereco = null, $complemento = null, $cidade = null, $estado = null, $cep = null, $tipo = null, $status = null, $usuario = null){
		if(!is_null($id))
			self::setId($id);
		self::setNome($nome);
		self::setDescricao($descricao);
		self::setData($data);
		self::setHora($hora);
		self::setEndereco($endereco);
		self::setComplemento($complemento);
		self::setCidade($cidade);
		self::setEstado($estado);
		self::setCep($cep);
		self::setStatus($status);
		self::setTipo($tipo);
		self::setUsuario($usuario);
	}

	private function converteData ($data) {
        return implode("/", array_reverse(explode("-", $data)));
    }

	/*GETTERS*/
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }
	public function getDescricao(){ return $this->descricao; }
	public function getData(){ return $this->data; }
	public function getHora(){ return $this->hora; }
	public function getEndereco(){ return $this->endereco; }
	public function getComplemento(){ return $this->complemento; }
	public function getCidade(){ return $this->cidade; }
	public function getEstado(){ return $this->estado; }
	public function getCep(){ return $this->cep; }
	public function getTipo(){ return $this->tipo; }
	public function getStatus(){ return $this->status; }
	public function getUsuario(){ return $this->usuario; }

	/*SETTERS*/
	public function setId($input){ $this->id = $input; }
	public function setNome($input){ $this->nome = $input; }
	public function setDescricao($input){ $this->descricao = $input; }
	public function setData($input){ $this->data = self::converteData($input); }
	public function setHora($input){ $this->hora = $input; }
	public function setEndereco($input){ $this->endereco = $input; }
	public function setComplemento($input){ $this->complemento = $input; }
	public function setCidade($input){ $this->cidade = $input; }
	public function setEstado($input){ $this->estado = $input; }
	public function setCep($input){ $this->cep = $input; }
	public function setTipo(Tipo $input){ $this->tipo = $input; }
	public function setStatus($input){ $this->status = $input; }
	public function setUsuario(Usuario $input){ $this->usuario = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'descricao' => $this->getDescricao(),
            'data' => $this->getData(),
            'hora' => $this->getHora(),
            'endereco' => $this->getEndereco(),
            'complemento' => $this->getComplemento(),
            'cidade' => $this->getCidade(),
            'estado' => $this->getEstado(),
            'cep' => $this->getCep(),
            'tipo' => $this->getTipo(),
            'status' => $this->getStatus(),
            'usuario' => $this->getUsuario()
        	];
    }

}

?>