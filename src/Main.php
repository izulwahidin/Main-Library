<?php namespace Wahidin;
class Main{
    protected $head, $endpoint, $post;

    protected function fetch(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_VERBOSE, true);

        if(isset($this->post)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post);
        }
        if(isset($this->head)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->head);
        }
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new \Exception("Curl Error ".curl_errno($ch), 1);
        }

        curl_close($ch);

        unset(
            $this->endpoint,
            $this->post,
            $this->head,
        );
        return $result;
    }
}