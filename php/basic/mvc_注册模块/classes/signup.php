
<?php

// 用户注册类

require_once('base/database.php');

class Signup extends Database
{
    // 名字是否存在
    public function isNameExist($name)
    {
        $sql = "SELECT name FROM users WHERE name = ?;";
        $stmt = $this->pdo()->prepare($sql);
        if ($stmt->execute(array($name))) {
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    // 邮箱是否存在
    public function isEmailExist($email)
    {
        $sql = "SELECT name FROM users WHERE email = ?;";
        $stmt = $this->pdo()->prepare($sql);
        if ($stmt->execute(array($email))) {
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    // 用户是否存在
    public function isUserExist($name, $email)
    {
        $sql = "SELECT name FROM users WHERE name = ? AND email = ?;";
        $stmt = $this->pdo()->prepare($sql);
        if ($stmt->execute(array($name, $email))) {
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }

        return false;
    }

    // 添加一条新记录到数据表最后
    public function addRow($row)
    {
        $sql = "INSERT INTO users (name, password, email) VALUES (?,?,?);";
        $stmt = $this->pdo()->prepare($sql);
        if ($stmt->execute($row)) {
            return true;
        }

        return false;
    }
}
