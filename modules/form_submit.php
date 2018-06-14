<?php

    if(isset($_POST))
    {
        $email_data = "";
            
        foreach($_POST as $key=>$data)
        {
            $email_data .= $key . ": " . $data . "\n";
        }
        
        mail('jwrunge@gmail.com', "Quote: " . $_POST['yourname'], $email_data);
    }

?>  