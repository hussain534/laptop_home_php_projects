<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TransactionResponseModel {

    /// <summary>
    /// Identificador de la transaccion en PayPhone
    /// </summary>
    public $TransactionId;
    /// <summary>
    /// Mensaje del motivo por el cual se cancelo la transaccion 
    /// </summary>
    public $Message;
    /// <summary>
    /// Codigo correspondiente al mensaje enviado
    /// </summary>
    public $MessageCode;
    /// <summary>
    /// Codigo de autorizacion de la transaccion generada (En caso que fue aprobada)
    /// </summary>
    public $AuthorizationCode;
    /// <summary>
    /// Estado en la que se encuentra la transaccion la transaccion
    /// </summary>
    public $TransactionStatus;
    /// <summary>
    /// Codigo del estado en el que se encuentra la transaccion
    /// </summary>
    public $StatusCode;
    /// <summary>
    /// Numbero de telefono del usuario que realizo el pago
    /// </summary>
    public $PhoneNumber;
    /// <summary>
    /// Identificador de la transccion generada en la aplicacion externa
    /// </summary>
    public $ClientTransactionId;
    /// <summary>
    /// Monto cobrado
    /// </summary>
    public $Amount;
    /// <summary>
    /// Marca de la tarjeta que se utilizo en el pago
    /// </summary>
    public $CardBrand;
    /// <summary>
    /// Si difirio el pago
    /// </summary>
    public $Deferred;
    /// <summary>
    /// Mensaje del diferido
    /// </summary>
    public $DeferredMessage;
    /// <summary>
    /// codigo del diferido
    /// </summary>
    public $DeferredCode;
    /// <summary>
    /// Bin de la tarjeta utilizada
    /// </summary>
    public $Bin;
    /// <summary>
    /// Procesador que atendio la transaccion
    /// </summary>
    public $Processor;
    /// <summary>
    /// List of taxes
    /// See TaxResponseModel
    /// </summary>
    public $Taxes;

}

class TaxResponseModel{
    /// <summary>
    /// Tax name "Fuel"
    /// </summary>
    public $Name;
    /// <summary>
    /// Tax total value "0.26"
    /// </summary>
    public $Amount;
    /// <summary>
    /// Tax value without tax "0.23"
    /// </summary>
    public $Value;
    /// <summary>
    /// The Tax applicable to this tax "0.03"
    /// </summary>
    public $Tax;
}
