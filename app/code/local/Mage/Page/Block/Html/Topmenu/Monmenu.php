<?php
class Mage_Page_Block_Html_Topmenu_Monmenu extends Mage_Page_Block_Html_Topmenu{
	 /**
     * Recursively generates top menu html from data that is specified in $menuTree
     *
     * @param Varien_Data_Tree_Node $menuTree
     * @param string $childrenWrapClass
     * @return string
     * @deprecated since 1.8.2.0 use child block catalog.topnav.renderer instead
     */
    protected function _getHtml(Varien_Data_Tree_Node $menuTree, $childrenWrapClass)
    {
        $html = '';

        $children = $menuTree->getChildren();
        $parentLevel = $menuTree->getLevel();
        $childLevel = is_null($parentLevel) ? 0 : $parentLevel + 1;

        $counter = 1;
        $childrenCount = $children->count();

        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';

        foreach ($children as $child) {

            $child->setLevel($childLevel);
            $child->setIsFirst($counter == 1);
            $child->setIsLast($counter == $childrenCount);
            $child->setPositionClass($itemPositionClassPrefix . $counter);

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();

            if ($childLevel == 0 && $outermostClass) {
                $outermostClassCode = ' class="' . $outermostClass . '" ';
                $child->setClass($outermostClass);
            }

            $html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
            $html .= '<a href="' . $child->getUrl() . '" ' . $outermostClassCode . '>
                     <div class="menu-item-line-1">'.$this->escapeHtml($child->getName()) . '</div>
                     <div class="menu-item-line-2">'.$this->nomCat($this->escapeHtml($child->getName())) . '</div>
                     </a>';

            if ($child->hasChildren()) {
                if (!empty($childrenWrapClass)) {
                    $html .= '<div class="' . $childrenWrapClass . '">';
                }
                $html .= '<ul class="level' . $childLevel . '">';
                $html .= $this->_getHtml($child, $childrenWrapClass);
                $html .= '</ul>';

                if (!empty($childrenWrapClass)) {
                    $html .= '</div>';
                }
            }
            $html .= '</li>';

            $counter++;
        }

        return $html;
    }

    // Pour Modifier le nom des catégories sur le front-office
    protected function nomCat($name){
        $nom = $name;
        switch ($name) {
            case 'ACTIVPANEL':
                $nom = 'Ecrans interactifs';
                break;            
            case 'ACTIVBOARD':
                $nom = 'Tableaux interactifs';
                break;
            case 'ACTIVIEW':
                $nom = 'Visualiseurs';
                break; 
            case 'ACTIVINSPIRE':
                $nom = '& Logiciels';
                break;            
            case 'BOITIERS':
                $nom = 'D\'évaluation instantanée';
                break;
            case 'LAMPES':
                $nom = '& Accessoires';
                break;
            case 'SERVICES':
                $nom = 'Garantie-Installation Formation';
                break;
            
            default:
                break;
        }
        return $nom;
    }
}
?>