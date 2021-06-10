<?php declare(strict_types = 1);

namespace App\FrontModule\Presenters;

use Nette\Application\UI\Form;
use Nette\Database\DriverException;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;

class HomepagePresenter extends BasePresenter
{

	public function renderDefault(): void
	{

	}

	public function renderContact(): void
	{

	}

	protected function createComponentContactForm(): Form
	{
		$form = new Form();

		$form->addText('name', 'Jméno a příjmení')
			->addRule(Form::MAX_LENGTH, 'Maximálné délka je %s znaků', 120)
			->setRequired('Musíte uvést Vaše jméno a příjmení');

		$form->addEmail('email', 'Emailová adresa')
			->addRule(Form::MAX_LENGTH, 'Maximálné délka je %s znaků', 200)
			->setRequired('Musíte uvést Vaši emailovou adresu');

		$form->addTextArea('message', 'Text zprávy');

		$form->addInvisibleReCaptcha('recaptcha')
			->setMessage('Jste opravdu člověk?');

		$form->addSubmit('submit', 'Odeslat přihlášku');

		$form->onSubmit[] = function (Form $form) {
			try {
				$values = $form->getValues(true);

				$mail = new Message();
				$mail->setFrom($values['email'], $values['name']);
				$mail->addTo('fifa.urban@gmail.com');
				$mail->setSubject("HP interier - Zpráva z kontaktního formuláře");
				$mail->setBody($values['message']);

				$mailer = new SendmailMailer();
				$mailer->send($mail);

				$this->flashMessage('Zpráva byla úspěšně odeslána!');
				$this->redirect('this?odeslano=1');

			} catch (DriverException $e) {
				$this->flashMessage('Při pokusu o odeslání zprávy nastala chyba. Kontaktujte prosím správce webu na info@filipurban.cz', 'danger');
			}
		};

		return $form;
	}

}
