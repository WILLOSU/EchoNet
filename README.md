
EchoNet é uma rede social similar ao Twitter, desenvolvida em PHP utilizando o servidor Apache e o banco de dados MySQL. 
Neste projeto, os usuários podem criar postagens (chamadas de "echos"), interagir com outros usuários, seguir perfis, 
e gerenciar seus próprios conteúdos.

Funcionalidades
Autenticação de Usuários: Cadastro e login de usuários, com sessões seguras.
Postagem de Echos: Criação de postagens curtas, semelhantes a tweets.
Remoção de Echos: Usuários podem deletar suas postagens.
Timeline Personalizada: Exibição de postagens dos usuários seguidos.
Seguir/Deixar de Seguir: Usuários podem seguir ou deixar de seguir outros usuários.
Busca por Usuários: Pesquisa de outros perfis na plataforma.

Tecnologias Utilizadas
PHP: Linguagem de programação principal usada no back-end.
Apache: Servidor web utilizado para hospedar a aplicação.
MySQL: Banco de dados relacional utilizado para armazenar informações de usuários, postagens, e interações.
HTML/CSS/Bootstrap: Tecnologias de front-end utilizadas para a criação da interface do usuário.
Composer: Gerenciador de dependências utilizado para o autoloading e organização do código.

Estrutura do Projeto
App/Controllers: Contém os controladores que gerenciam a lógica de negócio da aplicação.
App/Models: Contém os modelos que interagem com o banco de dados.
App/Views: Contém os arquivos de visualização (HTML/CSS/Bootstrap) que formam a interface do usuário.
vendor/: Contém as dependências instaladas via Composer.
public/: Contém os arquivos públicos, incluindo index.php, que é o ponto de entrada da aplicação.
config.php: Arquivo de configuração com credenciais e parâmetros de conexão ao banco de dados. 
