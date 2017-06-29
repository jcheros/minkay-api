<?php
    // Application middleware

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    // e.g: $app->add(new \Slim\Csrf\Guard);

    $app->add(function(Request $request, Response $response, callable $next){
        $route = $request->getAttribute("route");
        $this->logger->debug($route);
        $methods = [];

        if(!empty($route))
        {
            $pattern = $route->getPattern();

            foreach ($this->router->getRoutes() as $route) {
                if ($pattern === $route->getPattern()) {
                    $methods = array_merge_recursive($methods, $route->getMethods());
                }
            }
            //Methods holds all of the HTTP Verbs that a particular route handles.
        }
        else
        {
            $methods[] = $request->getMethod();
        }

        //$this->logger->debug($request);
        //$this->logger->debug($request->getMethod() . ' ' . ($route != null && !empty($route)) ? $route->getPattern() : '***', [($route != null && !empty($route)) ? $route->getArguments() : '']);
        
        $response = $next($request, $response);
        $response->withHeader('Access-Control-Allow-Origin', '*');
        $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response->withHeader("Access-Control-Allow-Methods", implode(",", $methods));

        //$this->logger->debug($response);
        //$this->logger->debug($response->getStatusCode() . ' ' . $response->getReasonPhrase(), [(string)$response->getBody()]);
        return $response;
    });