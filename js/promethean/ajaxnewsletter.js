/**
 * This file is part of Promethean_AjaxNewsletter for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_AjaxNewsletter
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

;var ajaxNewsletter = Class.create();
;ajaxNewsletter.prototype = {

    /**
     * Initialization
     *
     * @param formId
     * @param options
     */
    initialize: function (formId, options) {
        this.formId = formId;
        this.options = options || {};
        this.form = $(formId);
        this.validator = new Validation(this.form, options);
        this.buttons = $$('#' + formId + ' *[type="submit"]');
        this.messageContainer = $$('#' + formId + ' .ajax-newsletter-messages')[0];

        if (this.buttons.length > 0) {

            this.createMessageContainer();

            this.buttons.each(function (button) {
                button.setAttribute('onclick', 'return false;');
                button.observe('click', function (e) {
                    var clickedButton = e.currentTarget;

                    if (this.validator && this.validator.validate()) {

                        var parameters = this.form.serialize(true);
                        parameters.submitValue = clickedButton.value;

                        this.form.request({
                            parameters: parameters,
                            onCreate: function () {
                                this.resetFormState(clickedButton);
                            }.bind(this),
                            onComplete: function (transport) {
                                var response = transport.responseText.evalJSON();
                                this.updateFormState(response);
                            }.bind(this)
                        });
                    }
                }.bind(this));
            }.bind(this));
        }
    },

    /**
     * Create message container if it doesn't already exists
     */
    createMessageContainer: function () {
        if (typeof this.messageContainer == 'undefined') {
            this.form.insert({
                bottom: '<p class="ajax-newsletter-messages" style="display: none"></p>'
            });

            this.messageContainer = $$('#' + this.formId + ' .ajax-newsletter-messages')[0];
        } else {
            this.messageContainer.hide();
        }
    },

    /**
     * Reset form state
     *
     * @param currentClickedButton
     */
    resetFormState: function (currentClickedButton) {
        this.form.removeClassName('success');
        this.form.removeClassName('error');

        this.messageContainer.hide();

        this.buttons.each(function (button) {
            button.disable();
        });

        currentClickedButton.addClassName('loading');
    },

    /**
     * Update form state with server message
     *
     * @param response
     */
    updateFormState: function (response) {
        this.form.removeClassName('success');
        this.form.removeClassName('error');

        if (response.error == true) {
            this.form.addClassName('error');
        } else {
            this.form.addClassName('success');
        }

        this.messageContainer.update(response.message);

        /** FadeIn effect */
        new Effect.Appear(
            this.messageContainer,
            {duration: 1}
        );

        this.buttons.each(function (button) {
            button.enable().removeClassName('loading');
        });
    }
};