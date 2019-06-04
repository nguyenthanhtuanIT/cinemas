<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmsCreateRequest;
use App\Http\Requests\FilmsUpdateRequest;
use App\Repositories\Contracts\FilmsRepository;
use Illuminate\Http\Request;

/**
 * Class FilmsController.
 *
 * @package namespace App\Http\Controllers;
 */
class FilmsController extends Controller
{
    /**
     * @var FilmsRepository
     */
    protected $repository;

    /**
     * FilmsController constructor.
     *
     * @param FilmsRepository $repository
     */
    public function __construct(FilmsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = request()->get('limit', null);

        $includes = request()->get('include', '');

        if ($includes) {
            $this->repository->with(explode(',', $includes));
        }

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $films = $this->repository->paginate($limit, $columns = ['*']);

        return response()->json($films);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FilmsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $film = $this->repository->create($request->all());

        return response()->json($film, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = $this->repository->find($id);

        return response()->json($film);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FilmsUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $film = $this->repository->update($request->all(), $id);
        return response()->json($film, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(null, 204);
    }
    public function listFilmToVote()
    {
        $film = $this->repository->getlistFilmToVote();
        return $this->repository->parserResult($film);
        //return response()->json($film);
    }
    public function listMaxVote()
    {
        $list = $this->repository->listFilmMaxVote();
        return $this->repository->parserResult($list);
    }
    public function getFilmsByDate(Request $request)
    {
        $films = $this->repository->searchFilms($request->keyword);
        return $this->repository->parserResult($films);
    }
    public function getTotalTicket(Request $request)
    {
        $total = $this->repository->totalTicket($request->all());
        return response()->json(['total' => $total]);
    }
    public function getFilmToRegister()
    {
        $film = $this->repository->filmToRegister();
        return $this->repository->parserResult($film);
    }
}
