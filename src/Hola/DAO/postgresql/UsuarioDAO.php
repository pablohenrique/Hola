<?php

namespace Hola\DAO\postgresql;

use \PDO,
	Hola\Model\Usuario,
    Hola\DAO\IUsuarioDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class UsuarioDAO implements IUsuarioDAO{

	/*DEFINITIONS FOR IDAO*/
	const SQL_POST = 'INSERT INTO Usuario VALUES(DEFAULT,:usuario_login,:oauth_uid,:oauth_provider,:twitter_oauth_token,:twitter_oauth_token_secret,:usuario_senha,:usuario_email,:usuario_celular);';
	const SQL_GET = 'SELECT * FROM Usuario WHERE usuario_id = :usuario_id;';
	const SQL_GETALL = 'SELECT * FROM Usuario;';
	const SQL_READ = 'SELECT * FROM Usuario WHERE usuario_login = :usuario_login;';
	const SQL_UPDATE = 'UPDATE Usuario SET 
						usuario_login = :usuario_login,
						oauth_uid = :oauth_uid,
						oauth_provider = :oauth_provider,
						twitter_oauth_token = :twitter_oauth_token,
						twitter_oauth_token_secret = :twitter_oauth_token_secret,
						usuario_senha = :usuario_senha,
						usuario_email = :usuario_email,
						usuario_celular = :usuario_celular
						WHERE usuario_id = :usuario_id;';
	const SQL_DELETE = 'DELETE FROM Usuario WHERE usuario_id = :usuario_id;';

	/*MORE DEFINITIONS*/


	/*FUNCTIONS FOR IDAO*/
	public function post(Usuario $input){
		try {
            $stm = Connection::Instance()->get()->prepare(self::SQL_POST);
            $result = $stm->execute(self::setObjectTemplate($input));
            
            if(!$result)
                throw new Exception("Usuario não foi criado:\t"
                    . $stm->errorInfo()[2]);

            unset($stm,$result);

        } catch (PDOException $ex) {
            throw new Exception("Ao criar Usuario: " . $ex->getMessage());
        }
	}

	public function get($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GET);
			$stm->bindParam(':usuario_id',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GET] Usuario: " . $ex->getMessage());
		}
	}

	public function getAll(){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_GETALL);
			$stm->execute();
			$usuarioArray = array();

			while($result = $stm->fetch(PDO::FETCH_ASSOC))
				$usuarioArray[] = self::createObjectTemplate($result);

			unset($usuario,$stm,$result);
			return $usuarioArray;

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [GETALL] Usuario: " . $ex->getMessage());
		}
	}

	public function read($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_READ);
			$stm->bindParam(':usuario_login',$input);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);

			if($result)
				return self::createObjectTemplate($result);

			unset($stm,$result);
			throw new NotFoundException();

		} catch(PDOException $ex){
			throw new Exception("Ao procurar [READ] Usuario: " . $ex->getMessage());
		}
	}

	public function update(Usuario $input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_UPDATE);
			$stm->execute(self::setObjectTemplate($input));

			if(!$stm->rowCount() > 0)
                throw new Exception("Usuario não foi atualizado:\t"
                    . $stm->errorInfo()[2]);

		} catch(PDOException $ex){
			throw new Exception("Ao atualizar Usuario: " . $ex->getMessage());
		}
	}

	public function delete($input){
		try{
			$stm = Connection::Instance()->get()->prepare(self::SQL_DELETE);
			$stm->bindParam(':usuario_id',$input);
			$stm->execute();

			if(!$stm->rowCount() > 0)
                throw new Exception("Usuario não foi deletado:\t"
                    . $stm->errorInfo()[2]);

			unset($stm,$result);

		} catch(PDOException $ex){
			throw new Exception("Ao deletar Usuario: " . $ex->getMessage());
		}
	}

	/*FUNCTIONS*/
	private function createObjectTemplate($resultSet){
		$usuario = new Usuario();
		$usuario->setId($resultSet['usuario_id']);
		$usuario->setLogin($resultSet['usuario_login']);
		$usuario->setOauthId($resultSet['oauth_uid']);
		$usuario->setOauthProvider($resultSet['oauth_provider']);
		$usuario->setTwitterOauthToken($resultSet['twitter_oauth_token']);
		$usuario->setTwitterOauthTokenSecret($resultSet['twitter_oauth_token_secret']);
		$usuario->setSenha($resultSet['usuario_senha']);
		$usuario->setEmail($resultSet['usuario_email']);
		$usuario->setCelular($resultSet['usuario_celular']);
		return $usuario;
	}

	private function setObjectTemplate($input){
		$Array = array(
			':usuario_login' => $input->getLogin(),
			':oauth_uid' => $input->getOauthId(),
			':oauth_provider' => $input->getOauthProvider(),
			':twitter_oauth_token' => $input->getTwitterOauthToken(),
			':twitter_oauth_token_secret' => $input->getTwitterOauthTokenSecret(),
			':usuario_senha' => $input->getSenha(),
			':usuario_email' => $input->getEmail(),
			':usuario_celular' => $input->getCelular()
		);
		if(!is_null($input->getId()))
			$Array[':usuario_id'] = $input->getId();

		return $Array;
	}

}

?>