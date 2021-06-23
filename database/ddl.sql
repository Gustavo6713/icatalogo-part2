create database icatalogo;

use icatalogo;

create table tbl_produto(
    id int primary key auto_increment,
    descricao varchar(255) not null,
    peso decimal(10,2) not null,
    quantidade int not null,
    cor varchar(100) not null,
    tamanho varchar(100),
    valor decimal(10,2) not null,
    desconto int,
    imagem varchar(500)
);

select * from tbl_produto;

insert into tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto, imagem) 
values ("Calça", "56", "4", "preto", "32", "50", "10","calça");

ALTER TABLE tbl_produto
ADD COLUMN categoria_id int,
ADD FOREIGN KEY (categoria_id) REFERENCES tbl_categoria(id);

create table tbl_administrador(
	id int primary key auto_increment,
    nome varchar(255) not null,
    usuario varchar(255) not null,
    senha varchar(255) not null
);

insert into tbl_administrador (nome, usuario, senha) values ("Gustavo Fernandes", "gustavo", "123456");

insert into tbl_administrador (nome, usuario, senha) values ("Milena Marques", "milena", "654321");

select * from tbl_administrador;

create table tbl_categoria(
	id int primary key auto_increment,
    descricao varchar(255) not null
);

select * from tbl_categoria;
 
ALTER TABLE tbl_produto
ADD COLUMN categoria_id int,
ADD FOREIGN KEY (categoria_id) REFERENCES tbl_categoria(id);
TRUNCATE tbl_produto;

SELECT p.*, c.descricao as categoria FROM tbl_produto p
INNER JOIN tbl_categoria c ON p.categoria_id = c.id
ORDER BY p.id DESC;
delete from tbl_produto where id = 5;

SELECT p.*, c.descricao as categoria FROM tbl_produto p
INNER JOIN tbl_categoria c ON p.categoria_id = c.id
WHERE p.descricao LIKE '%?%'
OR c.descricao LIKE '%?%'
ORDER BY p.id DESC;

