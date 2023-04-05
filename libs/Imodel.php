<?php

    //Modelo, operaciones CRUD (Crear, leer, actualizar y borrar)


    interface IModel{
        public function save();
        public function getAll();
        public function get($id);
        public function delete($id);
        public function update();
        public function from($array);

    }


?>