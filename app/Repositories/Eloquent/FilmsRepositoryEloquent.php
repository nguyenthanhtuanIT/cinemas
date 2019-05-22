<?php

namespace App\Repositories\Eloquent;

use App\Models\Films;
use App\Models\Vote;
use App\Presenters\FilmsPresenter;
use App\Repositories\Contracts\filmsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class FilmsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class FilmsRepositoryEloquent extends BaseRepository implements FilmsRepository {
	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model() {
		return Films::class;
	}

	/**
	 * Specify Presenter class name
	 *
	 * @return string
	 */
	public function presenter() {
		return FilmsPresenter::class;
	}

	/**
	 * Boot up the repository, pushing criteria
	 */
	public function boot() {
		$this->pushCriteria(app(RequestCriteria::class));
	}
	public function create(array $attributes) {
		$attributes['vote_number'] = 0;
		$attributes['register_number'] = 0;
		$attributes['curency'] = 'đ';

		$name = $attributes['img']->store('photos');
		$link = Storage::url($name);
		$attributes['img'] = $link;
		$film = parent::create($attributes);
		return response()->json($film);
	}
	public function update(array $attributes, $id) {

		if (isset($attributes['img'])) {
			$name = $attributes['img']->store('photos');
			$link = Storage::url($name);
			$attributes['img'] = $link;

			$img = Films::find($id);
			$imgold = $img->img;
			$nameimg = explode('/', $imgold);
			// dd($nameimg[5]);

			Storage::delete('/photos/' . $nameimg[5]);

		}

		$film = parent::update($attributes, $id);

		return response()->json($film);
	}
	public function getlistFilm() {
		$time = Carbon::now();
		$films = $this->model()::whereMonth('projection_date', $time->month)->whereYear('projection_date', $time->year)->get();
		return $films;
	}
	public function maxVoteNumber() {
		$vote = Vote::where('status_vote', 2)->select('id', 'status_vote')->first();
		$max = $this->model()::where('vote_id', $vote->id)->max('vote_number');
		$film = $this->model()::where('vote_id', $vote->id)->where('vote_number', $max)->get()->random();
		return $film;
	}
	public function searchFilms($keyword) {
		$data = $this->model()::where('projection_date', $keyword)->orwhere('type_cinema_id', $keyword)->get();
		return $data;
	}

}
