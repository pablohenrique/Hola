<?php

namespace Hola\DAO;

use Hola\Model\Usuario;

interface IUsuarioDAO{
	/**
     * Insere o novo Usuario no BD
     * @param Usuario $Usuario
     * @throws DAOException
     */
    public function post(Usuario $input);

    /**
     * Recupera o Usuario a partir do id
     * @param type $id
     * @return Usuario
     * @throws DAOException
     */
    public function get($id);

    /**
     * Recupera o Usuario a partir do login
     * @param type $login
     * @return Usuario
     * @throws DAOException
     */
    public function read($login);

    /**
     * Recupera todas as Usuarioes
     * @return array Usuario
     * @throws DAOException
     */
    public function getAll();

    /**
     * Atualiza os atributos do Usuario no BD
     * @param Usuario $usuario
     * @throws DAOException
     */
    public function update(Usuario $usuario);

    /**
     * Remove o Usuario do BD
     * @param type $id
     * @throws DAOException
     */
    public function delete($id);
}

?>