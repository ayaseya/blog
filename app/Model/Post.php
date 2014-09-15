<?php
class Post extends AppModel {

	// 入力必須の論理チェック
	// $validateはControllerでsaveするときに呼ばれる
	// 配列で各ルールを定義する
	public $validate = array (
			'title' => array (
					'rule' => 'notEmpty'
			),
			'body' => array (
					'rule' => 'notEmpty'
			)
	);
}