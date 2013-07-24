<?php
/*
 * Esta parte foi parada devido a uma mudanca no Hola. Sera continuada quando sair da versao alpha.
*/
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
	const SQL_POST = 'INSERT INTO TipoItem VALUES(:tipoitem_item,:tipoitem_tipo);';
	const SQL_GET = 'SELECT * FROM TipoItem WHERE tipoitem_item = :tipoitem_item AND tipoitem_tipo = :tipoitem_tipo;';
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
            			':tipoitem_item' => $input->getItem()->getId(),
            			':tipoitem_tipo' => $input->getTipo()->getId()
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
						':tipoitem_item' => $input,
						':tipoitem_tipo' => $param
						));

			$Array = array();
			$this->usuariodao = new UsuarioDAO();
			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($this->usuariodao);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] TipoItem: " . $ex->getMessage());
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

			unset($this->usuariodao);
			return $Array;

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

			$Array = array();
			$this->usuariodao = new UsuarioDAO();
			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($this->usuariodao);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] TipoItem: " . $ex->getMessage());
		}
	}

	public function seek($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_SEEK);
			$stm->bindParam(':item_usuario',$input);
			$stm->execute();

			$Array = array();
			$this->usuariodao = new UsuarioDAO();
			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$Array[] = self::createObjectTemplate($result);

			unset($this->usuariodao);
			return $Array;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [SEEK] TipoItem: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$tipoitem = new TipoItem();

		$tipo = new Tipo();
		$tipo->setId($resultSet['tipoitem_item']);
		$tipo->setNome($resultSet['tipo_nome']);

		$item = new Item();
		$item->setId($resultSet['tipoitem_tipo']);
		$item->setNome($resultSet['item_nome']);

		if(!is_null($resultSet['item_usuario']))
			$item->setUsuario($this->usuariodao->get($resultSet['item_usuario']));

		$tipoitem->setTipo($tipo);
		$tipoitem->setItem($item);

		unset($tipo,$item);
		return $tipoitem;
	}

}

?>