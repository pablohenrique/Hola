--DROP RULE rule_view_tipoitem ON TipoItem;
--DROP FUNCTION insert_or_nothing(argn VARCHAR(20), argusuario INTEGER, argselect INTEGER);
--DROP VIEW TipoItem;
DROP TABLE IF EXISTS convidado, tipoitem, item, evento, usuario, tipo



SET datestyle TO 'dmy';

CREATE TABLE Tipo(
	tipo_nome VARCHAR(20),
	CONSTRAINT pk_tipo_nome PRIMARY KEY (tipo_nome)
);
/*
CREATE TABLE Item(
	item_nome VARCHAR(20),
	CONSTRAINT pk_item_nome PRIMARY KEY (item_nome)
);

CREATE TABLE TipoItem(
	tipoitem_item VARCHAR(20),
	tipoitem_tipo VARCHAR(20),
	CONSTRAINT pk_tipoitem_item_tipo PRIMARY KEY (tipoitem_item, tipoitem_tipo),
	CONSTRAINT fk_tipoitem_item FOREIGN KEY (tipoitem_item) REFERENCES item(item_nome)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_tipoitem_tipo FOREIGN KEY (tipoitem_tipo) REFERENCES tipo(tipo_nome)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);
*/
CREATE TABLE Usuario(
	usuario_login VARCHAR(20) UNIQUE,
	oauth_uid VARCHAR(200),
	oauth_provider VARCHAR(200),
	twitter_oauth_token VARCHAR(200), 
	twitter_oauth_token_secret VARCHAR(200),
	usuario_senha VARCHAR(20),
	usuario_email VARCHAR(70) UNIQUE,
	usuario_celular VARCHAR(11) UNIQUE,
	CONSTRAINT pk_usuario_login PRIMARY KEY (usuario_login)
);

CREATE TABLE Evento(
	evento_id SERIAL,
	evento_nome VARCHAR(20) NOT NULL,
	evento_descricao VARCHAR(140),
	evento_data DATE,
	evento_hora TIME,
	evento_cep VARCHAR(8),
	evento_endereco VARCHAR(70),
	evento_complemento VARCHAR(50),
	evento_cidade VARCHAR(30),
	evento_uf VARCHAR(2),
	evento_tipo VARCHAR(20) NOT NULL,
	evento_status INTEGER DEFAULT 0,
	evento_usuario VARCHAR(20) NOT NULL,
	CONSTRAINT pk_evento_id PRIMARY KEY (evento_id),
	CONSTRAINT fk_evento_usuario FOREIGN KEY (evento_usuario) REFERENCES usuario(usuario_login)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_evento_tipo FOREIGN KEY (evento_tipo) REFERENCES tipo(tipo_nome)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE TABLE Convidado(
	convidado_id SERIAL,
	convidado_evento INTEGER NOT NULL,
	convidado_usuario VARCHAR(20) NOT NULL,
	convidado_sms VARCHAR(11),
	convidado_email VARCHAR(30),
	convidado_facebook VARCHAR(30),
	convidado_twitter VARCHAR(30),
	convidado_status INTEGER DEFAULT 0,
	CONSTRAINT pk_convidado_id PRIMARY KEY (convidado_id),
	CONSTRAINT fk_convidado_evento FOREIGN KEY (convidado_evento) REFERENCES evento(evento_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_convidado_usuario FOREIGN KEY (convidado_usuario) REFERENCES usuario(usuario_login)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE INDEX index_evento_data ON evento USING BTREE (evento_data);
CREATE INDEX index_evento_hora ON evento USING BTREE (evento_hora);
CREATE INDEX index_evento_tipo ON evento USING BTREE (evento_tipo);
CREATE INDEX index_evento_usuario ON evento USING HASH (evento_usuario);
CREATE INDEX index_tipoitem_item ON tipoitem USING HASH (tipoitem_item);
CREATE INDEX index_tipoitem_tipo ON tipoitem USING HASH(tipoitem_tipo);
CREATE INDEX index_usuario_oauth_uid ON usuario USING HASH (oauth_uid);
CREATE INDEX index_usuario_oauth_provider ON usuario USING HASH (oauth_provider);
CREATE INDEX index_convidado_evento ON convidado USING BTREE (convidado_evento);
CREATE INDEX index_convidado_usuario ON convidado USING HASH (convidado_usuario);


CREATE OR REPLACE FUNCTION login(arglogin character varying, argsenha character varying)
  RETURNS integer AS
$BODY$
DECLARE
	consulta RECORD;
BEGIN
	SELECT COUNT(DISTINCT usuario_login) AS contagem, usuario_login AS login, usuario_senha AS senha INTO consulta
	FROM usuario WHERE usuario_login = arglogin AND usuario_senha = argsenha
	GROUP BY usuario_login, usuario_senha;

	IF (consulta.contagem = 1 AND consulta.login = arglogin AND consulta.senha = argsenha) THEN
		RETURN  1;
	ELSE
		RETURN -1;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;



/*
 *
 * INSERTS
 *
 */
INSERT INTO tipo VALUES('churrasco');
INSERT INTO tipo VALUES('jantar arabe');
INSERT INTO tipo VALUES('jantar adams');
INSERT INTO evento VALUES('Caiolas Bar','Abertura do Bar mais locura do universo!','2013-08-22','15:00','34567123','Na minha casa, uai','Perto das moca de pipiu','Berlandia','MG','Tipo','root');

/*
INSERT INTO item VALUES('Coca-Cola');
INSERT INTO item VALUES('Guarana Antartica');
INSERT INTO item VALUES('Mafufo Defumado');
INSERT INTO item VALUES('Bolinhas de Cabelo');
INSERT INTO tipagemitem VALUES('churrasco','Coca-Cola');
INSERT INTO tipagemitem VALUES('jantar adams','Coca-Cola');
INSERT INTO tipagemitem VALUES('jantar adams','Mafufo Defumado');
INSERT INTO tipagemitem VALUES('churrasco','Guarana Antartica');
INSERT INTO tipagemitem VALUES('jantar arabe','Mafufo Defumado');
*/