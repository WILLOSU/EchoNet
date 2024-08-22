<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


	public function timeline() {

		$this->validaAutenticacao();
			
		//recuperação dos tweets
		$tweet = Container::getModel('Tweet');

		$tweet->__set('id_usuario', $_SESSION['id']);

		
        //variáveis de paginação
        $total_registros_pagina = 5;
		//$deslocamento = 0;
		$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
		$deslocamento = ($pagina - 1) * $total_registros_pagina;
		//(1 - 1) * 10 = 0
        
		/*
		//--
		$total_registros_pagina = 10; // limite de 10
		$deslocamento = 10; //offset da consulta
		$pagina = 2;
		(2 - 1) * 10 = 10

		//--
		$total_registros_pagina = 10; // limite de 10
		$deslocamento = 20; //offset da consulta
		$pagina = 3;
		(3 - 1) * 10 = 20

		*/

		
		//$tweets = $tweet->getAll();
		//echo "<br><br><br> Página: $pagina | Total de registros por página: $total_registros_pagina | Deslocamento: $deslocamento ";
		$tweets = $tweet->getPorPagina($total_registros_pagina, $deslocamento);
		$total_tweets = $tweet->getTotalRegistros();
	    $this->view->total_de_paginas = ceil($total_tweets['total'] / $total_registros_pagina);
		$this->view->pagina_ativa = $pagina;

		//echo $total_tweets['total'];

		$this->view->tweets = $tweets;

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuario();
		$this->view->total_tweets = $usuario->getTotalTweets();
		$this->view->total_seguindo = $usuario->getTotalSeguindo();
		$this->view->total_seguidores = $usuario->getTotalSeguidores();

		$this->render('timeline');
		
		
	}

	public function tweet() {
		$this->validaAutenticacao();

		$tweet = Container::getModel('Tweet');
		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweet->salvar();

		header('Location: /timeline');
		exit;
	}

	public function remove() {
        $this->validaAutenticacao();

        // Obtenha o ID do tweet a ser removido
    $id_tweet = isset($_POST['id_tweet']) ? $_POST['id_tweet'] : '';

    if (!empty($id_tweet)) {
        // Instancia o modelo Tweet
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id', $id_tweet);
        $tweet->__set('id_usuario', $_SESSION['id']);

        // Chama o método remove() do modelo
        $tweet->remove();
    }

    // Redireciona para a timeline após a remoção
    header('Location: /timeline');
    exit;
}

	public function validaAutenticacao() {
		session_start();
		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
			header('Location: /?login=erro');
			exit;
		}
	}

	public function quemSeguir() {
		$this->validaAutenticacao();

		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';		
		$usuarios = array();

		if($pesquisarPor != '') {			
			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome', $pesquisarPor);
			$usuario->__set('id', $_SESSION['id']);
			$usuarios = $usuario->getAll();
		}

		$this->view->usuarios = $usuarios;
		$this->render('quemSeguir');
	}	

	public function acao() {
		$this->validaAutenticacao();

		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		if($acao == 'seguir') {
			$usuario->seguirUsuario($id_usuario_seguindo);
		} else if($acao == 'deixar_de_seguir') {
			$usuario->deixarSeguirUsuario($id_usuario_seguindo);
		}

		header('Location: /quem_seguir');
		exit;
	}

	

}
?>