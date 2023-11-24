<?php
namespace Halfegg\admin\templates;

class adminBackendItems{

    function back_admin_items($id){
     //   $tt=count($lics);
    var_dump($id);
    $hit='
            <div id="il-dashboard" class="il-content active">
               
                <section id="intra-lic" class="intra-section"><h3>Items:</h3> ';
                
                $hit .= $this->new_item_form(10);
               
                $hit .='</section></div>';    
    
            return $hit;
    }

    private function new_item_form($id){
 
        $hi = '<div id="newitemform">
                <form id="newitem" enctype="multipart/form-data">';

        $hi .= '<span id="item-title" class="item-tinymce">    
                    <label for="it-name-'.$id.'">Title</label>
                    <input id="it-name-'.$id.'" type="text" name="it-name"/>
                </span>';

        $hi .= '<span id="item-desc" class="item-tinymce">
                    <label for="it-descr-'.$id.'">Description</label>
                    <input type="text" id="it-descr-'.$id.'" name="it-descr"/>
                </span>';
        $hi .= '<span id="item-editor" class="item-tinymce">               
                    <textarea id="it-cont-'.$id.'" name="it-cont" row="20" cols="33" placeholder="Here the content" ></textarea>
                </span>';
        $hi.= ' <span id="item-save" class="item-tinymce">
                    <button id="create-it-'.$id.'" class="create-it" id_user="'.$id.'">Save</button>
                </span>';
        $hi .= '</form></div>';  
        return $hi;
    }

}
