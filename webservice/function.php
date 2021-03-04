<?php
require "crud.php";
date_default_timezone_set("Asia/Karachi");
error_reporting(E_ALL);


 $crud = new Crud();

//echo login("shamim","123456789","B-7HRJSZ1-33DB5A8A",20);
// get login //
function login($username,$password,$serial,$terminal){

     if(!empty($username) && !empty($password)){

            $result = $GLOBALS['crud']->runQuery("SELECT user.id,user.fullname,user.username,user.password,user.show_password,authoz.*,b.branch_name as branch_name,b.branch_address,c.name as company_name,d.mac_address as mac,d.terminal_name FROM user_details as user INNER JOIN user_authorization as authoz ON authoz.user_id = user.id INNER JOIN branch b on b.branch_id = authoz.branch_id INNER JOIN company c on c.company_id = authoz.company_id INNER JOIN terminal_details d on d.branch_id = b.branch_id and d.mac_address = '$serial' and d.terminal_id = $terminal  WHERE user.username = '".$username."' and authoz.status_id = 1");
            if(!empty($result) && sizeof($result) > 0){

                for($c=0;$c < sizeof($result);$c++) {
                     if(password_verify($password, $result[$c]["password"]))
                   {
                           return json_encode($result[$c]);
                     }
                }

            }else {
                return 0;
            }

     }else {

         return 0;
     }


}
// echo create_token(1,"1001",date("Y-m-d H:i:s"),date("Y-m-d H:i:s"));

//Add User Authentication
function create_token($department,$token_no,$created, $updated){

    if(!empty($token_no)){
 
               $fixcolum = "(department_id,token_mode_id,token_no,created_at,updated_at)";
 
               $colum ="($department,1,'$token_no','$created','$updated')";
       
           $result = $GLOBALS['crud']->insert_mode($fixcolum,$colum,"tokens",true);
            
             if($result){
                   return $result;
              }else {
                   return 0;
              }
 
 
       }else {
         return 0;
       }
 }




?>
