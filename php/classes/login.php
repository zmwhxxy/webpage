<?php

class Login
{

    private $error = "";

    // 检测内容
    public function evaluate($data)
    {
        if (empty($data['email'])) {
            $this->error .= "email is empty!<br>";
        }
        if (empty($data['password'])) {
            $this->error .= "password is empty!<br>";
        }
        if ($this->error == "") {
            // 邮箱检测
            $email = addslashes($data['email']);
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
                $this->error .= "email is invalid email address!<br>";
            } else {
                $password = addslashes($data['password']);
                $query = "select * from users where email = '$email' limit 1";
                $DB = new Database();
                $result = $DB->read($query);
                if ($result) {
                    $row = $result[0];
                    if ($password != $row['password']) {
                        $this->error .= "Wrong password!<br>";
                    } else {
                        //reate session data
                        $_SESSION['mybook_userid'] = $row['userid'];
                    }
                } else {
                    $this->error .= "No such email was found<br>";
                }
            }
        }

        return $this->error;
    }
}
