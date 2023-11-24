<?php

/**
 * 
 *   Roles & Capabilities
 * 
 */

 $caps =[
            'unactive', //0
            'active',       // 1
            'can_view_profile', //2
            'can_view_item',    //3
            'can_edit_profile', //4
            'can_edit_item',    //5
            'can_create_profile',//6
            'can_create_item',  //7
            'can_delete_profile',//8
            'can_delete_item'//9
        ];

$rolcaps = [
    // unactive   0
    [$caps[0]],   

     // active        1             
    [$caps[1]],                         

    // active - view profile   2
    // active - view item       3
    // active - view profile - view item        4
    [$caps[1],$caps[2]],                
    [$caps[1],$caps[3]],                
    [$caps[1],$caps[2],$caps[3]],        
    
    // active - view profile - edit profile     5
    // active - view item - edit item           6
    // active - view profile - edit profile - view item - edit item         7
    [$caps[1],$caps[2],$caps[4]],                       
    [$caps[1],$caps[3],$caps[5]],
    [$caps[1],$caps[2],$caps[3],$caps[4],$caps[5]],

    

    // active - view profile - edit profile - create profile            8
    // active - view item - edit item - create item                     9
    // active - view profile - edit profile - create profile - view item - edit item - create item      10
    [$caps[1],$caps[2],$caps[4],$caps[6]],
    [$caps[1],$caps[3],$caps[5],$caps[7]],
    [$caps[1],
        $caps[2],$caps[4],$caps[6],    
        $caps[3],$caps[5],$caps[7]
    ], 
    // active - view profile - edit profile - create profile - delete profile       11
    // active - view item - edit item - create item - delete item                   12
    // active - view profile - edit profile - create profile - delete profile - view item - edit item - create item - delete item   13
    [$caps[1],$caps[2],$caps[4],$caps[6],$caps[8]],
    [$caps[1],$caps[3],$caps[5],$caps[7],$caps[9]],
    [$caps[1],
        $caps[2],$caps[4],$caps[6],$caps[8],
        $caps[3],$caps[5],$caps[7],$caps[9]
    ],
];

return $rolcaps;