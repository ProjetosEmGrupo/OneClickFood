create database dbLanchonete;


use dbLanchonete;



create table tbPedido
(id_pedido int primary key auto_increment,

data_abertura datetime,

data_fechamento datetime);



create table tbProduto
(id_produto int primary key,

des_produto varchar(30));




create table tbItemPedido
(id_pedido int,

id_produto int,
CONSTRAINT pk_itempedido PRIMARY KEY (id_produto, id_pedido),                                                    
constraint fk_pedido foreign key(id_pedido) 
references tbPedido(id_pedido),

constraint fk_produto foreign key(id_produto)
references tbProduto(id_produto));



Select com join

SELECT DISTINCT tbpedido.id_pedido, tbproduto.des_produto, tbpedido.data_abertura,tbpedido.data_fechamento from tbitempedido  join tbpedido ON tbitempedido.id_pedido = tbpedido.id_pedido JOIN tbproduto on  tbproduto.id_produto = tbitempedido.id_produto order by tbpedido.id_pedido, tbitempedido.id_produto ASC