<?php

class Post{

    private $error = "";

    public function create_post($userid, $data){
        if(!empty($data['post'])){
            $post = addslashes($data['post']);
            $postid = $this->create_postid();

            $query = "insert into posts (userid,postid,post) 
            values('$userid', '$postid', '$post')";

            $DB = new Database();
            $DB->save($query);

        } else {
            $this->error .= "留言内容不能为空";
        }

        return $this->error;
    }

    private function create_postid() {
        $length = rand(4, 19);
        $number = "";
        for($i=0; $i<$length; $i++) {
            $new_rand = rand(0, 9);
            $number .= $new_rand;
        }

        return $number;
    }

    public function get_posts($id) {
        $query = "select * from posts where userid = '$id' order by id desc limit 10";
        $DB = new Database();
        return $DB->read($query);;
    }
}
