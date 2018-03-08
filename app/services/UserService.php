<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Models\Helpers;
use App\Models\NeonParameter;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Kdyby\Doctrine\EntityManager;
use Nette\DI\Container;


/**
 * Class ApiService
 * @package App\Services
 */
class UserService
{
	/**
	 * @var EntityManager
	 */
	private $em;

	/**
	 * @var Container
	 */
	private $container;


	/**
	 * ApiService constructor.
	 * @param EntityManager $em
	 * @param Container $container
	 */
	public function __construct(EntityManager $em, Container $container)
	{
		$this->em = $em;
		$this->container = $container;
	}


	/**
	 * @return array
	 * @throws \Exception
	 */
	public function getAll(): array
	{
		try {
			$userEntity = $this->em->getRepository(User::class);

			return $userEntity->createQueryBuilder('u')
				->select('u.name')
				->addSelect('u.email')
				->addSelect('u.role')
				->addSelect('u.created')
				->getQuery()
				->getArrayResult();
		} catch (\Exception $e) {
			throw $e;
		}
	}


	/**
	 * @param array $userData
	 * @throws \Exception
	 */
	public function create(array $userData): void
	{
		try {
			$passwordSalt = NeonParameter::get($this->container, 'system:passwordSalt');
			$password = Helpers::preparePassword($userData['password'], $passwordSalt);

			$user = new User();
			$user->setName($userData['name']);
			$user->setEmail($userData['email']);
			$user->setRole($userData['role']);
			$user->setPassword($password);

			$this->em->persist($user);
			$this->em->flush();
		} catch (UniqueConstraintViolationException $e) {
			throw new \InvalidArgumentException('Email is already used');
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
