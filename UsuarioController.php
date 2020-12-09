<?php
    use \Firebase\JWT\JWT;
        
    use Slim\Psr7\Response;

    include_once 'Usuario.php';
    include_once 'UsuarioDAO.php';

    class UsuarioController{
        private $secretKey = 'sen@c';

        public function inserir($request, $response, $args){
            $body = $request->getParseBody();

            $usuario = new Usuario(0, $body['matricula'], $body['nome'], $body['email'], $body['senha']);

            $dao = new UsuarioDAO;
            $usuario = $dao->inserir($usuario);

            return $response->withJson($usuario,201);
        }

        public function autenticar($request, $response, $args){
            $user = $request->getParsedBody();

            $dao = new UsuarioDAO;
            $usuario = $dao->buscarPorLogin($user['email']);
            if($usuario->senha == $user['senha']){
                $token = array(
                    'user' => strval($usuario->id),
                    'nome' => $usuario->nome
                );

                $jwt = JWT::encode($token, $this->secretKey);
                return $response->withJson(['token' =>$jwt, 201])
                                ->withHeader('Content-Type', 'application/json');
            }else{
                return $response-withStatus(401);
            }
        }

        public function validarToken($resquest, $handler){

            $response = new Response();
            $token = $request->getHeader('Authorization');

            if($token && $token[0]){
                try {
                    $decoded = JWT::decode($token[0], $this->secretKey, array('HS256'));

                    if($decoded){
                        $response = $handler->handle($request);
                        return $response;
                    } 

                } catch(Exception $error) {
                    return $response->withStatus(401);
                }
            }
            return $response->withStatus(401);
        }
    }

?>