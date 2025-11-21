<?php

interface Requetes {
    public function requete(): string;
    public function parametresId(PDOStatement $stmt, mixed ...$ids): void;
    public function parametresObjet(PDOStatement $stmt, object $data): void;
}
?>