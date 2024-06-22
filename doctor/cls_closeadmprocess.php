<?php

class process_close{
    var $respuesta;
    private $Proceso_Id;
    private $usuario_login;
    private $ipclientaccess;
    private $sDatos;
    private $nEstado;

    public function getIdProcess() {
        return $this->Proceso_Id;
    }

    public function getUserLgn() {
        return $this->usuario_login;
    }

    public function getIpClientAcc() {
        return $this->ipclientaccess;
    }

    public function getsDato() {
        return $this->sDatos;
    }

    public function getnEstado() {
        return $this->nEstado;
    }

    public function __destruct() {

    }

    public function __construct($usuario_login, $ipclientaccess, $Proceso_Id=null, $sDatos=null, $nEstado=null) {
        $this->usuario_login = $usuario_login;
        $this->ipclientaccess = $ipclientaccess;
        $this->Proceso_Id = $Proceso_Id;
        $this->sDatos = $sDatos;
        $this->nEstado=$nEstado;
     }

    public function bca_proceso_activo(){
        require_once('conection/cnndb.php');
        require_once('alert_mensage.php');
        $Cnn = new class_conexion();
        $mysqli=$Cnn->conecta();
        try{
            $sSqlBca="SELECT pr.id AS NroProceso, mo.id AS IDMOD, mo.modalidad, ad.periodo, pr.nro_evaluaciones, pr.tp_cepunib 
                                    FROM modalidad mo INNER JOIN (proceso pr INNER JOIN admision ad ON pr.id_admision=ad.id) ON mo.id=pr.id_modalidad
                                        WHERE ad.estado=1 and mo.estado=1 and pr.estado=1 and pr.conditions=1";
                $sSqlRpta=$mysqli->query($sSqlBca);
            unset($sSqlBca);
        }catch(Exception $e){
            echo $e->getMessage();
            // $Obj_Msg = new Activate_Menssage(2, "Sucedió un error inesperado. Por favor contacte al soporte técnico.", $nCodeError);
            // $Obj_Msg->Active_menssage();
            die();
        }
        mysqli_close($mysqli);
        return $this->respuesta=$sSqlRpta;
    }

    public function upd_proceso_estado_modalidad(){
        require_once('conection/cnndb.php');
        $Cnn = new class_conexion();
        $mysqli=$Cnn->conecta();
        try{
            $sSqlUpd="UPDATE proceso SET estado=1, conditions=2, updated_at=NOW(), namehostclient='".$this->usuario_login."', nameclientconection='".$this->ipclientaccess."' WHERE id = ".$this->Proceso_Id;
            $mysqli->query($sSqlUpd);
            $sSqlRpta="Ok";
            unset($sSqlUpd);
        }catch(Exception $e){
            echo $e->getMessage();
            die();
        }
        mysqli_close($mysqli);
        return $this->respuesta=$sSqlRpta;
    }

    public function clear_tablet_primary(){
        require_once('conection/cnndb.php');
        $Cnn = new class_conexion();
        $mysqli=$Cnn->conecta();
        try{
            $mysqli->query($this->Proceso_Id);
            $sSqlRpta="Ok";
        }catch(Exception $e){
            echo $e->getMessage();
            die();
        }
        mysqli_close($mysqli);
        return $this->respuesta=$sSqlRpta;
    }
}
?>