<?php

namespace Hola\DAO;

use Hola\Model\Usuario;

interface IUsuarioDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function post(Usuario $input);

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
	public function update(Usuario $input);

	/**
	 *Deleta um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function delete($input);
}

?>