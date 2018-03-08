<?php

namespace App\Presenters;

use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/**
	 * @throws Nette\Application\AbortException
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		$this->redirectUrl('demo.html');
	}
}
