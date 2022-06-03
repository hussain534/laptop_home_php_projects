<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConfigurationManager {

    private static $instance;

    private function __construct($file = 'ppsettings.ini') {
        $file = realpath(dirname(__FILE__)) . '/' . $file;

        if (!$settings = parse_ini_file($file, TRUE)) {
            throw new exception('Unable to open ' . $file . '.');
        }

        $this->ApiPath = $settings['payphone']['path'];
        $this->ApplicationId = $settings['payphone']['application_id'];

        $this->ApplicationPublicKey = $settings['payphone']['application_public_key'];
        $this->ClientId = $settings['payphone']['client_id'];
        $this->ClientSecret = $settings['payphone']['client_secret'];
        $this->PrivateKey = $settings['payphone']['client_private_key'];
        $this->RefreshToken = $settings['payphone']['refresh_token'];
        $this->Token = $settings['payphone']['token'];
        $this->Lang = $settings['payphone']['lang'];
    }

    public static function Instance() {
        if (!isset(self::$instance)) {
            $myClass = __CLASS__;
            self::$instance = new $myClass;
        }
        return self::$instance;
    }

    public function __clone() {
        trigger_error("La clonacion de este objeto no esta permitida");
    }

    public $PrivateKey = null;
    public $ApplicationPublicKey = null;
    public $Token = null;
    public $ApplicationId = null;
    public $RefreshToken = null;
    public $ClientId = null;
    public $ClientSecret = null;
    public $ApiPath = null;
    public $Lang = null;

}
