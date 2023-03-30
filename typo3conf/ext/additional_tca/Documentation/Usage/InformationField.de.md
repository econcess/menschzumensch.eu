# Verwendung des Informationsfeldes

**FlexForm**

```xml
<information>
    <TCEforms>
        <exclude>0</exclude>
        <label>Support</label>
        <config>
            <type>user</type>
            <renderType>Information</renderType>
            <parameters>
                <extensionKey>questions</extensionKey>
            </parameters>
        </config>
    </TCEforms>
</information>
```

**ext_conf_template.txt**

```typo3_typoscript
# cat=extension/updateService/10; type=boolean; label= LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_ext_conf_template.extension_update_service_active
extension.updateService.active = 1

# cat=extension/updateService/20; type=string; label= LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_ext_conf_template.extension_update_service_email
extension.updateService.email = typo3@coding.ms
```
