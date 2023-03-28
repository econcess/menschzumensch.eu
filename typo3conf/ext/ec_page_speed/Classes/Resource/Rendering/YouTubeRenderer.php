<?php
namespace Econcess\PageSpeed\Resource\Rendering;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class YouTubeRenderer extends \TYPO3\CMS\Core\Resource\Rendering\YouTubeRenderer
{
    /**
     * Render for given File(Reference) html output
     *
     * @param FileInterface $file
     * @param int|string $width TYPO3 known format; examples: 220, 200m or 200c
     * @param int|string $height TYPO3 known format; examples: 220, 200m or 200c
     * @param array $options
     * @param bool $usedPathsRelativeToCurrentScript See $file->getPublicUrl()
     * @return string
     */
    public function render(FileInterface $file, $width, $height, array $options = [], $usedPathsRelativeToCurrentScript = false)
    {
        $options = $this->collectOptions($options, $file);
        $src = $this->createYouTubeUrl($options, $file);
        $attributes = $this->collectIframeAttributes($width, $height, $options);
//+1324/econcess
//+1498/econcess
//+2844/econcess
		//$pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
		//$pageRenderer->loadRequireJsModule('TYPO3/CMS/EcPageSpeed/PageSpeedWorker');
//-2844/econcess
        return sprintf(
            '<iframe data-eco-src="%s&autoplay=1"%s></iframe><div width="800" height="800" class="iframewrappervideo"><img class="lazyload" data-eco-src="https://i.ytimg.com/vi_webp/'.$this->getVideoIdFromFile($file).'/maxresdefault.webp" /><span class="youtube"><span>Um dieses Video anschauen zu können, geben Sie <a href="#" onclick="event.preventDefault(); window.CookieConsent.renew();">bitte hier Ihre Zustimmung zu den Marketing Cookies.</a></span></span></div>',
            htmlspecialchars($src, ENT_QUOTES | ENT_HTML5),
            empty($attributes) ? '' : ' ' . $this->implodeAttributes($attributes)
        );
    }
//-1498/econcess
//-1324/econcess


}