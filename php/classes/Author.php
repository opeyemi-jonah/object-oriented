<?php
/*
This is a class made for registering books in a library or book stored
@author Opeyemi Jonah <gavrieljonah@gmail.com>

*/

class author{
use validateUuid;

/*

*/

  private authorId;

/*

*/

  private authorAvatarUrl;

/*

*/

  private authorActivationToken;

/*

*/

  private authorEmail;

/*

*/

  private authorHash;

/*

*/

  private authorUsername;


/*Accessor for Author Id */

public function getAuthorId(){
  return ($this->authorId);
}

// Mutator for Author Id
public function setAuthorId(){
  //verify the author id is valid
  try {
  $uuid = self::validateUuid($newAuthorId);
  } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
  $exceptionType = get_class($exception);
  throw(new $exceptionType($exception->getMessage(), 0, $exception));
  }

  /*Accessor for author avatar url */

  public function getAuthorAvatarUrl(){
    return ($this->authorUrlId);
  }

  // Mutator for author avatar url
  public function setAuthorAvatarUrl(){
    //verify the author url amd error handlers
    try {
    $uuid = self::validateUuid($newAuthorAvatarUrl);
    } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
    $exceptionType = get_class($exception);
    throw(new $exceptionType($exception->getMessage(), 0, $exception));
    }

    /*Accessor for Author activation token */

    public function getAuthorActivationToken(){
      return ($this->authorActivationToken);
    }

    // Mutator for author activitation token
    public function setAuthorActivationToken(){
      //verify the author id is valid and error handlers
      try {
      $uuid = self::validateUuid($newAuthorActivationToken);
      } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
      $exceptionType = get_class($exception);
      throw(new $exceptionType($exception->getMessage(), 0, $exception));
      }
      /*Accessor for Author Email*/

      public function getAuthorEmail(){
        return ($this->authorEmail);
      }

      // Mutator for Author email
      public function setAuthorEmail(){
        //error handlers
        try {
        $uuid = self::validateUuid($newAuthorEmail);
        } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
        $exceptionType = get_class($exception);
        throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }

        /*Accessor for Author hash from password conversion */

        public function getAuthorHash(){
          return ($this->authorHash);
        }

        // Mutator for Author hash
        public function setAuthorHash(){
          //error handling function and validating author hash
          try {
          $uuid = self::validateUuid($newAuthorHash);
          } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
          $exceptionType = get_class($exception);
          throw(new $exceptionType($exception->getMessage(), 0, $exception));
          }

          /*Accessor for authorUsername */

          public function getAuthorUsername(){
            return ($this->authorUsername);
          }

          // Mutator for Author Username
          public function setAuthorUsername(){
            //verify the author Username is valid and error handlers
            try {
            $uuid = self::validateUuid($newAuthorUsername);
            } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
            }



}

}

 ?>
