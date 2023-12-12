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
    ['estciv','Estado civil','radio',
        ['Casado','Soltero']
    ],
    ['calle','Calle','text',null],
    ['nume','Numero','text',null],
    ['locali','Localidad','text',null],
    ['telefono','Telefono','text',null], 
    
    ['edad','Edad','number',null],
    ['naci','Nacionalidad','text',null]
];
return $mod;
