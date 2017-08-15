<?php

/**
 * Smarty Method ConfigLoad
 *
 * Smarty::configLoad() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_ConfigLoad
{
    /**
     * Valid for all objects
     *
     * @var int
     */
    public $objMap = 7;

    /**
     * load a configs file, optionally load just selected sections
     *
     * @api  Smarty::configLoad()
     * @link http://www.smarty.net/docs/en/api.config.load.tpl
     *
     * @param \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty $data
     * @param  string                                                 $config_file filename
     * @param  mixed                                                  $sections    array of section names, single
     *                                                                             section or null
     *
     * @return \Smarty|\Smarty_Internal_Data|\Smarty_Internal_Template
     * @throws \SmartyException
     */
    public function configLoad(Smarty_Internal_Data $data, $config_file, $sections = null)
    {
        $this->_loadConfigFile($data, $config_file, $sections, null);
        return $data;
    }

    /**
     * load a configs file, optionally load just selected sections
     *
     * @api  Smarty::configLoad()
     * @link http://www.smarty.net/docs/en/api.config.load.tpl
     *
     * @param \Smarty|\Smarty_Internal_Data|\Smarty_Internal_Template $data
     * @param  string                                                 $config_file filename
     * @param  mixed                                                  $sections    array of section names, single
     *                                                                             section or null
     * @param int                                                     $scope       scope into which configs variables
     *                                                                             shall be loaded
     *
     * @return \Smarty|\Smarty_Internal_Data|\Smarty_Internal_Template
     * @throws \SmartyException
     */
    public function _loadConfigFile(Smarty_Internal_Data $data, $config_file, $sections = null, $scope = 0)
    {
        /* @var \Smarty $smarty */
        $smarty = isset($data->smarty) ? $data->smarty : $data;
        /* @var \Smarty_Internal_Template $confObj */
        $confObj = new Smarty_Internal_Template($config_file, $smarty, $data);
        $confObj->caching = Smarty::CACHING_OFF;
        $confObj->source = Smarty_Template_Config::load($confObj);
        $confObj->source->config_sections = $sections;
        $confObj->source->scope = $scope;
        $confObj->compiled = Smarty_Template_Compiled::load($confObj);
        $confObj->compiled->render($confObj);
        if ($data->_objType == 2) {
            $data->compiled->file_dependency[ $confObj->source->uid ] =
                array($confObj->source->filepath, $confObj->source->getTimeStamp(), $confObj->source->type);
        }
    }

    /**
     * load configs variables into template object
     *
     * @param \Smarty_Internal_Template $tpl
     * @param  array                    $new_config_vars
     *
     */
    public function _loadConfigVars(Smarty_Internal_Template $tpl, $new_config_vars)
    {
        $this->_assignConfigVars($tpl->parent->config_vars, $tpl, $new_config_vars);
        $tagScope = $tpl->source->scope;
        if ($tagScope >= 0) {
            if ($tagScope == Smarty::SCOPE_LOCAL) {
                $this->_updateVarStack($tpl, $new_config_vars);
                $tagScope = 0;
                if (!$tpl->scope) {
                    return;
                }
            }
            if ($tpl->parent->_objType == 2 && ($tagScope || $tpl->parent->scope)) {
                $mergedScope = $tagScope | $tpl->scope;
                if ($mergedScope) {
                    // update scopes
                    foreach ($tpl->smarty->ext->_updateScope->_getAffectedScopes($tpl->parent, $mergedScope) as $ptr) {
                        $this->_assignConfigVars($ptr->config_vars, $tpl, $new_config_vars);
                        if ($tagScope && $ptr->_objType == 2 && isset($tpl->_cache[ 'varStack' ])) {
                            $this->_updateVarStack($tpl, $new_config_vars);
                        }
                    }
                }
            }
        }
    }

    /**
     * Assign all configs variables in given scope
     *
     * @param array    $config_vars configs variables in scope
     * @param \Smarty_Internal_Template $tpl
     * @param  array                    $new_config_vars loaded configs variables
     */
    public function _assignConfigVars(&$config_vars, Smarty_Internal_Template $tpl, $new_config_vars)
    {
        // copy global configs vars
        foreach ($new_config_vars[ 'vars' ] as $variable => $value) {
            if ($tpl->smarty->config_overwrite || !isset($config_vars[ $variable ])) {
                $config_vars[ $variable ] = $value;
            } else {
                $config_vars[ $variable ] = array_merge((array) $config_vars[ $variable ], (array) $value);
            }
        }
        // scan sections
        $sections = $tpl->source->config_sections;
        if (!empty($sections)) {
            foreach ((array) $sections as $tpl_section) {
                if (isset($new_config_vars[ 'sections' ][ $tpl_section ])) {
                    foreach ($new_config_vars[ 'sections' ][ $tpl_section ][ 'vars' ] as $variable => $value) {
                        if ($tpl->smarty->config_overwrite || !isset($config_vars[ $variable ])) {
                            $config_vars[ $variable ] = $value;
                        } else {
                            $config_vars[ $variable ] = array_merge((array) $config_vars[ $variable ], (array) $value);
                        }
                    }
                }
            }
        }
    }

    /**
     * Update configs variables in template local variable stack
     *
     * @param \Smarty_Internal_Template $tpl
     * @param array                     $config_vars
     */
    public function _updateVarStack(Smarty_Internal_Template $tpl, $config_vars)
    {
        $i = 0;
        while (isset($tpl->_cache[ 'varStack' ][ $i ])) {
            $this->_assignConfigVars($tpl->_cache[ 'varStack' ][ $i ][ 'configs' ], $tpl, $config_vars);
            $i ++;
        }
    }

    /**
     * gets  a configs variable value
     *
     * @param \Smarty_Internal_Template $tpl     template object
     * @param string                    $varName the name of the configs variable
     * @param bool                      $errorEnable
     *
     * @return mixed  the value of the configs variable
     */
    public function _getConfigVariable(Smarty_Internal_Template $tpl, $varName, $errorEnable = true)
    {
        $_ptr = $tpl;
        while ($_ptr !== null) {
            if (isset($_ptr->config_vars[ $varName ])) {
                // found it, return it
                return $_ptr->config_vars[ $varName ];
            }
            // not found, try at parent
            $_ptr = $_ptr->parent;
        }
        if ($tpl->smarty->error_unassigned && $errorEnable) {
            // force a notice
            $x = $$varName;
        }
        return null;
    }
}
