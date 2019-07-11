<?php

namespace App\Models;

/**
 * Class Statistical.
 *
 * @package namespace App\Models;
 */
class Statistical extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['vote_id', 'films_id', 'amount_votes', 'movie_selected'];

    /**
     * Get name of vote
     * @return string
     */
    public function getVote()
    {
        $name = Vote::find($this->vote_id);
        return $name->name_vote;
    }

    /**
     * Get name of film
     * @return string
     */
    public function getNameFilms()
    {
        $name = Films::find($this->films_id);
        return $name->name_film;
    }
}
