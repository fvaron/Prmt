<?php
require_once(BP . DS . 'lib' . DS . 'tcpdf' . DS . 'tcpdf.php');

class MYPDF extends TCPDF
{
    /**
     * Rewrite footer TCPDF
     */
    public function Footer()
    {
        $cur_y = $this->y -25;
        $this->SetTextColorArray($this->footer_text_color);
        //set style for cell border
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
        //print document barcode
        $barcode = $this->getBarcode();
        if (!empty($barcode)) {
            $this->Ln($line_width);
            $barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
            $style = array(
                'position' => $this->rtl?'R':'L',
                'align' => $this->rtl?'R':'L',
                'stretch' => false,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => false,
                'padding' => 0,
                'fgcolor' => array(0,0,0),
                'bgcolor' => false,
                'text' => false
            );
            $this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
        }
        $w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
        if (empty($this->pagegroups)) {
            $pagenumtxt = $w_page.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
        } else {
            $pagenumtxt = $w_page.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
        }
        $this->SetY($cur_y);
        $this->SetX($this->original_rMargin);
        // Page number
        $textFooter = '<p style="font-size:11px;font-style:italic;color:grey;text-align: center">TSR INFORMATIQUE se réserve la propriété des produits vendus jusqu\'au paiement intégral de leur prix en principal et accessoire. Tout retard de paiement donnera lieu à l\'application des frais plafonnés à 15 euros ainsi que des intérêts au taux égal à 3 fois le taux d\'intérêt légal en vigueur.</p>
                        <p style="font-size:12px;color:orange;text-align: center">Écran intéractif - 40, rue Baudin - 92400 COURBEVOIE - http://www.ecran-interactif.net<br />
                                Tél. 01 70 79 07 66 - Fax : 09 72 22 99 25 –<br />
                                SIRET : 788 573 475 00019 - INTRACOM : FR47788573475</p>';
        $textFooter .= '<p style="text-align:center;">Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() . '</p>';
        $this->writeHTMLCell(0, 0, '', '', $textFooter, 0, 1, 0, true, '', true);
    }
}