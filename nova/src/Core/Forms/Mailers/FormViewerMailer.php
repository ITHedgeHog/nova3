<?php namespace Nova\Core\Mailers;

class FormViewerMailer extends \BaseMailer {

	public function newForm($data)
	{
		$contentKeys = [
			'content' => 'email.content.formviewer_results'
		];

		return $this->send('basic', $data, $contentKeys);
	}

}