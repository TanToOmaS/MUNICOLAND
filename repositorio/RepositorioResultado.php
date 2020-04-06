<?php

include_once("RepositorioBase.php");
include_once("../modelo/enfrentamiento.php");
include_once("../modelo/resultado.php");

class RepositorioResultado extends RepositorioBase {  
    

    function obtenerResultados($idEnfrentamiento){
        $query = $this->db->prepare("SELECT * FROM resultados WHERE R_E_ID = ?");
        $query->bindParam(1, $idEnfrentamiento);
		$query->execute();
        $resultadosDb = $query->fetchAll(PDO::FETCH_ASSOC);
        $resultados = [];
        foreach($resultadosDb as $resultadoDb){
            $resultado = $this->aResultado($resultadoDb);
            array_push($resultados,$resultado);
          
        }
        return $resultados;
    }

  
    private function aResultado($ResultadoDb){
        return new Resultado(   
            
            $ResultadoDb["R_JUEGO"],
            $ResultadoDb["R_EQ_ID"]        
        );
    }
}