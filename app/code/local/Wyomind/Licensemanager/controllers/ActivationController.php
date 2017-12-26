<?php

class Wyomind_Licensemanager_ActivationController extends Mage_Core_Controller_Front_Action
{

    public function webserviceAction() 
    {

        foreach ($_POST as $key => $value)
            $$key = $value;
        if (isset($namespace)) {
            $activation_key = Mage::getStoreConfig("$namespace/license/activation_key");
            $base_url = Mage::getStoreConfig("web/secure/base_url");
            $registered_version = Mage::getStoreConfig("$namespace/license/version");
        } else
            die();


        if (isset($wgs_activation_key) && $wgs_activation_key == Mage::getStoreConfig("$namespace/license/activation_key")) {
            if (isset($wgs_status)) {
                switch ($wgs_status) {
                    case "success" :
                        Mage::getConfig()->saveConfig("$namespace/license/version", $wgs_version, "default", "0");
                        Mage::getConfig()->saveConfig("$namespace/license/activation_code", $wgs_activation, "default", "0");
                        Mage::helper("licensemanager")->log(ucfirst($namespace), $registered_version, $base_url, $activation_key, 'manual activation -> success:' . $wgs_message);
                        Mage::getSingleton("core/session")->setData("update_" . $namespace, "false");
                        Mage::getConfig()->cleanCache();
                        Mage::getSingleton("core/session")->addSuccess($wgs_message);
                        break;
                    case "error" :
                        Mage::getSingleton("core/session")->addError($wgs_message);
                        Mage::getConfig()->saveConfig("$namespace/license/activation_code", "", "default", "0");
                        Mage::helper("licensemanager")->log(ucfirst($namespace), $registered_version, $base_url, $activation_key, 'manual activation -> error:' . $wgs_message);
                        Mage::getConfig()->cleanCache();
                        break;
                    case "uninstall" :
                        Mage::getSingleton("core/session")->addError($wgs_message);
                        Mage::getConfig()->saveConfig("$namespace/license/activation_key", "", "default", "0");
                        Mage::getConfig()->saveConfig("$namespace/license/activation_code", "", "default", "0");
                        Mage::helper("licensemanager")->log(ucfirst($namespace), $registered_version, $base_url, $activation_key, 'uninstall -> success:' . $wgs_message);
                        Mage::getConfig()->cleanCache();
                        echo "<form action='http://www.wyomind.com/license_activation/?method=post' id='license_uninstall' method='post'>
                                    <input type='hidden' type='action' value='uninstall' name='action'>
                                    <input type='hidden' value='" . $base_url . "' name='domain'>
                                    <input type='hidden' value='" . $activation_key . "' name='activation_key'>
                                    <input type='hidden' value='" . $registered_version . "' name='registered_version'>
                                    <button type='submit'>If nothing happens click here !</button>
                                    <script language='javascript'>
                                            document.getElementById('license_uninstall').submit();
                                    </script>
                            </form>";
                        die();
                        break;
                    default :
                        Mage::getSingleton("core/session")->addError("An error occurs while retrieving the license activation (500)");
                        Mage::getConfig()->saveConfig("$namespace/license/activation_code", "", "default", "0");
                        Mage::helper("licensemanager")->log(ucfirst($namespace), $registered_version, $base_url, $activation_key, 'uninstall -> unknown');
                        Mage::getConfig()->cleanCache();
                        break;
                }
            } else {
                Mage::getSingleton("core/session")->addError("An error occurs while retrieving license activation (404).");
            }
        } else
            Mage::getSingleton("core/session")->addError("Invalid activation key.");

        $this->loadLayout();
        $this->renderLayout();
    }

}