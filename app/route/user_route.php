<?php
    use App\Model\UserModel;

    $app->group('/user/', function() {
        
        $this->get('test', function($req, $res, $args) {
            return $res
                    ->getBody()
                    ->write('Hello users');
        });

        $this->post('login', function($req, $res) {
            $um = new UserModel();
            
            return $res
                ->withHeader('Content-type', 'application/json')
                //->withHeader('Access-Control-Allow-Origin', 'http://localhost:8100') 
                //->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization') 
                //->withHeader('Access-Control-Allow-Methods', 'POST') 
                ->getBody()
                ->write(
                    json_encode(
                        $um->Login($req->getParsedBody())
                    )
                );
        });
        
    });