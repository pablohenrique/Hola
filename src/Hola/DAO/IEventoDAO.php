<?php

namespace Hola\DAO;

use Hola\Model\Evento;

interface IEventoDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function post(Evento $input);

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
	public function read($usuario,$input);

	/**
	 *Busca um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function seek($usuario,$input);

	/**
	 *Atualiza um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function update(Evento $input);

	/**
	 *Deleta um objeto no banco de dados
	 *@param
	 *@throws 
	 */
	public function delete($input);
}

?>