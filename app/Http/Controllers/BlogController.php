<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Repositories\Contracts\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class BlogsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $repository;

    /**
     * BlogsController constructor.
     *
     * @param BlogRepository $repository
     */
    public function __construct(BlogRepository $repository)
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
        $blogs = $this->repository->paginate(8, $columns = ['*']);
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCreateRequest $request)
    {
        $blog = $this->repository->skipPresenter()->create($request->all());
        return response()->json($blog->presenter(), Response::HTTP_CREATED);
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
        $blog = $this->repository->find($id);
        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        $blog = $this->repository->skipPresenter()->update($request->all(), $id);
        return response()->json($blog->presenter(), Response::HTTP_OK);
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
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Search blog by title
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchBlogByTitle(Request $request)
    {
        $result = $this->repository->searchBlog($request->key);
        return $this->repository->parserResult($result);
    }

    /**
     * Get blog sort desc by id
     * @return \Illuminate\Http\Response
     */
    public function getBlog()
    {
        $result = $this->repository->getAll();
        return $this->repository->parserResult($result);
    }
}
