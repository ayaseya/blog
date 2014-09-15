<?php
class PostsController extends AppController {

	/* cakePHPの足場(scaffold)の機能を用いることで簡易な管理画面を作成できます */
	// public $scaffold;

	/* cakePHPが用意しているヘルパークラスを宣言します */
	public $helpers = array (
			'Html',
			'Form'
	);
	public function index() {
		// $this->set()でControllerからViewにデータを渡す
		// 第一引数がViewに渡す際に使用する変数名(viewで$postsとして使用可能)
		// 第二引数がViewに渡すデータ（この場合全ての記事）
		/*
		 * $params = array ( 'order' => 'modified desc', 'limit' => 2 );
		 */
		$this->set ( 'posts', $this->Post->find ( 'all' ) );
		$this->set ( 'title_for_layout', '記事一覧' );
	}
	// $this->Postはデータベース: dotinstall_cakephp_blog »テーブル: postsを指している
	public function view($id = null) {
		// 引数の$idをPostModelに渡して対応するデータを引っ張ってくる
		$this->Post->id = $id;
		$this->set ( 'post', $this->Post->read () );
	}
	public function add() {
		// Formからpostのデータが入力された場合の処理
		if ($this->request->is ( 'post' )) {

			// Formから渡された入力データをPostModelに保存する
			if ($this->Post->save ( $this->request->data )) {
				// 成功したときの処理
				$this->Session->setFlash ( 'Success!' );
				// 記事一覧にリダイレクトします
				$this->redirect ( array (
						'action' => 'index'
				) );
			} else {
				// 失敗したときの処理
				$this->Session->setFlash ( 'Failed!' );
			}
		}
	}
	public function edit($id = null) {
		// 引数の$idをPostModelに渡して対応するデータを引っ張ってくる
		$this->Post->id = $id;
		// Formからgetのデータが入力された場合の処理
		if ($this->request->is ( 'get' )) {
			// FormにPostModelのデータを代入すると自動的にFormに表示される
			$this->request->data = $this->Post->read ();
		} 		// Formからpostのデータが入力された場合の処理(編集後、保存する場合の処理)
		else {
			if ($this->Post->save ( $this->request->data )) {
				$this->Session->setFlash ( 'Success!' );
				$this->redirect ( array (
						'action' => 'index'
				) );
			} else {
				$this->Session->setFlash ( 'Failed!' );
			}
		}
	}
	public function delete($id) {

		// URLで直接/post/deleteを指定してきた時のため例外処理を記述する
		if ($this->request->is ( 'get' )) {
			throw new MethodNotAllowedException ();
		}

		if ($this->Post->delete ( $id )) {
			$this->Session->setFlash ( 'Deleted!' );
			$this->redirect ( array (
					'action' => index
			) );
		}
	}
}