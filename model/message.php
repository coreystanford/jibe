<?php

//  Author: Wilston Dsouza
//  Message class

class Message {
    
    public $msg_id, $user_sender, $user_receiver, $message, $time_sent, $msr_read;
    
    public function __construct($user_sender, $user_receiver, $message){
        $this->user_sender = $user_sender;
        $this->user_receiver = $user_receiver;
        $this->message = $message;
    }
    
}


?>