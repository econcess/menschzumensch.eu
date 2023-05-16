<?php

namespace GeorgRinger\ExtbaseRecordsWithNoL10nParent\Xclass;

use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration as ExtensionConfigurationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser;

/**
 * Xclass to add missing language statement
 */
class XclassTypo3DbQueryParser extends Typo3DbQueryParser
{

    /**
     * Builds the language field statement
     *
     * @param string $tableName The database table name
     * @param string $tableAlias The table alias used in the query.
     * @param QuerySettingsInterface $querySettings The TYPO3 CMS specific query settings
     * @return string
     */
    protected function getLanguageStatement($tableName, $tableAlias, QuerySettingsInterface $querySettings)
    {
        if (empty($GLOBALS['TCA'][$tableName]['ctrl']['languageField'])) {
            return '';
        }

        if (!$this->handleTable($tableName)) {
            return parent::getLanguageStatement($tableName, $tableAlias, $querySettings);
        }

        // Select all entries for the current language
        // If any language is set -> get those entries which are not translated yet
        // They will be removed by \TYPO3\CMS\Frontend\Page\PageRepository::getRecordOverlay if not matching overlay mode
        $languageField = $GLOBALS['TCA'][$tableName]['ctrl']['languageField'];

        $transOrigPointerField = $GLOBALS['TCA'][$tableName]['ctrl']['transOrigPointerField'] ?? '';
        if (!$transOrigPointerField || !$querySettings->getLanguageUid()) {
            return $this->queryBuilder->expr()->in(
                $tableAlias . '.' . $languageField,
                [(int)$querySettings->getLanguageUid(), -1]
            );
        }

        $mode = $querySettings->getLanguageOverlayMode();
        if (!$mode) {
            return $this->queryBuilder->expr()->in(
                $tableAlias . '.' . $languageField,
                [(int)$querySettings->getLanguageUid(), -1]
            );
        }

        $defLangTableAlias = $tableAlias . '_dl';
        $defaultLanguageRecordsSubSelect = $this->queryBuilder->getConnection()->createQueryBuilder();
        $defaultLanguageRecordsSubSelect
            ->select($defLangTableAlias . '.uid')
            ->from($tableName, $defLangTableAlias)
            ->where(
                $defaultLanguageRecordsSubSelect->expr()->andX(
                    $defaultLanguageRecordsSubSelect->expr()->eq($defLangTableAlias . '.' . $transOrigPointerField, 0),
                    $defaultLanguageRecordsSubSelect->expr()->eq($defLangTableAlias . '.' . $languageField, 0)
                )
            );

        $andConditions = [];
        // records in language 'all'
        $andConditions[] = $this->queryBuilder->expr()->eq($tableAlias . '.' . $languageField, -1);
        // translated records where a default translation exists
        $andConditions[] = $this->queryBuilder->expr()->andX(
            $this->queryBuilder->expr()->eq($tableAlias . '.' . $languageField, (int)$querySettings->getLanguageUid()),
            $this->queryBuilder->expr()->in(
                $tableAlias . '.' . $transOrigPointerField,
                $defaultLanguageRecordsSubSelect->getSQL()
            )
        );
        // XCLASS begin
        // records in translation with no default language
        $andConditions[] = $this->queryBuilder->expr()->andX(
            $this->queryBuilder->expr()->eq($tableAlias . '.' . $languageField, (int)$querySettings->getLanguageUid()),
            $this->queryBuilder->expr()->eq($tableAlias . '.' . $transOrigPointerField, 0)
        );
        // XCLASS end
        if ($mode !== 'hideNonTranslated') {
            // $mode = TRUE
            // returns records from current language which have default translation
            // together with not translated default language records
            $translatedOnlyTableAlias = $tableAlias . '_to';
            $queryBuilderForSubselect = $this->queryBuilder->getConnection()->createQueryBuilder();
            $queryBuilderForSubselect
                ->select($translatedOnlyTableAlias . '.' . $transOrigPointerField)
                ->from($tableName, $translatedOnlyTableAlias)
                ->where(
                    $queryBuilderForSubselect->expr()->andX(
                        $queryBuilderForSubselect->expr()->gt($translatedOnlyTableAlias . '.' . $transOrigPointerField, 0),
                        $queryBuilderForSubselect->expr()->eq($translatedOnlyTableAlias . '.' . $languageField, (int)$querySettings->getLanguageUid())
                    )
                );
            // records in default language, which do not have a translation
            $andConditions[] = $this->queryBuilder->expr()->andX(
                $this->queryBuilder->expr()->eq($tableAlias . '.' . $languageField, 0),
                $this->queryBuilder->expr()->notIn(
                    $tableAlias . '.uid',
                    $queryBuilderForSubselect->getSQL()
                )
            );
        }

        return $this->queryBuilder->expr()->orX(...$andConditions);
    }

    protected function handleTable(string $tableName): bool
    {
        try {
            $settings = GeneralUtility::makeInstance(ExtensionConfigurationService::class)->get('extbase_with_no_l10n_parent');
            if (is_array($settings) && isset($settings['tables'])) {
                if ($settings['tables'] === '*') {
                    return true;
                }

                return GeneralUtility::inList($settings['tables'], $tableName);
            }
        } catch (ExtensionConfigurationExtensionNotConfiguredException $e) {
            return false;
        } catch (ExtensionConfigurationPathDoesNotExistException $e) {
            return false;
        }

        return false;
    }

}
