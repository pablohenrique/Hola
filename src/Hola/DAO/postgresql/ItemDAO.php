<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\Item,
    Hola\DAO\IItemDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class ItemDAO implements IItemDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO Item VALUES(DEFAULT,:item_nome,:item_usuario);';
	const SQL_GET = 'SELECT * FROM Item WHERE item_id = :item_id;';
	const SQL_GETALL = 'SELECT * FROM Item;';
	const SQL_READ = 'SELECT * FROM Item WHERE item_nome = :item_nome;';
	const SQL_UPDATE = 'UPDATE Item SET item_nome = :item_nome, item_usuario = :item_usuario WHERE item_id = :item_id;';
	const SQL_DELETE = 'DELETE FROM Item WHERE item_id = :item_id;';

	/*MORE DEFINITIONS*/
	private $usuariodao;

	/*FUNCTIONS FOR IDAO*/
	public function post(Item $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(self::setObjectTemplate($input));
            
            if(!$result)
                throw new Exception("Item não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Item:" . $ex->getMessage());
        }
	}

	public function get($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->bindParam(':item_id',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			$this->usuariodao = new UsuarioDAO();
			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] Item: " . $ex->getMessage());
		}
	}

	public function getAll(){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->execute();
			$Array = array();

			$this->usuariodao = new UsuarioDAO();
			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($stm,$result);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] Item: " . $ex->getMessage());
		}
	}

	public function read($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->bindParam(':item_nome',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			$this->usuariodao = new UsuarioDAO();
			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] Item: " . $ex->getMessage());
		}
	}

	public function update(Item $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
			$stm->execute(self::setObjectTemplate($input));

			if(!$stm->rowCount() > 0)
                throw new Exception("Item não foi atualizado:\t"
                    . $stm->errorInfo()[2]);
		} catch(PDOException $ex){
			throw new Exception("Ao atualizar Item: " . $ex->getMessage());
		}
	}

	public function delete($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
			$stm->bindParam(':item_id',$input);
			$stm->execute();

			if(!$stm->rowCount() > 0)
                throw new Exception("Item não foi deletado:\t"
                    . $stm->errorInfo()[2]);

			unset($stm,$result);

		} catch(PDOException $ex){
			throw new Exception("Ao deletar Item: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$item = new Item();
		$item->setId($resultSet['item_id']);
		$item->setNome($resultSet['item_nome']);

		if(!is_null($resultSet['item_usuario']))
			$item->setUsuario($this->usuariodao->get($resultSet['item_usuario']));
		
		unset($this->usuariodao);
		return $item;
	}

	private function setObjectTemplate($input){
		$Array = array(':item_nome' => $input->getNome());
		if(!is_null($input->getUsuario()))
			$Array[':item_usuario'] = $input->getUsuario()->getId();
		if(!is_null($input->getId()))
			$Array[':item_id'] = $input->getId();

		return $Array;
	}

}

?>