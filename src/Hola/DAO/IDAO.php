<?php

namespace Hola\DAO;

#use Hola\Model\;

interface IDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function post($ObjectInput);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function get($input);

	/**
	 *Busca todos os objetos no banco de dados
	 *@param
	 *@throws 
	 */
	public function getAll($input);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function read($input);

	/**
	 *Atualiza um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function update($ObjectInput);

	/**
	 *Deleta um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function delete($input);
}

?>