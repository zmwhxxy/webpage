<?php

class Signup
{

    private $error = "";

    // 检测内容是否正确
    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            // 非空检测
            if (empty($value)) {
                $this->error .= "{$key} is empty!<br>";
            }

            // 邮箱检测
            if ($key == 'email') {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->error .= "{$key} is invalid email address!<br>";
                }
            }

            if ($key == 'first_name') {
                if (is_numeric($value)) {
                    $this->error .= "{$key} can't be a numberic string!<br>";
                }
            }

            if ($key == 'last_name') {
                if (is_numeric($value)) {
                    $this->error .= "{$key} can't be a numberic string!<br>";
                }
            }
        }

        if ($data['password'] != $data['password2']) {
            $this->error .= "password doesn't equal password2!<br>";
        }

        if ($this->error == "") {
            if (!$this->create_user($data)) {
                $this->error .= "fail to create user!<br>";
            }
        }

        return $this->error;
    }

    public function create_user($data)
    {
        //验证邮箱是否已注册
        $email = $data['email'];
        $query = "select * from users where email = '$email' limit 1";
        $DB = new Database();
        $result = $DB->read($query);
        if ($result) {
            $this->error .= "The email has been registered!<br>";
        } else {
            $userid = $this->create_userid();
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $gender = $data['gender'];

            $password = $data['password'];
            $url_address = strtolower($first_name) . "." . strtolower($last_name);

            $query = "insert into 
            users (userid,first_name,last_name,gender,email,password,url_address) 
            value ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address')";

            return $DB->save($query);
        }

        return false;
    }

    private function create_userid()
    {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $number = $number . rand(0, 9);
        }

        return $number;
    }
}
