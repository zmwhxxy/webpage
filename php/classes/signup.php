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
                $this->error .= "内容不能为空!<br>";
            }

            // 邮箱检测
            if ($key == 'email') {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->error .= "{$key} 不合法的邮件!<br>";
                }
            }

            if ($key == 'first_name') {
                if (is_numeric($value)) {
                    $this->error .= "{$key} 只能是字母和数字!<br>";
                }
            }

            if ($key == 'last_name') {
                if (is_numeric($value)) {
                    $this->error .= "{$key} 只能是字母和数字!<br>";
                }
            }
        }

        if ($data['password'] != $data['password2']) {
            $this->error .= "密码不一致!<br>";
        }

        if ($this->error == "") {
            if (!$this->create_user($data)) {
                $this->error .= "注册失败!<br>";
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
            $profile_image = "images/" .$gender . ".png";
            $cover_image =  "images/mountain.jpg";

            $query = "insert into 
            users (userid,first_name,last_name,gender,email,password,url_address,profile_image,cover_image) 
            value ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address', '$profile_image', '$cover_image')";

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
