<?php 

class AccionUsuario{

   private $id;
   private $idTipoAccion; /**TIPO DE ACCION compra o reserva */
   private $numAction;
   private $refAcctionUuid;
   private $nomUsuario;
   private $fechaAccion;

   public function __construct($id, $idTipoAccion, $numAction, $refAcctionUuid, $nomUsuario, $fechaAccion){
    $this->id = $id;
    $this->idTipoAccion = $idTipoAccion;
    $this->numAction = $numAction;
    $this->refAcctionUuid = $refAcctionUuid;
    $this->nomUsuario = $nomUsuario;
    $this->fechaAccion = $fechaAccion;

   }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdTipoAccion($idTipoAccion) {
        $this->idTipoAccion = $idTipoAccion;
    }

    public function setNumAction($numAction) {
        $this->numAction = $numAction;
    }

    public function setRefAccionUuid($refAcctionUuid) {
        $this->refAcctionUuid = $refAcctionUuid;
    }

    public function setNomUsuario($nomUsuario) {
        $this->nomUsuario = $nomUsuario;
    }

    public function setFechaAccion($fechaAccion) {
        $this->fechaAccion = $fechaAccion;
    }

    // GETs

    public function getId() {
        return $this->id;
    }

    public function getTipoAccion() {
        return $this->idTipoAccion;
    }

    public function getNumAction() {
        return $this->numAction;
    }

    public function getRefAcctionUuid() {
        return $this->refAcctionUuid;
    }

    public function getNomUsuario() {
        return $this->nomUsuario;
    }

    public function getFechaAccion() {
        return $this->fechaAccion;
    }


}