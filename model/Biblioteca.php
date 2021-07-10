<?php

class Biblioteca {

    private $codigo;
    private $titulo;
    private $anio;
    private $autor;
    private $paginas;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAnio() {
        return $this->anio;
    }

    function getAutor() {
        return $this->autor;
    }

    function getPaginas() {
        return $this->paginas;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAnio($anio) {
        $this->anio = $anio;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }


    
}
