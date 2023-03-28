
plugin.tx_mwwebinare_mwlistwebinare {
    view {
        templateRootPaths.0 = EXT:mwwebinare/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_mwwebinare_mwlistwebinare.view.templateRootPath}
        partialRootPaths.0 = EXT:mwwebinare/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_mwwebinare_mwlistwebinare.view.partialRootPath}
        layoutRootPaths.0 = EXT:mwwebinare/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_mwwebinare_mwlistwebinare.view.layoutRootPath}
    }
    persistence {
        #storagePid = {$plugin.tx_mwwebinare_mwlistwebinare.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_mwwebinare_mwlistvideo {
    view {
        templateRootPaths.0 = EXT:mwwebinare/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_mwwebinare_mwlistvideo.view.templateRootPath}
        partialRootPaths.0 = EXT:mwwebinare/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_mwwebinare_mwlistvideo.view.partialRootPath}
        layoutRootPaths.0 = EXT:mwwebinare/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_mwwebinare_mwlistvideo.view.layoutRootPath}
    }
    persistence {
        #storagePid = {$plugin.tx_mwwebinare_mwlistvideo.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_mwwebinare_mwlistexperten {
    view {
        templateRootPaths.0 = EXT:mwwebinare/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_mwwebinare_mwlistexperten.view.templateRootPath}
        partialRootPaths.0 = EXT:mwwebinare/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_mwwebinare_mwlistexperten.view.partialRootPath}
        layoutRootPaths.0 = EXT:mwwebinare/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_mwwebinare_mwlistexperten.view.layoutRootPath}
    }
    persistence {
        #storagePid = {$plugin.tx_mwwebinare_mwlistexperten.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_mwwebinare_mwfaq {
    view {
        templateRootPaths.0 = EXT:mwwebinare/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_mwwebinare_mwfaq.view.templateRootPath}
        partialRootPaths.0 = EXT:mwwebinare/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_mwwebinare_mwfaq.view.partialRootPath}
        layoutRootPaths.0 = EXT:mwwebinare/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_mwwebinare_mwfaq.view.layoutRootPath}
    }
    persistence {
        #storagePid = {$plugin.tx_mwwebinare_mwfaq.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

# these classes are only used in auto-generated templates
plugin.tx_mwwebinare._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-mwwebinare table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-mwwebinare table th {
        font-weight:bold;
    }

    .tx-mwwebinare table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

page {

    includeCSS {
		file_weinarehead = EXT:mwwebinare/Resources/Public/webinarhead.css
		file_weinare = EXT:mwwebinare/Resources/Public/webinar.css
    }


    includeJSFooter {
		filemwwebinare1 = EXT:mwwebinare/Resources/Public/Isotope/js/isotope.pkgd.min.js
		filemwwebinare2 = EXT:mwwebinare/Resources/Public/Isotope/js/isotope.js
		filemwwebinare2 = EXT:mwwebinare/Resources/Public/js/webinar.js
    }
}

ajaxCall = PAGE
ajaxCall {
  typeNum = 7076123456
  config.disableAllHeaderCode = 1
  config.metaCharset = UTF-8
  
  10 = COA
  10 {
    1 = RECORDS
    1.tables = tt_content
    1.source.data = GP:tc
  }
}