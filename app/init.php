<?php
session_start();
if(!require_once '_core/GlobalFunctions.php')die('No se puede obtener archivo app\_core\GlobalFunctions en el archivo :'.__FILE__.' en la linea: '.__LINE__);
if(!require_once '_core/Controller.php')die('No se puede obtener archivo app\_core\Controller en el archivo :'.__FILE__.' en la linea: '.__LINE__);
if(!require_once '_core/Model.php')die('No se puede obtener archivo app\_core\Model en el archivo :'.__FILE__.' en la linea: '.__LINE__);
if(!require_once '_core/App.php') die('No se puede obtener archivo app\_core\App en el archivo :'.__FILE__.' en la linea: '.__LINE__);
if(!require_once '_core/Session.php') die('No se puede obtener archivo app\_core\Session en el archivo :'.__FILE__.' en la linea: '.__LINE__);
foreach (glob('../app/models/*.php') as $filename){include $filename;}