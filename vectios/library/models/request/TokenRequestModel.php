<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TokenRequestModel
 *
 * @author egomez
 */
class TokenRequestModel {

    //put your code here
    /// <summary>
    /// clave de la aplicacion
    /// </summary>
    public $client_id;
    /// <summary>
    /// Clave secreta de la aplicacion
    /// </summary>
    public $client_secret;
    /// <summary>
    /// tipo de autenticacion 
    /// <example>client_credentials</example>
    /// </summary>
    public $grant_type;
    /// <summary>
    /// Codigo unico de la compañía
    /// <example>RUC</example>
    /// </summary>
    public $company_code;
    
    public function ToString(){
        $properties = get_object_vars($this);
        $result = '';
        $last_key = array_search(end($properties), $properties);
        foreach ($properties as $key => $value){
            
            if ($key != $last_key) {
                $result .= $key . '='. $value . '&';
            }else{
                $result .= $key . '='. $value;
            }
        }
        return $result;
    }

}
