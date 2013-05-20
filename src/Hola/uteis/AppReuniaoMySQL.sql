/*
 * Use it only in special cases, like: resetting the database
 *
DROP RULE rule_view_tipoitem ON TipoItem;
DROP FUNCTION insert_or_nothing(argn VARCHAR(20), argusuario INTEGER, argselect INTEGER);
DROP VIEW TipoItem;
DROP TABLE IF EXISTS convidado, tipagemitem, item, evento, usuario, tipo
 *
 */

SET datestyle TO 'dmy';

CREATE TABLE Tipo(
	tipo_id INT(11) AUTO_INCREMENT,
	tipo_nome VARCHAR(20) UNIQUE NOT NULL,
	CONSTRAINT pk_tipo_id PRIMARY KEY (tipo_id)
);

CREATE TABLE Usuario(
	usuario_id INT(11) AUTO_INCREMENT,
	usuario_login VARCHAR(20) UNIQUE,
	oauth_uid VARCHAR(200),
	oauth_provider VARCHAR(200),
	twitter_oauth_token VARCHAR(200), 
	twitter_oauth_token_secret VARCHAR(200),
	usuario_senha VARCHAR(15),
	usuario_email VARCHAR(70) UNIQUE,
	usuario_celular VARCHAR(11) UNIQUE,
	CONSTRAINT pk_usuario_id PRIMARY KEY (usuario_id)
);

CREATE TABLE Evento(
	evento_id INT(11) AUTO_INCREMENT,
	evento_nome VARCHAR(20) NOT NULL,
	evento_descricao VARCHAR(140),
	evento_data DATE,
	evento_hora TIME,
	evento_cep VARCHAR(8),
	evento_endereco VARCHAR(70),
	evento_complemento VARCHAR(30),
	evento_cidade VARCHAR(50),
	evento_uf VARCHAR(2),
	evento_tipo INT(11) NOT NULL,
	evento_usuario INT(11) NOT NULL,
	CONSTRAINT pk_evento_id PRIMARY KEY (evento_id),
	CONSTRAINT fk_evento_usuario FOREIGN KEY (evento_usuario) REFERENCES usuario(usuario_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_evento_tipo FOREIGN KEY (evento_tipo) REFERENCES tipo(tipo_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE TABLE Item(
	item_id INT(11) AUTO_INCREMENT,
	item_nome VARCHAR(20),
	item_usuario INT(11),
	CONSTRAINT pk_item_id PRIMARY KEY (item_id),
	CONSTRAINT fk_item_usuario FOREIGN KEY (item_usuario) REFERENCES usuario(usuario_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE TABLE TipagemItem(
	tipagemitem_item INT(11),
	tipagemitem_tipo INT(11),
	CONSTRAINT pk_tipagemitem_item_tipo PRIMARY KEY (tipagemitem_item, tipagemitem_tipo),
	CONSTRAINT fk_tipagemitem_item FOREIGN KEY (tipagemitem_item) REFERENCES item(item_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_tipagemitem_tipo FOREIGN KEY (tipagemitem_tipo) REFERENCES tipo(tipo_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE TABLE Convidado(
	convidado_id INT(11) AUTO_INCREMENT,
	convidado_evento INT(11) NOT NULL,
	convidado_usuario INT(11) NOT NULL,
	convidado_sms VARCHAR(11),
	convidado_email VARCHAR(30),
	convidado_facebook VARCHAR(30),
	convidado_twitter VARCHAR(30),
	CONSTRAINT pk_convidado_id PRIMARY KEY (convidado_id),
	CONSTRAINT fk_convidado_evento FOREIGN KEY (convidado_evento) REFERENCES evento(evento_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_convidado_usuario FOREIGN KEY (convidado_usuario) REFERENCES usuario(usuario_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE INDEX index_tipo_nome ON tipo USING HASH (tipo_nome);
CREATE INDEX index_evento_data ON evento USING BTREE (evento_data);
CREATE INDEX index_evento_hora ON evento USING BTREE (evento_hora);
CREATE INDEX index_evento_tipo ON evento USING BTREE (evento_tipo);
CREATE INDEX index_evento_usuario ON evento USING BTREE (evento_usuario);
CREATE INDEX index_item_nome ON item USING HASH (item_nome);
CREATE INDEX index_item_usuario ON item USING BTREE (item_usuario);
CREATE INDEX index_tipagemitem_item ON tipagemitem USING BTREE (tipagemitem_item);
CREATE INDEX index_tipagemitem_tipo ON tipagemitem USING BTREE (tipagemitem_tipo);
CREATE INDEX index_usuario_login ON usuario USING HASH (usuario_login);
CREATE INDEX index_usuario_oauth_uid ON usuario USING HASH (oauth_uid);
CREATE INDEX index_usuario_oauth_provider ON usuario USING HASH (oauth_provider);
CREATE INDEX index_convidado_evento ON convidado USING BTREE (convidado_evento);
CREATE INDEX index_convidado_usuario ON convidado USING BTREE (convidado_usuario);


CREATE OR REPLACE VIEW TipoItem(
	tipo_id,
	tipo_nome,
	item_id,
	item_nome,
	item_usuario
) 	AS (SELECT tipo_id, tipo_nome, item_id, item_nome, item_usuario 
		FROM ((tipagemitem AS ti INNER JOIN item AS i ON ti.tipagemitem_item = i.item_id) 
		INNER JOIN tipo AS t ON t.tipo_id = ti.tipagemitem_tipo));

CREATE OR REPLACE FUNCTION insert_or_nothing(argn VARCHAR(20), argusuario INTEGER, argselect INTEGER)
RETURNS INTEGER AS
$search_tipo$
DECLARE
rec RECORD;
BEGIN
	IF(argselect = 1) THEN
		SELECT tipo_id INTO rec
		FROM tipo
		WHERE tipo_nome = argn;
		IF (rec.tipo_id IS NULL) THEN
			INSERT INTO tipo VALUES(DEFAULT,argn);
			SELECT tipo_id INTO rec FROM tipo WHERE tipo_nome = argn;
			RETURN rec.tipo_id;
		ELSE
			RETURN rec.tipo_id;
		END IF;
	ELSE
		IF (argusuario IS NULL) THEN
			SELECT item_id INTO rec
			FROM item
			WHERE item_nome = argn;
		ELSE 
			SELECT item_id INTO rec
			FROM item
			WHERE item_nome = argn AND item_usuario = argusuario;
		END IF;
		
		IF (rec.item_id IS NULL) THEN
			INSERT INTO item VALUES(DEFAULT,argn,argusuario);
			SELECT item_id INTO rec FROM item WHERE item_nome = argn AND item_usuario = argusuario;
			RETURN rec.item_id;
		ELSE
			RETURN rec.item_id;
		END IF;
	END IF;
END;
$search_tipo$
LANGUAGE 'plpgsql';

CREATE OR REPLACE RULE rule_view_tipoitem AS ON INSERT
TO TipoItem DO INSTEAD(
	INSERT INTO item VALUES(DEFAULT,NEW.item_nome,NEW.item_usuario);
	INSERT INTO TipagemItem VALUES(
		insert_or_nothing(NEW.item_nome,NEW.item_usuario,0),
		insert_or_nothing(NEW.tipo_nome,NEW.item_usuario,1)
		));
/**/