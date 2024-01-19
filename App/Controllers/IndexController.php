<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse() {

		$this->view->usuario = array(
				'nome' => '',
				'email' => '',
				'senha' => '',
			);

		$this->view->erroCadastro = false;

		$this->render('inscreverse');
	}

	public function registrar() {

		$usuario = Container::getModel('Usuario');

		// Verificar se as chaves existem antes de acessá-las
		$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$senha = isset($_POST['senha']) ? md5($_POST['senha']) : '';

		$usuario->__set('nome', $nome);
		$usuario->__set('email', $email);
		$usuario->__set('senha', $senha);

		$validacaoCadastro = $usuario->validarCadastro();

		if ($validacaoCadastro === true && count($usuario->getUsuarioPorEmail()) == 0) {
			$usuario->salvar();
			$this->render('cadastro');
		} else {
			$this->view->usuario = array(
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        );

			if ($validacaoCadastro === 'errnome' || $validacaoCadastro === 'errsenha' || $validacaoCadastro === 'erremail') {
				$this->view->erroCadastro = $validacaoCadastro;
			} elseif (count($usuario->getUsuarioPorEmail()) != 0) {
				$this->view->erroCadastro = 'usuarioexistente';
			}

			$this->render('inscreverse');
		}
	}

}


?>