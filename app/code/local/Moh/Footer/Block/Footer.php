<?php
class Moh_Footer_Block_Footer extends Mage_Core_Block_Template
{
    public function getAllNews()
    {
        return array( 
            array(
                'id' => 1,  
                'title' => 'Première News',  
                'short_content' => 'Description',  
                'content' => 'Contenu complet de la news'  
            ),
            array(
                'id' => 2,  
                'title' => 'Deuxième News',  
                'short_content' => 'Description courte de la seconde News',  
                'content' => 'Contenu complet de la news' 
            ),
        );  
    }
}
?>