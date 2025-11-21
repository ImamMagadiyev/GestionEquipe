<?php

interface Dao {
    public function findAll(): array;
    public function findById(string $id): ?object;
    public function create(object $obj): bool;
    public function update(object $obj): bool;
    public function delete(object $obj): bool;
}
?>