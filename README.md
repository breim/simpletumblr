simpletumblr
============


---------------------------------------------------------------------------------------------------
		
	Um simples blog feito em php para imitar o tumblr.

---------------------------------------------------------------------------------------------------

Instalação
------------

1- Crie uma nova base dados.

2- Acesse o arquivo config.php e configure o acesso ao banco de dados.

3- Crie as tabelas com o script database.sql


Configuração
------------

Depois de criada as tabelas, note que a tabela 'siteconf' tem as opções do site, como nome do blog,link de acesso ao blog e a quantidade de posts que devem aparecer por página.
Por default a quantidade de posts que é exibido a cada páginação é 5, basta editar o campo 'registros' para deixar ao seu tempero.

Não adicione nenhuma linha, apenas edite a já existente.


Para fazer upload de imagens é necessário criar um usuário de acesso através da tabela users,podemos rodar o comando em sql a seguir para criação do usuário

	INSERT INTO `users` (`id`, `nome`, `email`, `password`, `acessos`, `ultimoacesso`) VALUES ('', 'Nome', 'email, 'senha', '', '');

Para acessar a página de postagem/administração, bastar acessar o link http://localhost/admin
