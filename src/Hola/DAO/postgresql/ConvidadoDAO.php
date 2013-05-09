<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\Convidado,
    Hola\DAO\IConvidadoDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class ConvidadoDAO implements IConvidadoDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO Convidado VALUES(
					DEFAULT,
					:convidado_evento,
					:convidado_usuario,
					:convidado_sms,
					:convidado_email,
					:convidado_facebook,
					:convidado_twitter
					);';
	const SQL_GET = 'SELECT * FROM Convidado WHERE convidado_id = :convidado_id;';
	const SQL_GETALL = 'SELECT * FROM Convidado;';
	const SQL_READ = 'SELECT * FROM Convidado WHERE convidado_evento = :convidado_evento;';
	const SQL_SEEK = 'SELECT * FROM Convidado WHERE convidado_usuario = :convidado_usuario;';
	const SQL_UPDATE = 'UPDATE Convidado SET 
					convidado_evento = :convidado_evento,
					convidado_usuario = :convidado_usuario,
					convidado_sms = :convidado_sms,
					convidado_email = :convidado_email,
					convidado_facebook = :convidado_facebook,
					convidado_twitter = :convidado_twitter
					WHERE convidado_id = :convidado_id;';
	const SQL_DELETE = 'DELETE FROM Convidado WHERE convidado_id = :convidado_id;';

	/*MORE DEFINITIONS*/
	private $eventodao;
	private $usuariodao;

	/*FUNCTIONS FOR IDAO*/
	public function post(Convidado $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(self::setObjectTemplate($input));
            
            if(!$result)
                throw new Exception("Convidado não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Convidado: " . $ex->getMessage());
        }
	}

	public function get($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->bindParam(':convidado_id',$input);
			$stm->execute();

			$this->eventodao = new EventoDAO();
			$this->usuariodao = new UsuarioDAO();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result,$this->eventodao,$this->usuariodao);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] Convidado: " . $ex->getMessage());
		}
	}

	public function getAll(){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->execute();

			$Array = array();
			$this->eventodao = new EventoDAO();
			$this->usuariodao = new UsuarioDAO();

			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($stm,$result,$this->eventodao,$this->usuariodao);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] Convidado: " . $ex->getMessage());
		}
	}

	public function read($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->bindParam(':convidado_evento',$input);
			$stm->execute();

			$Array = array();
			$this->eventodao = new EventoDAO();
			$this->usuariodao = new UsuarioDAO();

			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($stm,$result,$this->eventodao,$this->usuariodao);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] Convidado: " . $ex->getMessage());
		}
	}

	public function seek($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_SEEK);
			$stm->bindParam(':convidado_usuario',$input);
			$stm->execute();

			$Array = array();
			$this->eventodao = new EventoDAO();
			$this->usuariodao = new UsuarioDAO();

			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($stm,$result,$this->eventodao,$this->usuariodao);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [SEEK] Convidado: " . $ex->getMessage());
		}
	}

	public function update(Convidado $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
			$stm->execute(self::setObjectTemplate($input));

			if(!$stm->rowCount() > 0)
                throw new Exception("Convidado não foi atualizado:\t"
                    . $stm->errorInfo()[2]);

		} catch(PDOException $ex){
			throw new Exception("Ao atualizar Convidado: " . $ex->getMessage());
		}
	}

	public function delete($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
			$stm->bindParam(':convidado_id',$input);
			$stm->execute();

			if(!$stm->rowCount() > 0)
                throw new Exception("Convidado não foi deletado:\t"
                    . $stm->errorInfo()[2]);

			unset($stm,$result);

		} catch(PDOException $ex){
			throw new Exception("Ao deletar Convidado: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$convidado = new Convidado();
		$convidado->setId($resultSet['convidado_id']);
		$convidado->setSms($resultSet['convidado_sms']);
		$convidado->setEmail($resultSet['convidado_email']);
		$convidado->setFacebook($resultSet['convidado_facebook']);
		$convidado->setTwitter($resultSet['convidado_twitter']);

		if(!is_null($resultSet['convidado_evento']))
			$convidado->setEvento($this->eventodao->get($resultSet['convidado_evento']));

		if(!is_null($resultSet['convidado_usuario']))
			$convidado->setUsuario($this->usuariodao->get($resultSet['convidado_usuario']));

		return $convidado;
	}
	
	private function setObjectTemplate($input){
		$Array = array(
			':convidado_evento' => $input->getEvento()->getId(),
			':convidado_usuario' => $input->getUsuario()->getId(),
			':convidado_sms' => $input->getSms(),
			':convidado_email' => $input->getEmail(),
			':convidado_facebook' => $input->getFacebook(),
			':convidado_twitter' => $input->getTwitter()
		);
		if(!is_null($input->getId()))
			$Array[':convidado_id'] = $input->getId();

		return $Array;
	}

}

?>