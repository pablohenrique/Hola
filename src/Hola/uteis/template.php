<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\,
    Hola\DAO\IDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class DAO implements IDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO  VALUES(DEFAULT,:_nome);';
	const SQL_GET = 'SELECT * FROM  WHERE _id = :_id;';
	const SQL_GETALL = 'SELECT * FROM ;';
	const SQL_READ = 'SELECT * FROM  WHERE _nome = :_nome;';
	const SQL_UPDATE = 'UPDATE  SET _nome = :_nome WHERE _id = :_id;';
	const SQL_DELETE = 'DELETE FROM  WHERE _id = :_id;';

	/*MORE DEFINITIONS*/

	/*FUNCTIONS FOR IDAO*/
	public function post( $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(array(':_nome' => $input->getNome()));
            
            if(!$result)
                throw new Exception(" não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar : " . $ex->getMessage());
        }
	}

	public function get($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->bindParam(':_id',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result){
				$ = new ();
				$->setId($result['_id']);
				$->setNome($result['_nome']);

				unset($stm,$result);
				return $;
			}

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] : " . $ex->getMessage());
		}
	}

	public function getAll(){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->execute();
			$Array = array();

			while($result = $stm->fetch(PDO::FETCH_ASSOC)){
				$ = new ();
				$->setId($result['_id']);
				$->setNome($result['_nome']);

				$Array[] = $;
			}

			unset($,$stm,$result);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] : " . $ex->getMessage());
		}
	}

	public function read($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->bindParam(':_nome',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result){
				$ = new ();
				$->setId($result['_id']);
				$->setNome($result['_nome']);

				unset($stm,$result);
				return $;
			}

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] : " . $ex->getMessage());
		}
	}

	public function update( $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
			$stm->execute(array(
					'_id' => $input->getId(),
					'_nome' => $input->getNome()
				));

			if(!$stm->rowCount() > 0)
                throw new Exception(" não foi atualizado:\t"
                    . $stm->errorInfo()[2]);
		} catch(PDOException $ex){
			throw new Exception("Ao atualizar : " . $ex->getMessage());
		}
	}

	public function delete($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
			$stm->bindParam(':_id',$input);
			$stm->execute();

			if(!$stm->rowCount() > 0)
                throw new Exception(" não foi deletado:\t"
                    . $stm->errorInfo()[2]);

			unset($stm,$result);

		} catch(PDOException $ex){
			throw new Exception("Ao deletar : " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$ = new ();
		$->setId($resultSet['_id']);
		return $;
	}

	private function setObjectTemplate($input){
		return array(
			':_login' => $input->getLogin(),
		);
	}

}

?>