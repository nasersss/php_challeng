<?php


class connectedDb
{
        public $servername;
        public $userName;
        public $passWord;
        public $dbname;
        public $tableName;
        public $con;


    /**
     * [Thsis construct using to set  vlaue 
     *  to connection databas variables]
     *
     * @param string $dbname
     * @param string $tableName
     * @param string $servername
     * @param string $userName
     * @param string $passWord
     * 
     */
    public function __construct(
        $dbname = "Newdb",
        $tableName = "Productdb",
        $servername = "localhost",
        $userName = "root",
        $passWord = ""
    )
    {
      $this->dbname = $dbname;
      $this->tableName = $tableName;
      $this->servername = $servername;
      $this->userName = $userName;
      $this->passWord = $passWord;

      // create connection to databas 
        $this->con = mysqli_connect($servername, $userName, $passWord, $dbname);

        // Check connection sucess or not 
        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }
    }

   
    /**
     * [This function used to get data from database tabls]
     *
     * @return [array of rows data form table databas]
     * 
     */
    public function getData(){
        $sql = "SELECT * FROM $this->tableName";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}






