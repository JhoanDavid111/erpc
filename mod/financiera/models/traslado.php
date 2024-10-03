<?php
// trstransacciones
class Traslado {

    private $idtrs;
    private $perid;
    private $fhtrs;
    private $iddpa;
    private $tptrs;
    private $idpro;
    private $idflu;
    private $monto;
    private $db;

    public function __construct() {
        $this->db = conexion::get_conexion();
    }

    // Getters
    function getIdtrs() {
        return $this->idtrs;
    }

    function getPerid() {
        return $this->perid;
    }

    function getFhtrs() {
        return $this->fhtrs;
    }

    function getIddpa() {
        return $this->iddpa;
    }

    function getTptrs() {
        return $this->tptrs;
    }

    function getIdpro() {
        return $this->idpro;
    }

    function getIdflu() {
        return $this->idflu;
    }

    function getMonto() {
        return $this->monto;
    }

    // Setters
    function setIdtrs($idtrs) {
        $this->idtrs = $idtrs;
    }

    function setPerid($perid) {
        $this->perid = $perid;
    }

    function setFhtrs($fhtrs) {
        $this->fhtrs = $fhtrs;
    }

    function setIddpa($iddpa) {
        $this->iddpa = $iddpa;
    }

    function setTptrs($tptrs) {
        $this->tptrs = $tptrs;
    }

    function setIdpro($idpro) {
        $this->idpro = $idpro;
    }

    function setIdflu($idflu) {
        $this->idflu = $idflu;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    // Método para crear un nuevo registro
    public function create() {
        $sql = "INSERT INTO traslado (perid, fhtrs, iddpa, tptrs, idpro, idflu, monto) VALUES (?,?,?,?,?,?,?)";
        $insert = $this->db->prepare($sql);
        $arrdata = array($this->getPerid(), $this->getFhtrs(), $this->getIddpa(), $this->getTptrs(), $this->getIdpro(), $this->getIdflu(), $this->getMonto());
        $save = $insert->execute($arrdata);
        
        return $save;
    }
    
    // Método para editar un registro existente con monto
    public function edit() {
        $sql = "UPDATE traslado SET perid=?, fhtrs=?, iddpa=?, tptrs=?, idpro=?, idflu=?, monto=? WHERE idtrs=?";
        $update = $this->db->prepare($sql);
        $arrdata = array($this->getPerid(), $this->getFhtrs(), $this->getIddpa(), $this->getTptrs(), $this->getIdpro(), $this->getIdflu(), $this->getMonto(), $this->getIdtrs());
        $save = $update->execute($arrdata);

        return $save;
    }

    // Método para eliminar un registro
    public function delete() {
        $sql = "DELETE FROM traslado WHERE idtrs=?";
        $delete = $this->db->prepare($sql);
        $arrdata = array($this->getIdtrs());
        $save = $delete->execute($arrdata);

        return $save;
    }

    // Método para obtener un registro por su ID
    public function getById() {
        $sql = "SELECT * FROM traslado WHERE idtrs=?";
        $select = $this->db->prepare($sql);
        $select->execute(array($this->getIdtrs()));
        $record = $select->fetch(PDO::FETCH_ASSOC);

        return $record;
    }

    // Método para obtener todos los registros
    public function getAll() {
        $sql = "SELECT * FROM traslado";
        $execute = $this->db->query($sql);
        $allRecords = $execute->fetchAll(PDO::FETCH_ASSOC);

        return $allRecords;
    }

    public function getMovimientosPorIdDpa($iddpa) {
        $sql = "SELECT tptrs AS tipoMovimiento, monto, fhtrs AS fecha, idtrs, perid, iddpa, idpro, idflu FROM traslado WHERE iddpa = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$iddpa]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Log para ver el resultado de la consulta
        error_log("Resultados de la consulta: " . print_r($result, true));
    
        return $result;
    }
    

    // Método para actualizar un registro (reutilizando edit)
    public function update() {
        return $this->edit(); // Reutilizando la función 'edit' para actualizar
    }

}
?>