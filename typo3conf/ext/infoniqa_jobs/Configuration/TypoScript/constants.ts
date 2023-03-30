
plugin.tx_infoniqajobs_jobs {
    view {
        # cat=plugin.tx_infoniqajobs_jobs/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:infoniqa_jobs/Resources/Private/Templates/
        # cat=plugin.tx_infoniqajobs_jobs/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:infoniqa_jobs/Resources/Private/Partials/
        # cat=plugin.tx_infoniqajobs_jobs/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:infoniqa_jobs/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_infoniqajobs_jobs//a; type=string; label=Default storage PID
        storagePid = 777
    }
}
