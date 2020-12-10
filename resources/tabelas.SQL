USE ppi_clinica;

CREATE TABLE pessoa
(
  codigo int PRIMARY KEY auto_increment,
  nome varchar(50),
  email varchar(50) UNIQUE,
  telefone varchar(30),
  cep char(10),
  logradouro varchar(50),
  bairro varchar(50),
  cidade varchar(50),
  estado char(2)
) ENGINE=InnoDB;

CREATE TABLE funcionario
(
  data_contrato date,
  salario decimal(10,2),
  senha_hash varchar(255),
  codigo int PRIMARY KEY,
  FOREIGN KEY (codigo) REFERENCES pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE medico
(
  especialidade varchar(30),
  crm varchar(30),
  codigo int PRIMARY KEY,
  FOREIGN KEY (codigo) REFERENCES funcionario(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE paciente
(
  peso float,
  altura int,
  tipo_sanguineo char(3),
  codigo int PRIMARY KEY,
  FOREIGN KEY (codigo) REFERENCES pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE agenda
(
  codigo int PRIMARY KEY auto_increment,
  data_agendamento date,
  horario time,
  nome varchar(50),
  email varchar(50),
  telefone varchar(30),
  codigo_medico int,
  FOREIGN KEY (codigo_medico) REFERENCES medico(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE base_enderecos_ajax
(
  cep char(10) PRIMARY KEY,
  logradouro varchar(50),
  bairro varchar(50),
  cidade varchar(50),
  estado char(2)
) ENGINE=InnoDB;