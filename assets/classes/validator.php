<?php
class Validator{
    public static function validateDate($date,$format = 'Y-m-d'){
        $d=DateTime::createFromFormat($format,$date);
        return $d && $d->format($format)===$date;
    }


    public static function validateFormData($data) {
      $errors=[];

      //   Title validation

      if(empty($data['title'])){
        $errors[]="title must not be empty";
      }elseif(!preg_match("/^[a-zA-Z0-9\s\-\,\.\']{1,255}$/", $data['title'])){
        $errors[]="Title must be a valid Title";
      }

     //   author validation
      if(empty($data['author'])){
        $errors[]="author must not be empty";
      }elseif(!preg_match("/^[a-zA-Z\s\-]{1,100}$/",$data['author'])){
        $errors[]="author must be a valid name";
      }
      
     //   Date Validation
      if(empty($data['published_date']) || !self::validateDate($data['published_date'])){
        $errors[]="published_date must not be empty and valid";
      }elseif (strtotime($data['published_date']) > time()){
        $errors[]="published_date can not be in the future";
      }
     // gener validation
      if (empty($data['genre'])) {
        $errors[] = 'Genre is required.';
     }elseif (!preg_match("/^[a-zA-Z\s\-]{1,50}$/", $data['genre'])) {
      $errors[] = "Genre must contain only letters and spaces";
         }
     // Price validation
     if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
        $errors[] = 'Valid price is required.';
     }
    


       return $errors;
    }
}
