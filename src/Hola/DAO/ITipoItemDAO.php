<?php

namespace Hola\DAO;

use Hola\Model\TipoItem;

interface ITipoItemDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function post(TipoItem $input);

	/**
	 *Busca todos os objetos no banco de dados
	 *@param
	 *@throws 
	 */
	public function get($input,$param);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function getAll();

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function read($input,$param);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function seek($input);
}

?>