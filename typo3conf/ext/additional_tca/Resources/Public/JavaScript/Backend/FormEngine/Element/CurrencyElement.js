define(['jquery', 'moment'], function (jQuery, moment) {

    /**
     *
     * @type {{}}
     * @exports TYPO3/CMS/Backend/FormEngine/Element/CurrencyElement
     */
    var CurrencyElement = {};

    /**
     * Initializes the CurrencyElement
     *
     * @param {String} selector
     * @param {Object} options
     */
    CurrencyElement.initialize = function(selector, options) {
        jQuery('document').ready(function() {
            var field = jQuery('#' + selector);
            var fieldHidden = jQuery('#' + selector + '_hidden');
            var value = field.val();
            //
            var intValue = CurrencyElement.stringToInt(value, field.attr('data-db-type'));
            fieldHidden.val(intValue);
            //
            field.on('change', function () {
                var intValue = CurrencyElement.stringToInt(jQuery(this).val(), jQuery(this).attr('data-db-type'));
                fieldHidden.val(intValue);
            });
            field.on('focus', function () {
                var field = jQuery(this);
                var value = field.val();
                value = value.replace(' €', '');
                value = value.replace('.', '');
                field.val(value);
            });
            field.on('blur', function () {
                var field = jQuery(this);
                var value = field.val();
                value = value.replace(' €', '');
                value = value.replace('.', '');
                value = value.replace(',', '.');
                value = parseFloat(value);
                field.val(CurrencyElement.formatValue(value, 2, ',', '.') + ' €');
            });
        });
    };

    CurrencyElement.formatValue = function(amount, decimalCount, decimal, thousands) {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
            var negativeSign = amount < 0 ? "-" : "";
            var i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            var j = (i.length > 3) ? i.length % 3 : 0;
            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            console.log(e)
        }
    };

    /**
     * currency to seconds
     *
     * @param value
     * @param dbType
     */
    CurrencyElement.stringToInt = function (value, dbType) {
        value = value.replace(' €', '');
        value = value.replace('.', '');
        cents = 0;
        var parts = value.split(',');
        if (parts.length === 1) {
            cents = parseInt(parts[0], 10) * 100;
        } else if (parts.length === 2) {
            var euro = parseInt(parts[0], 10);
            if (parts[1].length === 1) parts[1] + '0';
            parts[1] = parts[1].replace(/\D+/g, '');
            var cents;
            if (parts[1] === "") cents = (euro * 100);
            else {
                var cent;
                if (parts[1].length === 1) cent = parseInt(parts[1] + '0', 10);
                else if (parts[1].length > 2) cent = parseInt(parts[1].substr(0, 2), 10);
                else cent = parseInt(parts[1], 10);
                cents = (euro * 100) + cent;
            }
        } else {
            alert('CurrencyElement.stringToInt(' + value + ') failed!!');
        }
        if(dbType === 'float') {
            cents = cents / 100;
        }
        return cents;
    };

    return CurrencyElement;

});
