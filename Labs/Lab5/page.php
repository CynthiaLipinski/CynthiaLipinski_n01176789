<?php
 class Page {
    private $title;
    private $address;
    private $body;

    
    public function __construct($title, $address, $body)
    {
        $this->setTitle($title);
        $this->setAddress($address);
        $this->setBody($body);
    }
    
    public function setTitle($value){
        $this->title= $value;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
     public function setAddress($value){
        $this->address= $value;
    }
    
    public function getAddress(){
        return $this->address;
    }
    
    public function setBody($value){
        $this->body= $value;
    }
    
    public function getBody(){
        return $this->body;
    }
     
    public function createPage(){
         return '<!doctype html>
         <html>
         <head>
            <title>'.$this->title.'</title>
        </head>
        <body>'.$this->body;
    }
    
    public function endPage(){
        return '</body></html>';
    }
}
