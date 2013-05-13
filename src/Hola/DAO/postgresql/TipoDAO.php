<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\Tipo,
    Hola\DAO\ITipoDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class TipoDAO implements ITipoDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO Tipo VALUES(DEFAULT,:tipo_nome);';
	const SQL_GET = 'SELECT * FROM Tipo WHERE tipo_id = :tipo_id;';
	const SQL_GETALL = 'SELECT * FROM Tipo;';
	const SQL_READ = 'SELECT * FROM Tipo WHERE tipo_nome = :tipo_nome;';
	const SQL_UPDATE = 'UPDATE Tipo SET tipo_nome = :tipo_nome WHERE tipo_id = :tipo_id;';
	const SQL_DELETE = 'DELETE FROM Tipo WHERE tipo_id = :tipo_id;';

	/*FUNCTIONS FOR IDAO*/
	public function post(Tipo $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(array(':tipo_nome' => $input->getNome()));
            
            if(!$result)
                throw new Exception("Tipo não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Tipo: " . $ex->getMessage());
        }
	}

	public function get($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->bindParam(':tipo_id',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result){
				$tipo = new Tipo();
				$tipo->setId($result['tipo_id']);
				$tipo->setNome($result['tipo_nome']);

				unset($stm,$result);
				return $tipo;
			}

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] Tipo: " . $ex->getMessage());
		}
	}

	public function getAll(){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->execute();
			$tipoArray = array();

			while($result = $stm->fetch(PDO::FETCH_ASSOC)){
				$tipo = new Tipo();
				$tipo->setId($result['tipo_id']);
				$tipo->setNome($result['tipo_nome']);

				$tipoArray[] = $tipo;
			}

			unset($tipo,$stm,$result);
			return $tipoArray;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] Tipo: " . $ex->getMessage());
		}
	}

	public function read($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->bindParam(':tipo_nome',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result){
				$tipo = new Tipo();
				$tipo->setId($result['tipo_id']);
				$tipo->setNome($result['tipo_nome']);

				unset($stm,$result);
				return $tipo;
			}

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] Tipo: " . $ex->getMessage());
		}
	}

	public function update(Tipo $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
			$stm->execute(array(
					'tipo_id' => $input->getId(),
					'tipo_nome' => $input->getNome()
				));

			if(!$stm->rowCount() > 0)
                throw new Exception("Tipo não foi atualizado:\t"
                    . $stm->errorInfo()[2]);
		} catch(PDOException $ex){
			throw new Exception("Ao atualizar Tipo: " . $ex->getMessage());
		}
	}

	public function delete($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
			$stm->bindParam(':tipo_id',$input);
			$stm->execute();

			if(!$stm->rowCount() > 0)
                throw new Exception("Tipo não foi deletado:\t"
                    . $stm->errorInfo()[2]);

			unset($stm,$result);

		} catch(PDOException $ex){
			throw new Exception("Ao deletar Tipo: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	#public function T($){}

}

?>