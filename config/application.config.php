<?php
$modules = array(
        # -- MODULE APPS --
       
        #,'CoreInstall'              // Installer example
        #,'CoreShop'                 // simple shop module
        #,'CoreChat'                 // simple Chat module
    
        # -- CORE MODULE BASE --
    
        'CoreInfo'
        #'CoreBase'                  // common plugins, helpers, librarys, functions and stdlib 
                                     // service factorys for navigation, breadcrumbs, etc..
                                     // settings for others modules
        #,'CoreLogger'               // app versus users interactive logging
        #,'CoreTheme'                // layouts, themes, skins, fonts, vendors
        #,'CoreLanguage'             // language translation        
        #,'CoreConfigs'              // Config manager params
        #,'CoreConnector'            // resources for api connect restfull
        #,'CoreUserAuth'             // Auth for user (login)
        #,'CoreUsersAcl'             // Acl for manager resources versus access
        #,'CoreUsers'                // Users manager
        #,'CoreUploads'              // simple upload file
        #,'CoreSearch'               // simple document search 
        
        #'CoreNavigation',           // create dinamically menu
        #'CoreUploadsImages',        // simple upload file with resize images
        #'CoreFileManager',          // simple file manager
        #'CoreModuleGenerator',      // generate basic modules
        #'CoreAppGenerator',         // generate simple structure for front or back apps 
);

$addModulePaths = array(
      './module'
    , './vendor'    
    , './applications/apps' # auto load modules
);

$addVendor = array(
    'Core'    => __DIR__ . '/../vendor/Core',
);

foreach ($addModulePaths as $moduleDir) {
    
    // ignore o core do zend se encarrega de carrega-los
    if( ($moduleDir == './module') or  ($moduleDir == './vendor') ){
        continue;
    }
    
    $modulePath = PATH_APPLICATION . str_replace('./', '/', $moduleDir);    
    
    // se nao existe diretorio 
    if(!is_dir($modulePath)){
        continue;
    }
    
    $applicationsPaths = new DirectoryIterator($modulePath);
    
    foreach ($applicationsPaths as $dir) {

        if ($dir->isDot() or !$dir->isDir() or strstr($dir->getFileName(), '.ignore') ) {
            continue;
        }

        $filename  = $dir->getFileName();
        $modules[] = $filename;
    }    
    
}

return array(
    'autoloader' => array(
        'namespaces' => $addVendor,
        'autoregister_zf'  => true,
    ),
    'modules' => $modules,
    'module_listener_options' => array(
        'module_paths' => $addModulePaths,
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),

        // Whether or not to enable a configuration cache.
        // If enabled, the merged configuration will be cached and used in
        // subsequent requests.
        //'config_cache_enabled' => $booleanValue,

        // The key used to create the configuration cache file name.
        //'config_cache_key' => $stringKey,

        // Whether or not to enable a module class map cache.
        // If enabled, creates a module class map cache which will be used
        // by in future requests, to reduce the autoloading process.
        //'module_map_cache_enabled' => $booleanValue,

        // The key used to create the class map cache file name.
        //'module_map_cache_key' => $stringKey,

        // The path in which to cache merged configuration.
        //'cache_dir' => $stringPath,

        // Whether or not to enable modules dependency checking.
        // Enabled by default, prevents usage of modules that depend on other modules
        // that weren't loaded.
        // 'check_dependencies' => true,
    ),

    // Used to create an own service manager. May contain one or more child arrays.
    //'service_listener_options' => array(
    //     array(
    //         'service_manager' => $stringServiceManagerName,
    //         'config_key'      => $stringConfigKey,
    //         'interface'       => $stringOptionalInterface,
    //         'method'          => $stringRequiredMethodName,
    //     ),
    // )

   // Initial configuration with which to seed the ServiceManager.
   // Should be compatible with Zend\ServiceManager\Config.
   // 'service_manager' => array(),
);
