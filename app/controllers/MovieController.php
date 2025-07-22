<?php
class MovieController extends Controller
{
    public function index()
    {
        $movieModel = $this->model('Movie');
        $movieId = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($movieId) {
            $episodeList = $movieModel->getEpisodeList($movieId);
            // $movie = $movieModel->getMovieDetails($movieId); // optional

            $this->view('movie/index', [
                'episodeList' => $episodeList,
            ]);
        } else {
            die("Invalid movie ID. $movieId");
        }
    }

    public function search()
    {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';

        if ($query === '') {
            $movies = [];
        } else {
            $movieModel = $this->model('Movie');
            $movies = $movieModel->searchByTitle($query);
        }

        $this->view('movie/search', ['movies' => $movies, 'query' => $query]);
    }
}
