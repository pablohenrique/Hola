<?php

namespace Hola\DAO;

abstract class Factory {

    const PGSQL = 1;

    public abstract function getTipoDAO();

    public abstract function getEventoDAO();

    public abstract function getItemDAO();

    public abstract function getTipoItemDAO();

    public abstract function getUsuarioDAO();

    public abstract function getConvidadoDAO();

    public static function getFactory($factory) {
        switch ($factory){
            case (self::PGSQL):
                return new postgresql\Factory();
            default:
                return null;
        }
    }

}

?>