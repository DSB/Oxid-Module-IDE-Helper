<?php
class dsb_ide_helper extends oxAdminView
{
    /**
     * @var string
     */
    protected $_tpl = 'dsb_ide_helper.tpl';

    /**
     * @var array
     */
    protected $_aModuleClasses;

    /**
     * Render method
     *
     * @return string
     */
    public function render()
    {
        $oConfig = $this->getConfig();
        $delete  = $oConfig->getRequestParameter('delete') === null ? false : true;
        $create  = $oConfig->getRequestParameter('create') === null ? false : true;

        if ($delete) {
            $this->iterateParentClassFiles('delete');
        } elseif ($create) {
            $this->iterateParentClassFiles('delete', false, true);
            $this->iterateParentClassFiles('create');
        }

        $this->iterateParentClassFiles('exists', true, true);

        return $this->_tpl;
    }

    /**
     * Iterate classes, execute action and set result to view
     *
     * @param string $action                  Action to perform
     * @param bool   $blSkipDisabledModules   Whether to exclude disabled modules or not
     * @param bool   $blForceReloading        Whether to force reloading of file list
     *
     * @return void
     */
    protected function iterateParentClassFiles($action, $blSkipDisabledModules = true, $blForceReloading = false)
    {
        $aClasses = $this->getModuleClassesArray($blSkipDisabledModules, $blForceReloading);
        $aErrors  = $aSuccess = array();
        foreach ($aClasses as $aClass) {
            switch ($action) {
                case 'exists':
                    if (file_exists($aClass['fileName'])) {
                        $aSuccess[] = $aClass['fileName'];
                    } else {
                        $aErrors[] = $aClass['fileName'];
                    }
                    break;
                case 'create':
                    if (file_put_contents($aClass['fileName'], $aClass['content'])) {
                        $aSuccess[] = $aClass['fileName'];
                    } else {
                        $aErrors[] = $aClass['fileName'];
                    }
                    break;
                case 'delete':
                    if (file_exists($aClass['fileName'])) {
                        if (@unlink($aClass['fileName'])) {
                            $aSuccess[] = $aClass['fileName'];
                        } else {
                            $aErrors[] = $aClass['fileName'];
                        }
                    }
                    break;
            }
        }
        $this->assignViewVars($action, $aSuccess, $aErrors);
    }

    /**
     * Build array containing the filename with absolute path and the content for each parent class
     *
     * @param bool $blSkipDisabledModules Whether to exclude disabled modules or not
     * @param bool $blForceReloading      Whether to force reloading of list
     *
     * @return array
     */
    protected function getModuleClassesArray($blSkipDisabledModules = true, $blForceReloading = false)
    {
        if (null !== $this->_aModuleClasses && !$blForceReloading) {
            return $this->_aModuleClasses;
        }

        clearstatcache();
        /**
         * @var oxModule $oModule
         */
        $oModuleList           = oxNew('oxmodulelist');
        $aModules              = $oModuleList->getModules();
        $aDisabledModules      = $oModuleList->getDisabledModules();
        $moduleBasePath        = $this->getConfig()->getModulesDir(true);
        $this->_aModuleClasses = array();
        foreach ($aModules as $sClassName => $sModuleClasses) {
        	$aModuleClasses = explode('&', $sModuleClasses);
        	$sParentClassName = $sClassName;
            foreach ($aModuleClasses as $sModuleClass) {
                $sModuleClass = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $sModuleClass);
                if ($blSkipDisabledModules && in_array($sModuleClass, $aDisabledModules)) {
                    continue;
                }

                $aDirectories     = explode(DIRECTORY_SEPARATOR, $sModuleClass);
                $sModuleClassName = $aDirectories[count($aDirectories) - 1] . '_parent';
                unset($aDirectories[count($aDirectories) - 1]);
                $sFilePath               = $moduleBasePath . implode(DIRECTORY_SEPARATOR, $aDirectories) . DIRECTORY_SEPARATOR;
                $this->_aModuleClasses[] = array(
                    'fileName' => $sFilePath . $sModuleClassName . '.php',
                    'content'  => $this->getFileContent($sModuleClassName, $sParentClassName),
                );

                $sParentClassName = $sModuleClassName;
            }
        }

        return $this->_aModuleClasses;
    }

    /**
     * Get parent class file content
     *
     * @param string $sClassName       Name of class
     * @param string $sParentClassName Name of parent class
     *
     * @return string
     */
    protected function getFileContent($sClassName, $sParentClassName)
    {
        $sTpl = "<?php\n"
                . "/**\n"
                . " * Auto generated parent class file for auto completion in IDE's\n"
                . " * Generated by module dsb_ide_helper\n"
                . " */\n"
                . "class %s extends %s {}\n";

        return sprintf($sTpl, $sClassName, $sParentClassName);
    }

    /**
     * Assign result arrays to view
     *
     * @param string $sType    Action type
     * @param array  $aSuccess Array containing files that have been processed successfully
     * @param array  $aErrors  Array containing files that have not been processed successfully
     */
    protected function assignViewVars($sType, $aSuccess, $aErrors)
    {
        $this->addTplParam($sType . 'Success', $aSuccess);
        $this->addTplParam($sType . 'Errors', $aErrors);
        if ($sType !== 'exists') {
            $this->addTplParam('blActionPerformed', true);
        }
    }
}
