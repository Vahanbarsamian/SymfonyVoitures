<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 *
 * @UniqueEntity(
 *  fields = {"username"},
 *  errorPath = "username",
 *  message = "Cet utilisateur à déjà été utilisé, veuillez saisir un autre identifiant"
 * )
 */

class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *  min = 5,
     *  max = 10,
     *  minMessage = "Le nombre de caractères ne peut être inferieur à {{ limit }} caractères",
     *  maxMessage = "Le nombre de caractères ne peut être superieur à {{ limit }} caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Regex(pattern="/[A-Z]+[a-z]+[0-9]+[\.\*\@\-\+]+/", message="Le mot de passe doit contenir au moins 8 caratères, une majuscule, une minuscule, un chiffre et un caractère special")
     * @Assert\Length(min=8)
     */
    private $password;

    /**
     * @var string $confirmPassword
     *
     * @Assert\EqualTo(
     *  propertyPath="password",
     *  message="Le mot de passe de confirmation doit être égal au mot de passe"
     * )
     */
    private $confirmPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        if ($this->roles) {
            return [$this->roles];
        } else {
            $this->setRoles('ROLES_USER');
            return [$this->roles];
        }

        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Get $confirmPassword
     *
     * @return string
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set $confirmPassword
     *
     * @param string $confirmPassword $confirmPassword
     *
     * @return self
     */
    public function setConfirmPassword(string $confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

}
