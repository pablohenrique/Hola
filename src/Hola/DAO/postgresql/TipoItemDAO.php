<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\Tipo,
	Hola\Model\Item,
	Hola\Model\TipoItem,
    Hola\DAO\ITipoItemDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class TipoItemDAO implements ITipoItemDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO TipagemItem VALUES(:tipo_id,:item_id);';
	const SQL_GET = 'SELECT * FROM TipoItem WHERE tipo_id = :tipo_id AND item_id = :item_id;';
	const SQL_GETALL = 'SELECT * FROM TipoItem;';
	const SQL_READ = 'SELECT * FROM TipoItem WHERE tipo_nome = :tipo_nome AND item_nome = :item_nome;';
	const SQL_SEEK = 'SELECT * FROM TipoItem WHERE item_usuario = :item_usuario;';

	/*MORE DEFINITIONS*/
	private $usuariodao;

	/*FUNCTIONS FOR IDAO*/
	public function post(TipoItem $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(array(
            			':tipo_id' => $input->getTipo()->getId(),
            			':item_id' => $input->getItem()->getId()
            			));
            
            if(!$result)
                throw new Exception("TipoItem não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar TipoItem: " . $ex->getMessage());
        }
	}

	public function get($input,$param){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->execute(array(
						':tipo_id' => $input,
						':item_id' => $param
						));

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			return createObjectTemplate($result);

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] TipoItem: " . $ex->getMessage());
		}
	}

	public function getAll(){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->execute();
			$result = $stm->fetch(PDO::FETCH_ASSOC)

			return createObjectTemplate($result);

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] TipoItem: " . $ex->getMessage());
		}
	}

	public function read($input,$param){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->execute(array(
						':tipo_nome' => $input,
						':item_nome' => $param
						));

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			return createObjectTemplate($result);

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] TipoItem: " . $ex->getMessage());
		}
	}

	public function seek($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_SEEK);
			$stm->bindParam(':item_usuario',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			return createObjectTemplate($result);

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [SEEK] TipoItem: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$Array = array();
		$this->usuariodao = new UsuarioDAO();
		
		while($resultSet){
			$tipoitem = new TipoItem();

			$tipo = new Tipo();
			$tipo->setId($resultSet['tipo_id']);
			$tipo->setNome($resultSet['tipo_nome']);

			$item = new Item();
			$item->setId($resultSet['item_id']);
			$item->setNome($resultSet['item_nome']);

			if(!is_null($resultSet['item_usuario']))
				$item->setUsuario($this->usuariodao->get($resultSet['item_usuario']));

			$tipoitem->setTipo($tipo);
			$tipoitem->setItem($item);
			$Array[] = $tipoitem;
		}

		unset($tipo,$item,$resultSet,$this->usuariodao);
		return $Array;
	}

}

?>