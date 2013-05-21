<?php

namespace Hola\DAO;

use Hola\Model\Item;

interface IItemDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function post(Item $input);

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
	public function getAll();

	/**
	 *Busca todos os objetos no banco de dados
	 *@param
	 *@throws 
	 */
	public function readAll($usuario);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function read($input);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function seek($usuario, $input);

	/**
	 *Atualiza um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function update(Item $input);

	/**
	 *Deleta um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function delete($input);
}

?>