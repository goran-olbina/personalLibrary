<?php
    require_once 'vendor/autoload.php';
    require_once 'Configuration.php';

    ob_start();
    
    use App\Core\DatabaseConfiguration;
    use App\Core\DatabaseConnection;
    use App\Models\AdminModel;

    $databaseConfiguration = new databaseConfiguration(
        Configuration::DATABASE_HOST,     
        Configuration::DATABASE_USER,
        Configuration::DATABASE_PASSWORD,
        Configuration::DATABASE_NAME
    );
    
    $databaseConnection = new DatabaseConnection($databaseConfiguration);

    $router = new App\Core\Router();
    foreach (require_once 'Routes.php' as $route) {
        $router->add($route);
    }
    
    $url = strval(filter_input(INPUT_GET, 'URL'));
    $httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    
    $route = $router->find($httpMethod, $url);
    $arguments = $route->extractArguments($url);

    $fullControllerName = '\\App\\Controllers\\' . $route->getControllerName() . 'Controller';
    $controller = new $fullControllerName($databaseConnection);

    $sessionStorageClassName = Configuration::SESSION_STORAGE;
    $sessionStorageConstructorArguments = Configuration::SESSION_STORAGE_DATA;
    $sessionStorage = new $sessionStorageClassName(...$sessionStorageConstructorArguments);

    $fingerprintProviderFactoryClass  = Configuration::FINGERPRINT_PROVIDER_FACTORY;
    $fingerprintProviderFactoryMethod = Configuration::FINGERPRINT_PROVIDER_METHOD;
    $fingerprintProviderFactoryArgs   = Configuration::FINGERPRINT_PROVIDER_ARGS;
    $fingerprintProviderFactory       = new $fingerprintProviderFactoryClass;
    $fingerprintProvider = $fingerprintProviderFactory->$fingerprintProviderFactoryMethod(...$fingerprintProviderFactoryArgs);

    $session = new \App\Core\Session\Session($sessionStorage, Configuration::SESSION_LIFETIME);
    $session->setFingerprintProvider($fingerprintProvider);
    
    $controller->setSession($session);
    $controller->getSession()->reload();
    
    $controller->__pre();

    call_user_func_array([$controller, $route->getMethodName()], $arguments);
    $controller->getSession()->save();

    $data = $controller->getData();
    
    /*
    if($controller instanceof \App\Core\ApiController){
        ob_clean();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
    */

    $loader = new Twig_Loader_Filesystem("./views");
    $twig = new Twig_Environment($loader, [
        "cache" => "./twig-cache",
        "auto_reload" => true
    ]);

    $data['BASE'] = Configuration::BASE;

    echo $twig->render(
         $route->getControllerName() .'/'. $route->getMethodName() .'.html',
         $data
    );
    
    