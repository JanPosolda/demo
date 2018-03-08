<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entities\User;
use App\Services\UserService;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Nette\Utils\Validators;
use Nette\Utils\Strings;
use Nette\Application\ForbiddenRequestException;
use Tracy\ILogger;


class ApiPresenter extends Nette\Application\UI\Presenter
{
	private const API_KEY = 'AsgBspR8hhy6WzjBNKrE0exuG';

	private const GET = 'GET';

	private const POST = 'POST';

	private const PUT = 'PUT';

	private const DELETE = 'DELETE';

	private const USER_REQUIRED_INPUTS = [
		'name',
		'email',
		'password',
		'role',
	];

	/**
	 * @var UserService
	 */
	private $userService;

	/**
	 * @var ILogger
	 */
	private $logger;


	public function __construct(UserService $userService, ILogger $logger)
	{
		parent::__construct();
		$this->userService = $userService;
		$this->logger = $logger;
	}


	/**
	 * @throws Nette\Application\AbortException
	 */
	public function actionUser(): void
	{
		$status = false;
		$message = '';
		$data = null;
		try {
			$httpRequest = $this->getHttpRequest();
			$authorization = $httpRequest->getHeader('Authorization');
			if ($authorization !== self::API_KEY) {
				throw new ForbiddenRequestException('Unauthorized access');
			}

			$method = $httpRequest->getMethod();
			switch ($method) {
				case self::GET:
					$data = $this->userService->getAll();
					break;
				case self::POST:
					//process data from post, check required values, normalize values, check syntax
					$postData = $this->processPostData($_POST);
					$this->userService->create($postData);
					break;
				case self::PUT:
					break;
				case self::DELETE:
					break;
				default:
					throw new \HttpRequestMethodException('Unknown method');
					break;
			}
			$status = true;
		} catch (\Exception $e) {
			$message = $e->getMessage();
			$this->logger->log($e, ILogger::EXCEPTION);
		}
		finally {
			$answer = [
				'status' => $status,
				'message' => $message,
				'data' => $data,
			];
		}

		$this->sendResponse(new JsonResponse($answer));
		$this->terminate();
	}


	/**
	 * @param $postData
	 * @return array
	 * @throws \Exception
	 */
	private function processPostData($postData): array
	{
		try {
			$userData = [];
			foreach (self::USER_REQUIRED_INPUTS as $input) {
				if (!$postData[$input]) {
					throw new \InvalidArgumentException('Required input ' . $input . ' missing');
				}
				$value = $postData[$input];

				$value = $this->normalizeValue($value);
				$userData[$input] = $value;
			}


			$this->validatePostData($userData);

			return $userData;
		} catch (\Exception $e) {
			throw $e;
		}
	}


	/**
	 * @param array $postData
	 * @throws \Exception
	 */
	private function validatePostData(array $postData): void
	{
		try {
			if (!Validators::isEmail($postData['email'])) {
				throw new \InvalidArgumentException('Email is not valid');
			}
			if (!\in_array($postData['role'], User::USER_ROLES, true)) {
				throw new \InvalidArgumentException('Role is not valid');
			}
		} catch (\Exception $e) {
			throw $e;
		}
	}


	/**
	 * @param string $value
	 * @return string
	 * @throws \Exception
	 */
	private function normalizeValue(string $value): string
	{
		try {
			$value = Strings::normalize($value);
			$value = Strings::fixEncoding($value);
			$value = strip_tags($value);
			$value = htmlspecialchars($value);
			$value = trim($value);

			return $value;
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
