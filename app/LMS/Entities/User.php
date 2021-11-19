<?php

class User
{
    protected string $username;
    protected string $password;
    protected string $email;
    protected int $roleId;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getUsername (): string
    {
        return $this->username;
    }

    public function getPassword (): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = sha1($password);
    }

    public function setEmail(string $email): void
    {
        $this->email = sha1($email);
    }

    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

}
