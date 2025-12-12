<?php
class Commentaire {
    private string $id_commentaire;
    private string $commentaire;
    private ?string $date_;
    private string $id_joueur;

    public function __construct(string $id_commentaire, string $commentaire, ?string $date_, string $id_joueur) {
        $this->id_commentaire = $id_commentaire;
        $this->commentaire = $commentaire;
        $this->date_ = $date_;
        $this->id_joueur = $id_joueur;
    }

    public function getIdCommentaire(): string { return $this->id_commentaire; }
    public function getCommentaire(): string { return $this->commentaire; }
    public function getDate(): ?string { return $this->date_; }
    public function getIdJoueur(): string { return $this->id_joueur; }

    public function setCommentaire(string $c) { $this->commentaire = $c; }
    public function setDate(string $d) { $this->date_ = $d; }
}
?>
