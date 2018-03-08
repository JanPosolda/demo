<?php

declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;


/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="user_email_uindex", columns={"email"})})
 * @ORM\Entity
 */
class User
{
	public const USER_ROLES = [
		'user',
		'admin',
	];

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255, nullable=false)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="binary", nullable=false)
	 */
	private $password;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=255, nullable=false)
	 */
	private $email;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="role", type="enum", nullable=false, options={"default"="user"})
	 */
	private $role;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
	 */
	private $created;


	public function __construct()
	{
		$this->role = 'user';
		$this->created = new \DateTime();
	}


	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}


	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}


	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}


	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}


	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}


	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}


	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}


	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}


	/**
	 * @return string
	 */
	public function getRole(): string
	{
		return $this->role;
	}


	/**
	 * @param string $role
	 */
	public function setRole(string $role): void
	{
		$this->role = $role;
	}


	/**
	 * @return \DateTime
	 */
	public function getCreated(): \DateTime
	{
		return $this->created;
	}


	/**
	 * @param \DateTime $created
	 */
	public function setCreated(\DateTime $created): void
	{
		$this->created = $created;
	}
}
