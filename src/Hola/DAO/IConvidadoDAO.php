<?php

namespace Hola\DAO;

use Hola\Model\Convidado;

interface IConvidadoDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function post(Convidado $input);

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
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function seek($input);

	/**
	 *Atualiza um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function update(Convidado $input);

	/**
	 *Deleta um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function delete($input);
}

?>