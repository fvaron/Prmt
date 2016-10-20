<?php
/**
 * This file is part of Promethean_Request4quote for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Request4quote
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Request4quote_Block_Rewrite_Cart_Totals extends ITwebexperts_Request4quote_Block_Cart_Totals
{
    /**
     * @override
     * Render totals html for specific totals area (footer, body)
     *
     * @param   null|string $area
     * @param   int $colspan
     * @return  string
     */
    public function renderTotals($area = null, $colspan = 1)
    {
        $html = '';
        foreach ($this->getTotals() as $total) {
            if ($total->getArea() != $area && $area != -1) {
                continue;
            }

            $html .= $this->renderTotal($total, $area, $colspan);
        }

        if ($html && !$this->showBlock) {
            $this->showBlock = true;
            $html .= $this->_getHideBlock(self::MODE_TOTALS_SHOW)->toHtml();
        }
        return $html;
    }
}