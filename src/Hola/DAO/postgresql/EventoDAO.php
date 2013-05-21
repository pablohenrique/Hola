<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\Evento,
    Hola\DAO\IEventoDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class EventoDAO implements IEventoDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO Evento VALUES(
						DEFAULT,
						:evento_nome,
						:evento_descricao,
						:evento_data,
						:evento_hora,
						:evento_cep,
						:evento_endereco,
						:evento_complemento,
						:evento_cidade,
						:evento_uf,
						:evento_tipo,
						:evento_usuario
						);';
	const SQL_GET = 'SELECT * FROM Evento WHERE evento_id = :evento_id ORDER BY evento_data DESC;';
	const SQL_GETALL = 'SELECT * FROM Evento WHERE evento_usuario = :evento_usuario ORDER BY evento_data DESC;';
	const SQL_READ = 'SELECT * FROM Evento WHERE evento_usuario = :evento_usuario AND evento_nome = :evento_nome ORDER BY evento_data DESC;';
	const SQL_SEEK = 'SELECT * FROM Evento WHERE evento_usuario = :evento_usuario AND evento_id = :evento_id ORDER BY evento_data DESC;';
	const SQL_UPDATE = 'UPDATE Evento SET
						evento_nome = :evento_nome,
						evento_descricao = :evento_descricao,
						evento_data = :evento_data,
						evento_hora = :evento_hora,
						evento_cep = :evento_cep,
						evento_endereco = :evento_endereco,
						evento_complemento = :evento_complemento,
						evento_cidade = :evento_cidade,
						evento_uf = :evento_uf,
						evento_tipo = :evento_tipo,
						evento_usuario = :evento_usuario
						WHERE evento_id = :evento_id;';
	const SQL_DELETE = 'DELETE FROM Evento WHERE evento_id = :evento_id;';

	/*MORE DEFINITIONS*/
	private $tipodao;
	private $usuariodao;

	/*FUNCTIONS FOR IDAO*/
	public function post(Evento $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(self::setObjectTemplate($input));
            
            if(!$result)
                throw new Exception("Evento não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Evento: " . $ex->getMessage());
        }
	}

	public function get($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->bindParam(':evento_id',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] Evento: " . $ex->getMessage());
		}
	}

	public function getAll($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->bindParam(':evento_usuario',$input);
			$stm->execute();
			$Array = array();

			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($stm,$result);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] Evento: " . $ex->getMessage());
		}
	}

	public function read($usuario, $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->execute(array(
					':evento_usuario'=> $usuario,
					':evento_nome' => $input
					));
			$Array = array();

			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);
			
			unset($stm,$result);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] Evento: " . $ex->getMessage());
		}
	}

	public function seek($usuario, $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_SEEK);
			$stm->execute(array(
					':evento_usuario'=> $usuario,
					':evento_id' => $input
					));

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [SEEK] Evento: " . $ex->getMessage());
		}
	}

	public function update(Evento $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
			$stm->execute(self::setObjectTemplate($input));

			if(!$stm->rowCount() > 0)
                throw new Exception("Evento não foi atualizado:\t"
                    . $stm->errorInfo()[2]);
		} catch(PDOException $ex){
			throw new Exception("Ao atualizar Evento: " . $ex->getMessage());
		}
	}

	public function delete($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
			$stm->bindParam(':evento_id',$input);
			$stm->execute();

			if(!$stm->rowCount() > 0)
                throw new Exception("Evento não foi deletado:\t"
                    . $stm->errorInfo()[2]);

			unset($stm,$result);

		} catch(PDOException $ex){
			throw new Exception("Ao deletar Evento: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$evento = new Evento();
		$evento->setId($resultSet['evento_id']);
		$evento->setNome($resultSet['evento_nome']);
		$evento->setDescricao($resultSet['evento_descricao']);
		$evento->setData($resultSet['evento_data']);
		$evento->setHora($resultSet['evento_hora']);
		$evento->setCep($resultSet['evento_cep']);
		$evento->setEndereco($resultSet['evento_endereco']);
		$evento->setComplemento($resultSet['evento_complemento']);
		$evento->setCidade($resultSet['evento_cidade']);
		$evento->setEstado($resultSet['evento_uf']);
		$this->tipodao = new TipoDAO();
		$evento->setTipo($this->tipodao->get($resultSet['evento_tipo']));
		$this->usuariodao = new UsuarioDAO();
		$evento->setUsuario($this->usuariodao->get($resultSet['evento_usuario']));

		unset($this->tipodao, $this->usuariodao);

		return $evento;
	}

	private function setObjectTemplate($input){
		$Array = array(
			':evento_nome' => $input->getNome(),
			':evento_descricao' => $input->getDescricao(),
			':evento_data' => $input->getData(),
			':evento_hora' => $input->getHora(),
			':evento_cep' => $input->getCep(),
			':evento_endereco' => $input->getEndereco(),
			':evento_complemento' => $input->getComplemento(),
			':evento_cidade' => $input->getCidade(),
			':evento_uf' => $input->getEstado()
		);
		if(!is_null($input->getId()))
			$Array[':evento_id'] = $input->getId();
		if(!is_null($input->getTipo()))
			$Array[':evento_tipo'] = $input->getTipo()->getId();
		if(!is_null($input->getUsuario()))
			$Array[':evento_usuario'] = $input->getUsuario()->getId();

		return $Array;
	}

}

?>