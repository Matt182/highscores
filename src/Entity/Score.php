<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScoreRepository::class)
 */
class Score
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    public $name;

    /**
     * @ORM\Column(type="text")
     */
    public $difficulty;

    /**
     * @ORM\Column(type="integer")
     */
    public $score;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    public $authorised;

    //ID
    public function getId(): ?int
    {
        return $this->id;
    }

    //Name
    public function getName($name){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    //Difficulty
    public function getDifficulty($difficulty){
        return $this->difficulty;
    }

    public function setDifficulty($difficulty){
        $this->difficulty = $difficulty;
    }

    //Score
    public function getScore($score){
        return $this->score;
    }

    public function setScore($score){
        $this->score = $score;
    }

    //Authorisation
    public function getAuthorised(){
        return $this->authorised;
    }

    public function setAuthorised($authorised){
        $this->authorised = $authorised;
    }
}
