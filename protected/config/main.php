<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'HappyMoments.ua',
    'language'=>'ru',
    'sourceLanguage'=>'en',
    'theme'=>'hm-theme',
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.extensions.EAjaxUpload.*',
		'application.extensions.Upload.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
		'admin'=>array(
		            'layoutPath' => 'protected/modules/admin/views/layouts',
		            'layout' => 'column2'
		        ),
		'my'=>array(
       		 ),
		'crm'=>array(
		            'layoutPath' => 'protected/modules/crm/views/layouts',
		            'layout' => 'column2'
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
            'class'=>'UrlManager',
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
                'my/<controller:\w+>'=>'my/<controller>/index',
                'my/<controller:\w+>/<action:\w+>'=>'my/<controller>/<action>',
                'admin/<controller:\w+>'=>'admin/<controller>/index',
                'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',               
                'crm/<controller:\w+>'=>'crm/<controller>/index',
                'crm/<controller:\w+>/<action:\w+>'=>'crm/<controller>/<action>',
                
                '<language:(ru|uk)>/id<id:\d+>'=>'user/view',
                'id<id:\d+>'=>'user/view',
                '<language:(ru|uk)>/id<id:\d+>/prices'=>'user/prices',
                'id<id:\d+>/prices'=>'user/prices',
                '<language:(ru|uk)>/id<id:\d+>/calendar'=>'user/calendar',
                'id<id:\d+>/calendar'=>'user/calendar',               
                
                '<language:(ru|uk)>/<city:\w+>/site/<action:\w+>'=>'site/<action>',
                '<language:(ru|uk)>/site/<action:\w+>'=>'site/<action>',
                '<city:\w+>/site/<action:\w+>'=>'site/<action>',
                'site/<action:\w+>'=>'site/<action>',
                
                /*'actions/<id:\d+>'=>'actions/view',
                '<city:\w+>/actions/<id:\d+>'=>'actions/view',
                '<language:(ru|uk)>/actions/<id:\d+>'=>'actions/view',
                '<language:(ru|uk)>/<city:\w+>/actions/<id:\d+>'=>'actions/view',*/
                
                '<language:(ru|uk)>/<city:\w+>/news/<id:\d+>'=>'page/news',
                '<language:(ru|uk)>/news/<id:\d+>'=>'page/news',
                '<city:\w+>/news/<id:\d+>'=>'page/news',
                'news/<id:\d+>'=>'page/news',                
                
                '<language:(ru|uk)>/<city:\w+>/<action:(advertisment|vacancis|help_us|news|about|hmagent|accounts|politic|user_agreement)>'=>'page/<action>',
                '<language:(ru|uk)>/<action:(advertisment|vacancis|help_us|news|about|hmagent|accounts|politic|user_agreement)>'=>'page/<action>',
                '<city:\w+>/<action:(advertisment|vacancis|help_us|news|about|hmagent|accounts|politic|user_agreement)>'=>'page/<action>',
                '<action:(advertisment|vacancis|help_us|news|about|hmagent|accounts|politic|user_agreement)>'=>'page/<action>',
                //'<language:(ru|uk)>/<city:\w+>/<action:(advertisment|vacancis|help_us|news|about|hmagent|accounts)>'=>'page/<action>',
                
                /*'<language:(ru|uk)>/<city:\w+>/<id:\w+>'=>'cat/view',
                '<city:\w+>/<id:\w+>'=>'cat/view',
                '<id:\w+>'=>'cat/view',*/
                
                '<language:(ru|uk)>/<city:\w+>/<controller:(tenders|actions|freefoto|register)>'=>'<controller>/index',
                '<language:(ru|uk)>/<controller:(tenders|actions|freefoto|register)>'=>'<controller>/index',
                '<city:\w+>/<controller:(tenders|actions|freefoto|register)>'=>'<controller>/index',
                '<controller:(tenders|actions|freefoto|register)>'=>'<controller>/index',
                
                '<language:(ru|uk)>/<city:\w+>/register/<action:\w+>'=>'register/<action>',
                '<language:(ru|uk)>/register/<action:\w+>'=>'register/<action>',
                '<city:\w+>/register/<action:\w+>'=>'register/<action>',
                'register/<action:\w+>'=>'register/<action>',
                
                '<language:(ru|uk)>/<city:\w+>/freefoto/<action:\w+>'=>'freefoto/<action>',
                '<language:(ru|uk)>/freefoto/<action:\w+>'=>'freefoto/<action>',
                '<city:\w+>/freefoto/<action:\w+>'=>'freefoto/<action>',
                'freefoto/<action:\w+>'=>'freefoto/<action>',
                
                '<language:(ru|uk)>/<city:\w+>/<controller:(actions|tenders)>/<id:\d+>'=>'<controller>/view',
                '<language:(ru|uk)>/<controller:(actions|tenders)>/<id:\d+>'=>'<controller>/view',
                '<city:\w+>/<controller:(actions|tenders)>/<id:\d+>'=>'<controller>/view',
                '<controller:(actions|tenders)>/<id:\d+>'=>'<controller>/view',
                
                '<language:(ru|uk)>/<city:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<city:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                
                '<language:(ru|uk)>/<city:\w+>/<controller:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<city:\w+>/<controller:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/<action>',
                
                '<language:(ru|uk)>/<city:\w+>/<alias:[\w\-_]+>'=>'cat/view',
                '<language:(ru|uk)>/<alias:[\w\-_]+>'=>'cat/view',
                '<city:\w+>/<alias:[\w\-_]+>'=>'cat/view',
                '<alias:[\w\-_]+>'=>'cat/view',

                '<language:(ru|uk)>/<city:\w+>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<city:\w+>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                
                
                '<module:\w+>/<controller:\w+>'=>'<module>/<controller>/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                
                '<language:(ru|uk)>'=>'site/index',
                '<language:(ru|uk)>/<city:\w+>'=>'site/index',
                '<city:\w+>'=>'site/index',
                '/' => 'site/index',
                array('sitemap/index', 'pattern'=>'sitemap.xml', 'urlSuffix'=>''),
			),
		),		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=hm_new',
			'emulatePrepare' => true,
			'username' => 'happy_admin',
			'password' => 'Jgat5J10',
			'charset' => 'utf8',
			'tablePrefix' => 'hm2_'
		),

		/*'Smtpmail'=>array(
		            'class'=>'application.extensions.smtpmail.PHPMailer',
		            'Host'=>'smtp.mail.ru',
		            'Username'=>'hm164@mail.ua',
		            'Password'=>'hm0000164',
		            'Mailer'=>'smtp',
		            'Port'=>587,
		            'SMTPAuth'=>true,
		            'SMTPSecure' => 'tls',
	                   ),*/

		'email'=>array(
		    'class'=>'application.extensions.email.Email',
		    'delivery'=>'php' //Will use the php mailing function.  
		        //May also be set to 'debug' to instead dump the contents of the email into the view
   		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'clientScript'=>array(
		    'scriptMap'=>array(
		        'jquery.js'=>'/themes/hm-theme/js/jquery-1.11.1.min.js'),
		),
		'ih'=>array(
		            'class'=>'CImageHandler',
		),
		'session' => array (
		          'class' => 'application.components.DbHttpSession',
		          'connectionID' => 'db',
		          'sessionTableName' => 'hm2_session',
		          //'userTableName' => 'users',
		          'autoCreateSessionTable' => false,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'translatedLanguages'=> array(
                                'ru'=>'Русский',
                                'uk'=>'Українська',
        ),
        'defaultLanguage'=>'ru',
	),
);