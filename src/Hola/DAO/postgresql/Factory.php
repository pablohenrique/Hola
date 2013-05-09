<?php

namespace Hola\DAO\postgresql;

class Factory extends \Hola\DAO\Factory {

    public function getTipoDAO() { return new TipoDAO(); }
    public function getEventoDAO() { return new EventoDAO(); }
    public function getItemDAO() { return new ItemDAO(); }
    public function getTipoItemDAO() { return new TipoItemDAO(); }
    public function getUsuarioDAO() { return new UsuarioDAO(); }
    public function getConvidadoDAO() { return new ConvidadoDAO(); }

}

?>