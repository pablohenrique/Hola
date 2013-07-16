DROP RULE rule_view_tipoitem ON TipoItem;
DROP FUNCTION insert_or_nothing(argn VARCHAR(20), argusuario INTEGER, argselect INTEGER);
DROP VIEW TipoItem;
DROP TABLE IF EXISTS convidado, tipagemitem, item, evento, usuario, tipo



SET datestyle TO 'dmy';

CREATE TABLE Tipo(
	tipo_id SERIAL,
	tipo_nome VARCHAR(20) UNIQUE NOT NULL,
	CONSTRAINT pk_tipo_id PRIMARY KEY (tipo_id)
);

CREATE TABLE Usuario(
	usuario_login VARCHAR(20) UNIQUE,
	oauth_uid VARCHAR(200),
	oauth_provider VARCHAR(200),
	twitter_oauth_token VARCHAR(200), 
	twitter_oauth_token_secret VARCHAR(200),
	usuario_senha VARCHAR(15),
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
	evento_tipo INTEGER NOT NULL,
	evento_usuario VARCHAR(20) NOT NULL,
	CONSTRAINT pk_evento_id PRIMARY KEY (evento_id),
	CONSTRAINT fk_evento_usuario FOREIGN KEY (evento_usuario) REFERENCES usuario(usuario_login)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_evento_tipo FOREIGN KEY (evento_tipo) REFERENCES tipo(tipo_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE TABLE Item(
	item_id SERIAL,
	item_nome VARCHAR(20),
	item_usuario VARCHAR(20),
	CONSTRAINT pk_item_id PRIMARY KEY (item_id),
	CONSTRAINT fk_item_usuario FOREIGN KEY (item_usuario) REFERENCES usuario(usuario_login)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

CREATE TABLE TipagemItem(
	tipagemitem_item INTEGER,
	tipagemitem_tipo INTEGER,
	CONSTRAINT pk_tipagemitem_item_tipo PRIMARY KEY (tipagemitem_item, tipagemitem_tipo),
	CONSTRAINT fk_tipagemitem_item FOREIGN KEY (tipagemitem_item) REFERENCES item(item_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_tipagemitem_tipo FOREIGN KEY (tipagemitem_tipo) REFERENCES tipo(tipo_id)
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
	--convidado_status VARCHAR(3),
	CONSTRAINT pk_convidado_id PRIMARY KEY (convidado_id),
	CONSTRAINT fk_convidado_evento FOREIGN KEY (convidado_evento) REFERENCES evento(evento_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
	CONSTRAINT fk_convidado_usuario FOREIGN KEY (convidado_usuario) REFERENCES usuario(usuario_login)
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

CREATE OR REPLACE FUNCTION insert_or_nothing(argn VARCHAR(20), argusuario VARCHAR(20), argselect INTEGER)
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
 * BACKUP DAS TABELAS
 *
 */


CREATE OR REPLACE FUNCTION trigger_backup_evento()
RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO BackupEvento VALUES(
			OLD.evento_id,
			OLD.evento_nome,
			OLD.evento_descricao,
			OLD.evento_data,
			OLD.evento_hora,
			OLD.evento_cep,
			OLD.evento_endereco,
			OLD.evento_complemento,
			OLD.evento_cidade,
			OLD.evento_uf,
			OLD.evento_tipo,
			OLD.evento_usuario
			);
	RETURN OLD;
END;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_backup_evento
   BEFORE DELETE ON Evento
   FOR EACH ROW EXECUTE PROCEDURE trigger_backup_evento();



CREATE OR REPLACE FUNCTION trigger_backup_convidado()
RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO BackupConvidado VALUES(
			OLD.convidado_id,
			OLD.convidado_evento,
			OLD.convidado_status,
			OLD.convidado_sms,
			OLD.convidado_email,
			OLD.convidado_facebook,
			OLD.convidado_twitter,
			OLD.convidado_usuario
			);
	RETURN OLD;
END;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_backup_convidado
   BEFORE DELETE ON Convidado
   FOR EACH ROW EXECUTE PROCEDURE trigger_backup_convidado();




CREATE OR REPLACE FUNCTION trigger_backup_usuario()
RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO BackupUsuario VALUES(
			OLD.usuario_login,
			OLD.oauth_uid,
			OLD.oauth_provider,
			OLD.twitter_oauth_token 
			OLD.twitter_oauth_token_secret,
			OLD.usuario_senha,
			OLD.usuario_email,
			OLD.usuario_celular
			);
	RETURN OLD;
END;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_backup_usuario
   BEFORE DELETE ON Usuario
   FOR EACH ROW EXECUTE PROCEDURE trigger_backup_usuario();




CREATE OR REPLACE FUNCTION trigger_backup_item()
RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO BackupItem VALUES(
			OLD.item_id,
			OLD.item_nome,
			OLD.item_usuario
			);
	RETURN OLD;
END;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_backup_item
   BEFORE DELETE ON Item
   FOR EACH ROW EXECUTE PROCEDURE trigger_backup_item();




CREATE OR REPLACE FUNCTION trigger_backup_tipo()
RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO BackupTipo VALUES(
			OLD.tipo_id,
			OLD.tipo_nome
			);
	RETURN OLD;
END;
$$
LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_backup_tipo
   BEFORE DELETE ON Tipo
   FOR EACH ROW EXECUTE PROCEDURE trigger_backup_tipo();





/*
 * INSERTS
 */


select * from tipoitem
select * from item
select * from tipo

INSERT INTO tipo VALUES(DEFAULT,'churrasco');
INSERT INTO tipo VALUES(DEFAULT,'jantar arabe');
INSERT INTO tipo VALUES(DEFAULT,'jantar adams');
INSERT INTO usuario VALUES('root','ouid','oprovider','totoken','totsecret','toor','root@root.com','3443211234');
INSERT INTO usuario VALUES('toor','ouid','oprovider','totoken','totsecret','root','toor@toor.com','3443211235');
INSERT INTO evento VALUES(DEFAULT,'Caiolas Bar','Abertura do Bar mais locura do universo!','2013-08-22','15:00','34567123','Na minha casa, uai','Perto das moca de pipiu','Berlandia','MG','1','root');
INSERT INTO item VALUES(DEFAULT,'Coca-Cola',NULL);
INSERT INTO item VALUES(DEFAULT,'Guarana Antartica',NULL);
INSERT INTO item VALUES(DEFAULT,'Mafufo Defumado','root');
INSERT INTO item VALUES(DEFAULT,'Bolinhas de Cabelo','root');
INSERT INTO tipagemitem VALUES(1,1);
INSERT INTO tipagemitem VALUES(2,1);
INSERT INTO tipagemitem VALUES(4,2);
INSERT INTO tipagemitem VALUES(5,3);
INSERT INTO convidado VALUES(DEFAULT,1,'root',(SELECT usuario_celular FROM usuario WHERE usuario_login = 'root'),(SELECT usuario_email FROM usuario WHERE usuario_login = 'root'),'','');
INSERT INTO convidado VALUES(DEFAULT,1,'toor',(SELECT usuario_celular FROM usuario WHERE usuario_login = 'toor'),(SELECT usuario_email FROM usuario WHERE usuario_login = 'toor'),'','');
