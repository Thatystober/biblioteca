<?php
    use \Firebase\JWT\JWT;
        
    use Slim\Psr7\Response;

    include_once 'Usuario.php';
    include_once 'UsuarioDAO.php';

    class UsuarioController{
        private $key = '5667';

        public function inserir(Request $request, Response $response, $args){
            $body = $request->getParseBody();

            $usuario = new Usuario(0, $body['matricula'], $body['nome'], $body['email'], $body['senha']);

            $dao = new UsuarioDAO;
            $usuario = $dao->inserir($usuario);

            return $response->withJson($usuario,201);
        }

        public function autenticar(Request $request, Response $response, $args){
            $body = $request->getParsedBody();

            $dao = new UsuarioDAO;
            $usuario = $dao->buscarPorLogin($body['email']);
            if($usuario->senha == $body['senha']){
                $token = array(
                    'user' => strval($usuario->id),
                    'nome' => $usuario->nome
                );

                $jwt = JWT::encode($token, $this->key);
                return $response->withJson(['token' =>$jwt, 201])
                                ->withHeader('Content-Type', 'application/json');
            }else{
                return $response-withStatus(401);
            }
        }

        public function validarToken(Request $resquest, $handler){

            $response = new Response();
            $token = $request->getHeader('Authorization');

            if($token && $token[0]){
                try {
                    $decoded = JWT::decode($token[0], $this->key, array('HS256'));

                    if($decoded){
                        $response = $handler($request);
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