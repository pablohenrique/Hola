CREATE TABLE Tipo(
	tipo_id INTEGER AUTO_INCREMENT,
	tipo_nome VARCHAR(20) NOT NULL,
	CONSTRAINT pk_tipo_id PRIMARY KEY (tipo_id)
);

CREATE TABLE Evento(
	evento_id INTEGER AUTO_INCREMENT,
	evento_nome VARCHAR(20) NOT NULL,
	evento_descricao VARCHAR(140),
	evento_data DATE,
	evento_hora TIMESTAMP,
	evento_cep VARCHAR(8),
	evento_endereco VARCHAR(70),
	evento_complemento VARCHAR(30),
	evento_cidade VARCHAR(50),
	evento_uf VARCHAR(2),
	evento_tipo INTEGER NOT NULL,
	evento_usuario INTEGER NOT NULL,
	CONSTRAINT pk_evento_id PRIMARY KEY (evento_id),
	CONSTRAINT fk_evento_usuario FOREIGN KEY (evento_usuario) REFERENCES usuario(usuario_id),
	CONSTRAINT fk_evento_tipo FOREIGN KEY (evento_tipo) REFERENCES tipo(tipo_id)
);

CREATE TABLE Item(
	item_id INTEGER AUTO_INCREMENT,
	item_nome VARCHAR(20),
	item_usuario INTEGER,
	CONSTRAINT pk_item_id PRIMARY KEY (item_id),
	CONSTRAINT fk_item_usuario FOREIGN KEY (item_usuario) REFERENCES usuario(usuario_id)
);

CREATE TABLE TipagemItem(
	tipagemitem_item INTEGER,
	tipagemitem_tipo INTEGER,
	CONSTRAINT fk_tipagemitem_item FOREIGN KEY (tipagemitem_item) REFERENCES item(item_id),
	CONSTRAINT fk_tipagemitem_tipo FOREIGN KEY (tipagemitem_tipo) REFERENCES tipo(tipo_id)
);

CREATE TABLE Usuario(
	usuario_id INTEGER AUTO_INCREMENT,
	usuario_login VARCHAR(20),
	oauth_uid VARCHAR(200),
	oauth_provider VARCHAR(200),
	twitter_oauth_token VARCHAR(200), 
	twitter_oauth_token_secret VARCHAR(200),
	usuario_senha VARCHAR(15),
	usuario_email VARCHAR(70),
	usuario_celular VARCHAR(11),
	CONSTRAINT pk_usuario_login PRIMARY KEY (usuario_login)
);

CREATE TABLE Convidados(
	convidados_id INTEGER AUTO_INCREMENT,
	convidados_evento INTEGER NOT NULL,
	convidados_usuario INTEGER NOT NULL,
	convidados_sms VARCHAR(11),
	convidados_email VARCHAR(30),
	convidados_facebook VARCHAR(30),
	CONSTRAINT pk_convidados_id PRIMARY KEY (convidados_id),
	CONSTRAINT fk_convidados_evento FOREIGN KEY (convidados_evento) REFERENCES evento(evento_id),
	CONSTRAINT fk_convidados_usuario FOREIGN KEY (convidados_usuario) REFERENCES usuario(usuario_id)
);

CREATE INDEX index_tipo_nome USING HASH ON tipo(tipo_nome);
CREATE INDEX index_evento_data USING BTREE ON evento(evento_data);
CREATE INDEX index_evento_hora USING BTREE ON evento(evento_hora);
CREATE INDEX index_evento_tipo USING BTREE ON evento(evento_tipo);
CREATE INDEX index_evento_usuario USING BTREE ON evento(evento_usuario);
CREATE INDEX index_evento_usuario USING BTREE ON evento(evento_usuario);
CREATE INDEX index_item_nome USING HASH ON item(item_nome);
CREATE INDEX index_item_usuario USING BTREE ON item(item_usuario);
CREATE INDEX index_tipagemitem_item USING BTREE ON tipagemitem(tipagemitem_item);
CREATE INDEX index_tipagemitem_tipo USING BTREE ON tipagemitem(tipagemitem_tipo);
CREATE INDEX index_usuario_login USING HASH ON usuario(oauth_login);
CREATE INDEX index_usuario_oauth_uid USING HASH ON usuario(oauth_uid);
CREATE INDEX index_usuario_oauth_provider USING HASH ON usuario(oauth_provider);
CREATE INDEX index_convidados_evento USING BTREE ON convidados(convidados_evento);
CREATE INDEX index_convidados_usuario USING BTREE ON convidados(convidados_usuario);


/*
	Ate este ponto estamos seguros.
*/


/*
DELIMITER $$
 
CREATE TRIGGER trigger_gerencia_tipagemitem AFTER INSERT
ON ItensVenda
FOR EACH ROW
BEGIN
    UPDATE Produtos SET Estoque = Estoque - NEW.Quantidade
WHERE Referencia = NEW.Produto;
END$$

DELIMITER;

CREATE
    [DEFINER = { user | CURRENT_USER }]
    TRIGGER trigger_name trigger_time trigger_event
    ON tbl_name FOR EACH ROW trigger_body
--
--Pablo: Olhar API PagSeguro
CREATE TABLE Fatura( --Armazena os pagamentos do usuario -- criptografia (e.g. BCrypt)
	fatura_login VARCHAR(15), -- Usuario
	fatura_inicio DATE DEFAULT NULL, --data de pagamento
	fatura_fim DATE DEFAULT NULL, -- data de vencimento
	fatura_valorpago FLOAT, -- valor pago pelo usuario
	fatura_status VARCHAR(15), -- pagamento cancelado, aprovado, em espera
	fatura_formadepagamento VARCHAR(15) DEFAULT NULL -- cartao, boleto, transferencia, pagseguro, paypal
);

-- Mantemos dessa maneira entao
CREATE TABLE QuantidadeItens( -- seria uma boa ideia usar isso?
	quantidadeitens_evento INTEGER,
	quantidadeitens_item INTEGER,
	quantidadeitens_quantidade FLOAT
);

--- contives_notificao nao pode ser usado para isso??
-- OK... Mas onde eu especifico os celulares, emails, FBpages que os convites serao enviados?
---- Você esta certo, vai ficar baguncado, melhor uma tabela referenciando essa
CREATE TABLE Convite(
	convites_id AUTO_INCREMENT,
	contives_evento INTEGER NOT NULL,
	contives_usuario VARCHAR(15) NOT NULL,
	contives_item INTEGER,
	contives_item_qtd FLOAT, 
	contives_notificao INTEGER, --podemos usar para setar como convite sera enviado sms, app)
	contives_qrcode VARCHAR(20), -- algum tipo de código gerado no QR q identifica um convite?
);

--- temos que ver como ficara essa tabela nova que surgiu do problema
--- acima =X nao sei como cria-la. Convidados podem ter N formas de contato
----- Que tal criar um int que funciona como bool, com os campos e-mail, sms, etc
----- Quando setado para 1 ele notifica pelo meio, setado para zero não, o que
----- vc acha?
CREATE TABLE Convidados(
	convidados_convite INTEGER NOT NULL,
	convidados_sms VARCHAR(11) DEFAULT NULL,
	convidados_email VARCHAR(30),
	convidados_facebook VARCHAR(30) DEFAULT NULL
);


----- Vamos precisar de uma tabela para controlar o fluxo de sms dos organizadores
CREATE TABLE SMS(
	SMS_usuario VARCHAR(15) NOT NULL,
	SMS_quantidadetotal INTEGER NOT NULL,
	SMS_quantidadeusada INTEGER NOT NULL
);

CREATE TABLE Planos(
	plano_id AUTO_INCREMENT,
	plano_nome VARCHAR(20) NOT NULL,
	plano_periodicidade INTEGER NOT NULL,
	plano_valor FLOAT,
	plano_sms INTEGER
);

CREATE TABLE ItensTipados(
	itenstipados_item INTEGER,
	itenstipados_tipo INTEGER
);
*/