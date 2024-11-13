create database Db_tarefas
use Db_tarefas

create table tbl_usuarios
(
 usu_codigo int primary key auto_increment,
 usu_nome varchar(60),
 usu_email varchar(30)
 );
 
 create table tbl_tarefas
 (
  tar_codigo int primary key auto_increment,
  tar_setor int,
  tar_prioridade enum('baixa','media','alta'),
  tar_descricao varchar(50),
  tar_status enum('pendente','em andamento','finalizada')
  );
  
  
  alter table tbl_tarefas add column usu_codigo int,
add constraint fk_usu_cod foreign key (usu_codigo)
references tbl_usuarios (usu_codigo)
  
  
INSERT INTO tbl_usuarios (usu_nome, usu_email)
VALUES 
    ('João Silva', 'joao.silva@email.com'),
    ('Maria Oliveira', 'maria.oliveira@email.com'),
    ('Carlos Souza', 'carlos.souza@email.com');


INSERT INTO tbl_usuarios (usu_nome, usu_email)
VALUES 
    ('João Silva', 'joao.silva@email.com'),
    ('Maria Oliveira', 'maria.oliveira@email.com'),
    ('Carlos Souza', 'carlos.souza@email.com');


INSERT INTO tbl_tarefas (tar_setor, tar_prioridade, tar_descrição, tar_status, usu_codigo)
VALUES 
    (1, 'alta', 'Concluir o relatório anual', 'pendente', 1),
    (2, 'media', 'Revisar as metas do setor financeiro', 'em andamento', 2),
    (3, 'baixa', 'Organizar arquivos da equipe', 'pendente', 3),
    (1, 'alta', 'Preparar apresentação para o cliente X', 'pendente', 1),
    (2, 'media', 'Verificar cumprimento das normas internas', 'finalizada', 2);




  