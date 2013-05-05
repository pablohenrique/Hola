<?php

namespace Hola\DAO\postgresql;

use \PDO,
    Hola\Model\,
    Hola\DAO\IDAO,
    Hola\DAO\Exception,
    Hola\DAO\NotFoundException;

class DAO implements IDAO{

	/*DEFINITIONS FOR IDAO*/
	private const SQL_POST = 'INSERT INTO  VALUES();';
	private const SQL_GET = 'SELECT  FROM  WHERE _id = :_id;';
	private const SQL_GETALL = 'SELECT * FROM ;';
	private const SQL_READ = 'SELECT  FROM  WHERE ;';
	private const SQL_UPDATE = 'UPDATE  SET  WHERE _id = :_id;';
	private const SQL_DELETE = 'DELETE FROM  WHERE _id = :_id;';

	/*FUNCTIONS FOR IDAO*/
	public function post($ObjectInput){
		//
	}

	public function get($input){
		//
	}

	public function getAll($input){
		//
	}

	public function read($input){
		//
	}

	public function update($ObjectInput){
		//
	}

	public function delete($input){
		//
	}

	/*FUNCTIONS*/
	#public function T($){}

}

?>