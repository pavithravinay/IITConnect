<?php

    session_start();
    
    if (is_ajax()) 
    {
        if (isset($_POST["rowId"]) && !empty($_POST["rowId"])) 
        { //Checks if action value exists
            $rowId = $_POST["rowId"];                        
            
            $approve = stripos($rowId,'approve');
            $deny = stripos($rowId,'deny');
            
            $result;
            
            if($approve!==false)
            {
                $result = approveRequest($rowId);
            }
            if($deny!==false)
            {
                $result =  denyRequest($rowId);
            }

            $return['message'] = $result;                                   
            $return["json"] = json_encode($return);
            echo json_encode($return);
        }
    }

    function is_ajax() 
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    function approveRequest($rowId)
    {
        $pendingRequestArray = $_SESSION["result"];
        $reqIndex = substr($rowId,7);
        $memberId = $pendingRequestArray[$reqIndex][0];
        $groupClubId = $pendingRequestArray[$reqIndex][1];
        $approvalStatus='Y';
        $message = updateData($memberId,$groupClubId, $approvalStatus);
        sendEmail($approvalStatus,$memberId,$groupClubId);
        return $message;
    }
    
    function denyRequest($rowId)
    {
        $pendingRequestArray = $_SESSION["result"];
        $reqIndex = substr($rowId,4);        
        $memberId = $pendingRequestArray[$reqIndex][0];
        $groupClubId = $pendingRequestArray[$reqIndex][1];
        $approvalStatus='D';
        $message = updateData($memberId,$groupClubId, $approvalStatus);
        sendEmail($approvalStatus,$memberId,$groupClubId);
        return $message;
    }
    
    function updateData($memberId, $groupClubId, $approvalStatus)
    {
        include 'dbconnect.php';  
        $memberId =intval($memberId);
        $groupClubId =intval($groupClubId);        
        
        $sql = oci_parse($conn, "UPDATE joins SET approvalstatus=:approvalStatus WHERE memberid=:memberId AND groupClubId=:groupClubId");
        
        oci_bind_by_name($sql, ':approvalStatus', $approvalStatus);
        oci_bind_by_name($sql, ':memberId', $memberId);
        oci_bind_by_name($sql, ':groupClubId', $groupClubId);
        
        if (!$sql) 
        {
            $e = oci_error();
             return "sql parser error. Request update failed!!!";
        } 
                    
        $sqlresult = oci_execute($sql, OCI_COMMIT_ON_SUCCESS );
        if (!$sqlresult) {
            return "sql execution error. Request update failed!!!";
        }
        else
        {
            if($approvalStatus=='Y')
                return "Request Approved by the moderator!!!";
            else
                return "Request Denied by the moderator!!!";
        }
    }

    function sendEmail($approvalStatus, $memberId, $groupClubId)
    {
        list($userName, $password, $email) = getUserCredentials($memberId,$groupClubId);
        $groupName = getGroupName($groupClubId);
        if($approvalStatus=='Y')
        {
            $message = 'Congratulations!! Your request to Interest Group/Club: ' .$groupName . ' has been Approved.
            UserName: ' . $userName . '
            Password: ' . $password;
            
           //$message = $message . $email;
        }
        else
        {
            $message = "Your request to Interest Group/Club" .$groupName . "has been denied.";
            //$message = $message . $email;
        }
        
        //Default code
        
        date_default_timezone_set('Etc/UTC');
        include '/Mail/PHPMailerAutoload.php';
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        $mail->ClearAllRecipients( );
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "dboproject2016@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "Myiit@2016";
        //Set who the message is to be sent from
        $mail->setFrom('dboproject2016@gmail.com', 'Administrator');
        //Set an alternative reply-to address
        //$mail->addReplyTo('pavithravinay25@gmail.com', 'Pavithra Vinay');
        //Set who the message is to be sent to
        $mail->addAddress($email,'Vinay');
        //Set the subject line
        $mail->Subject = 'MyIIT Interest Group/Club Registration: Response';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($message);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
           return "Failed!!!";
        } else {
            return "Message sent!";
        }
        
    }

    function getUserCredentials($memberId, $groupClubId)
    {
        include 'dbconnect.php';  
        $memberId =intval($memberId);
        $groupId =intval($groupClubId);
        $sql = oci_parse($conn, "SELECT j.username, j.password, u.email from joins j inner join user_ u on j.memberid= u.userid WHERE memberid=$memberId AND groupClubId=$groupClubId");                         

        if (!$sql) {
          $e = oci_error();
          echo $e; 	
        } 
        $result = oci_execute($sql);
        if (!$result) {
          $e = oci_error();
          echo $e; 	
        }
        
        while ($row = oci_fetch_array($sql,OCI_BOTH))
        {
            $userName = $row[0];
            $password = $row[1];
            $email = $row[2];
            
            return array($userName, $password,$email);
        }        
    }

    function getGroupName($groupClubId)
    {
        include 'dbconnect.php';          
        $groupClubId =intval($groupClubId);
        $sql = oci_parse($conn, "SELECT name from InterestGroup_Club WHERE groupClubId=$groupClubId");                         

        if (!$sql) {
          $e = oci_error();
          echo $e; 	
        } 
        $result = oci_execute($sql);
        if (!$result) {
          $e = oci_error();
          echo $e; 	
        }
        
        while ($row = oci_fetch_array($sql,OCI_BOTH))
        {
            $groupName = $row[0];            
            
            return $groupName;
        }
        
    }
                        
                        
?>