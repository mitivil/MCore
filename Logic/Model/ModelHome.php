<?php
use MCore\System\Tools;

class ModelHome
{
    public function getUser()
    {
        $xaker = 2; 
        $result = Tools::mySql("SELECT * FROM users WHERE id=" . Tools::escape($xaker));
        // $result = Tools::escape($xaker);
        return  $result;
    }
}
