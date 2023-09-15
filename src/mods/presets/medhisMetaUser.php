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
    ['name','Name','text',null],
    ['lastname','Lastname','text',null],
    ['phone','Phone Number','text',null],  
    ['street','Street','text',null],
    ['state','State','text',null], 
    ['province','Province','text',null], 
    ['postalcode','Postal Code','text',null],
    ['birthdate','Birthday','date',null],
    ['nationality','Nationality','text',null],    
    ['country','Country','select',
        ['Argentina','Uruguay','Chile','Paraguay','Peru','Brazil']  
    ], 
    ['gender','Gender','radio',
        ['M','F']
    ],    
    ['anexo','Nota: ','text',null],
    ['dni','DNI','number',null] 
];
return $mod;
