<?php

class Follow {

    private $follow_id, $user_followed, $user_follower;

    public function __construct($user_followed, $user_follower){
		$this->user_followed = $user_followed;
		$this->user_follower = $user_follower;
		$this->icon = $icon;
	}

    public function getID() {
        return $this->follow_id;
    }

    public function setID($value) {
        return $this->follow_id = $value;
    }

    public function getFollowed() {
        return $this->user_followed;
    }

    public function setFollowed($value) {
        return $this->user_followed = $value;
    }

    public function getFollower() {
        return $this->user_follower;
    }

    public function setFollower($value) {
        return $this->user_follower = $value;
    }

}
