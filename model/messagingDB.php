<?php

class Messaging {
    
    public static function addMessage($message) {
        $db = Database::getDB();

        $query =
            "INSERT INTO messaging
                 (user_sender,user_receiver,message)
             VALUES
                 ('$message->user_sender', '$message->user_receiver', '$message->message')";

        $row_count = $db->exec($query);
        return $row_count;
    }


    public static function getConversationsByUser($user_id) {

        $db = Database::getDB();
        $query = "SELECT * FROM users "
                    ."WHERE user_id in " 
                    ."("
                        ."SELECT DISTINCT user_receiver FROM messaging "
                        ."WHERE user_sender=".$user_id." " 
                    ."UNION " 
                        ."SELECT DISTINCT user_sender FROM messaging "
                        ."WHERE user_receiver=".$user_id.""
                    .");";

               
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $users = array();
        
        foreach ($result as $row) {
            $user = new User(
                $row['fname'],
                $row['lname'],
                $row['city'],
                $row['country'],
                $row['website'],
                $row['img_url'],
                $row['bio'],
                $row['specialty']);
                $user->setID($row['user_id']);   
                
            $users[] = $user;
        }
        
        return $users;
        
    }
    
    
    public static function getMessagesBySenderReceiver($me,$you){

        $db = Database::getDB();
        $query = "SELECT * FROM ("
                    ."SELECT * FROM messaging" 
                        . " WHERE ( user_sender=" . $me . " AND user_receiver=" . $you . " ) "
                        . "OR ( user_sender=" . $you . " AND user_receiver=" . $me . " ) "
                    ."ORDER BY time_sent DESC LIMIT 8) temp "
                ."ORDER BY time_sent ASC; ";
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $messages = array();

        foreach ($result as $row) {

            $message = new Message(
                $row['user_sender'],
                $row['user_receiver'],
                $row['message']);
            
            $message->msg_id = $row['msg_id'];
            $message->time_sent = $row['time_sent'];
            $message->msr_read = $row['msg_read'];
            

            $messages[] = $message;

        }
    
        return $messages;

    }
}