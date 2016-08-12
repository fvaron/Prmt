<?php
/**
 * This file is part of Promethean_Customer for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Customer
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    $installer = $this;

    $_customerAddressTemplateHtml = <<<HTML
{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}<br/>
{{depend company}}{{var company}}<br />{{/depend}}
{{if street1}}{{var street1}}<br />{{/if}}
{{depend street2}}{{var street2}}<br />{{/depend}}
{{depend street3}}{{var street3}}<br />{{/depend}}
{{depend street4}}{{var street4}}<br />{{/depend}}
{{if city}}{{var city}},  {{/if}}, {{if postcode}}{{var postcode}}{{/if}}<br/>
{{var country}}<br/>
{{depend telephone}}Téléphone fixe : {{var telephone}}<br/>{{/depend}}
{{depend mobile}}Téléphone mobile : {{var mobile}}<br/>{{/depend}}
{{depend fax}}<br/>Fax : {{var fax}}{{/depend}}
{{depend vat_id}}<br/>N°TVA : {{var vat_id}}{{/depend}}
HTML;

    $_customerAddressTemplateText = <<<HTML
{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}
{{depend company}}{{var company}}{{/depend}}
{{if street1}}{{var street1}}
{{/if}}
{{depend street2}}{{var street2}}{{/depend}}
{{depend street3}}{{var street3}}{{/depend}}
{{depend street4}}{{var street4}}{{/depend}}
{{if city}}{{var city}},  {{/if}}, {{if postcode}}{{var postcode}}{{/if}}
{{var country}}
{{depend telephone}}Téléphone fixe : {{var telephone}}{{/depend}}
{{depend mobile}}Téléphone mobile : {{var mobile}}{{/depend}}
{{depend fax}}Fax : {{var fax}}{{/depend}}
{{depend vat_id}}N°TVA : {{var vat_id}}{{/depend}}
HTML;

    $_customerAddressTemplateOneline = <<<HTML
{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}, {{var street}}, {{var city}}, {{var region}} {{var postcode}}, {{var country}}
HTML;

    $_customerAddressTemplateJavascript = <<<HTML
#{prefix} #{firstname} #{middlename} #{lastname} #{suffix}<br/>#{company}<br/>#{street0}<br/>#{street1}<br/>#{street2}<br/>#{street3}<br/>#{city}, #{postcode}<br/>#{country_id}<br/>Téléphone fixe : #{telephone}<br/>Téléphone mobile : #{mobile}<br/>F: #{fax}<br/>VAT: #{vat_id}
HTML;


    /**
     * Update Customer Attribute Address Template
     */
    $installer->setConfigData('customer/address_templates/html', $_customerAddressTemplateHtml);
    $installer->setConfigData('customer/address_templates/pdf', $_customerAddressTemplateHtml);
    $installer->setConfigData('customer/address_templates/text', $_customerAddressTemplateText);
    $installer->setConfigData('customer/address_templates/oneline', $_customerAddressTemplateOneline);
    $installer->setConfigData('customer/address_templates/js_template', $_customerAddressTemplateJavascript);


} catch (Exception $e) {
    Mage::log($e, null, 'local.log', true);
}