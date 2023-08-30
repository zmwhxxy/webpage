
<?php

require_once 'classes/signup.php';

class SignupHandler extends Signup
{

    public function checkName(): bool
    {
        $name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($name)) {
            echo "请输入用户名称!" . "<br>";
            return false;
        }

        return $this->isNameExist($name);
    }

    public function checkPassword($password, $retype): bool
    {
        if ($password !== $retype) {
            echo "两次输入的密码不一致!" . "<br>";
            return false;
        }

        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($password)) {
            echo "请输入密码" . "<br>";
            return false;
        }

        return true;
    }

    public function checkEmail($email): bool
    {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        if (empty($email)) {
            echo "请输入邮箱地址" . "<br>";
            return false;
        }

        return $this->isEmailExist($email);
    }

    public function addUser($name, $password, $email)
    {
        // 将输入的密码hash加密<避免保持到数据库被看到明码>
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $row = array($name, $hash, $email);
        return $this->addRow($row);
    }
}

?>