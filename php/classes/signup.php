<?php

class Signup
{

    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= "{$key} is empty!<br>";
            }
        }

        if ($this->error != "") {
            return $this->error;
        }

        return $this->create_user($data);
    }

    public function create_user($data)
    {
        $userid = $this->create_userid();
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];
        $url_address = strtolower($first_name) . "." . strtolower($last_name);

        $query = "insert into 
        users (userid,first_name,last_name,gender,email,password,url_address) 
        value ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address')";

        return $query;
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
