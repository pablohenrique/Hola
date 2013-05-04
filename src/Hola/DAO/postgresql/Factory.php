<?php

namespace Hola\DAO\postgresql;

class Factory extends \RADUFU\DAO\Factory {

    public function getTipoDAO() { return new TipoDAO(); }
    public function getEventoDAO() { return new EventoDAO(); }
    public function getItemDAO() { return new ItemDAO(); }
    public function getTipagemItemDAO() { return new TipagemItemDAO(); }
    public function getUsuarioDAO() { return new UsuarioDAO(); }
    public function getConvidadosDAO() { return new ConvidadosDAO(); }

}

?>