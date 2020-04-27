<?php

class Post extends Page 
{
    private $date;

    public function __construct($title, $address, $body,$date){
        parent::__construct($title, $address, $body);
        $this->date= $date;
    }
    public function postAge(){
        $today = new DateTime();
        $diff=date_diff(new DateTime($this->date),$today);
        return $diff;
    }
}
