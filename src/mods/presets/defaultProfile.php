<?php

/*
* User Profile Mod data
* array
* [0] name
* [1] Label
* [2] input type
* [3] Options (array: if input type requires it, null if not)
*/

$mod = [ 
    //
    ['usuario','Nombre','text',null],
    ['apell','Apellido','text',null],
    ['telefono','Telefono','text',null],  
    ['ocupa','Ocupacion','text',null],
    
    ['edad','Edad','number',null],
        
    ['suscrp','Suscripcion','radio',
        ['Si','No']  
    ],
    ['metpag','Metodo de pago','select',
        ['MP','Transferencia','Credito','Efectivo']
    ],
    ['gender','Sexo','radio',
        ['M','F']    
    ],
    ['nota','Nota: ','text',null] 
];
return $mod;
