<?php

class SendGrid {
    
    private $url = 'https://api.sendgrid.com/api/mail.send.json',
            $to,
            $toName,
            $from,
            $fromName,
            $subject,
            $text,
            $html;
    
    function setTo( $email, $name ){
        
        $this->to = $email;
        $this->toName = $name;
        
        return $this;
    }
    
    function setFrom( $email, $name ){
        $this->from = $email;
        $this->fromName = $name;
        
        return $this;
    }
    
    function setSubject( $subject ){
        
        $this->subject = $subject;
                
        return $this;
    }
    
    function setHtml( $html ){
        
        $this->html = $html;
    }
    
    function send(){

        $params = array(
            'to'        => $this->to,
            'toname'    => $this->toName,
            'from'      => $this->from,
            'fromname'  => $this->fromName,
            'subject'   => $this->subject,
            'text'      => $this->text,
            'html'      => $this->html
        );

        $session = curl_init($this->url);

        curl_setopt( $session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . SEND_GRID_API_KEY) );
        
        curl_setopt( $session, CURLOPT_POST,           true);
        curl_setopt( $session, CURLOPT_POSTFIELDS,     $params);
        curl_setopt( $session, CURLOPT_HEADER,         false);
        curl_setopt( $session, CURLOPT_RETURNTRANSFER, true);
        
        $response = json_decode( curl_exec($session), true );
        curl_close($session);

        return $response;
    }
}
