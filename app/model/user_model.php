<?php
    namespace App\Model;

    use App\Lib\Database;
    use App\Lib\Response;

    class UserModel
    {
        private $db;
        private $table = "usuarios";
        private $response;

        public function __CONSTRUCT()
        {
            $this->db = Database::StartUp();
            $this->response = new Response();
        }

        public function Get($usuario, $pass)
        {
            try
            {
                $result = array();
                $stm = $this->db->prepare("SELECT * FROM $this->table WHERE usuario = ? AND clave = ?");
                $stm->execute(array($usuario, $pass));

                $this->response->setResponse(true);
                $this->response->result = $stm->fetch();

                return $this->response;
            }
            catch(Exception $ex)
            {
                $this->response->setResponse(false, $ex->getMessage());
                return $this->response;
            }
        }
    }