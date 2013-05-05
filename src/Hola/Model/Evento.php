<?php

namespace Hola\Model;

class Evento implements IModel{

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
	private $usuario;

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
	public function getUsuario(){ return $this->usuario; }

	/*SETTERS*/
	public function setId($input){ $this->id = $input; }
	public function setNome($input){ $this->nome = $input; }
	public function setDescricao($input){ $this->descricao = $input; }
	public function setData($input){ $this->data = $input; }
	public function setHora($input){ $this->hora = $input; }
	public function setEndereco($input){ $this->endereco = $input; }
	public function setComplemento($input){ $this->complemento = $input; }
	public function setCidade($input){ $this->cidade = $input; }
	public function setEstado($input){ $this->estado = $input; }
	public function setCep($input){ $this->cep = $input; }
	public function setTipo(Tipo $input){ $this->tipo = $input; }
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
            'usuario' => $this->getUsuario()
        	];
    }

}

?>