<?php

class User{

   private int $id;
   private string $firstName;
   private string $lastName;
   private string $email;
   private string $password;
 
   public function __construct($id, $firstName, $lastName, $email, $password)
   {
        $this->id =$id;
        $this->firstName =$firstName;
        $this->lastName =$lastName;
        $this->email =$email;
        $this->password =$password;
   }
     public function __toString()
    {
        return "Пользователь #{$this->id}: {$this->firstName}
         {$this->lastName} ({$this->email})";
    }

    public function checkPassword($inputPassword) {
        // password_verify безопасно сравнивает хэшированный пароль с введенным
        return password_verify($inputPassword, $this->password);
    }
}