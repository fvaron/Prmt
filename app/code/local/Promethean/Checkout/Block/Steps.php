<?php
/**
 * This file is part of Promethean_Checkout for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Checkout
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

/**
 * Help Block
 * @package Promethean_Checkout
 */
class Promethean_Checkout_Block_Steps extends Mage_Core_Block_Template
{
    /**
     * All available steps
     *
     * @var array
     */
    protected $_steps = array();

    /**
     * Currently active step (by code)
     *
     * @var string
     */
    protected $_activeStep;

    /**
     * Add a step
     *
     * @param string $code
     * @param string $label
     * @param string $position
     * @param string $backAllowed
     * @return Promethean_Checkout_Block_Steps
     */
    public function addStep($code, $label, $position, $backAllowed = true)
    {
        $this->_steps[$code] = array(
            'code' => $code,
            'label' => $label,
            'position' => $position,
            'back_allowed' => $backAllowed
        );

        return $this;
    }

    /**
     * Set currently active step
     *
     * @param string $code
     * @return Promethean_Checkout_Block_Steps
     */
    public function setActiveStep($code)
    {
        $this->_activeStep = $code;
        return $this;
    }

    /**
     * Retrieve all steps
     *
     * @return array
     */
    public function getSteps()
    {
        uasort($this->_steps, function($a, $b) {
            return $a['position'] > $b['position'];
        });

        $steps = new Varien_Data_Collection();
        foreach ($this->_steps as $step) {
            $stepObj = $this->_makeStep($step);
            $steps->addItem($stepObj);
        }

        return $steps;
    }

    /**
     * Retrieve steps as JSON
     *
     * @return string
     */
    public function getStepsJson()
    {
        $jsonConfig = array();
        $steps = $this->getSteps();

        foreach ($steps as $step) {
            $jsonConfig[$step->getCode()] = $step->getData();
        }

        return Mage::helper('core')->jsonEncode($jsonConfig);
    }

    /**
     * Check if step passed as argument is currently the active step
     *
     * @param string $code
     * @return bool
     */
    public function isActiveStep($code)
    {
        return ($code == $this->_activeStep);
    }

    /**
     * Factory to create Varien_Object from step data array
     *
     * @param array $step
     * @return Varien_Object
     */
    protected function _makeStep($step)
    {
        $stepObj = new Varien_Object($step);

        $css = array();
        $activeStep = ($this->_activeStep && isset($this->_steps[$this->_activeStep])) ? $this->_steps[$this->_activeStep] : false;

        if ($activeStep) {
            if ($step['code'] == $activeStep['code']) {
                $css[] = 'active';
            }
            if ($step['position'] < $activeStep['position']) {
                $css[] = 'passed';
                $stepObj->setIsPassed(true);
            }
        }

        $css = implode(' ', $css);
        $stepObj->setCss($css);

        return $stepObj;
    }
}