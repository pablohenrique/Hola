<?php

namespace Hola\DAO;

use Hola\Model\Tipo;

interface ITipoDAO{
	/**
	 *Insere um objeto no banco de dados
	 *@param Tipo $input
	 *@throws Exception
	 */
	public function post(Tipo $input);

	/**
	 *Busca um objeto no banco de dados
	 *@param int $input
	 *@throws Exception
	 */
	public function get($input);

	/**
	 *Busca todos os objetos no banco de dados
	 *@throws Exception
	 */
	public function getAll();

	/**
	 *Busca um objeto no banco de dados
	 *@param string $input
	 *@throws Exception
	 */
	public function read($input);

	/**
	 *Atualiza um objeto no banco de dados
	 *@param Tipo $input
	 *@throws Exception
	 */
	public function update(Tipo $input);

	/**
	 *Deleta um objeto no banco de dados
	 *@param int $input
	 *@throws Exception
	 */
	public function delete($input);
}

?>