<?php
class HomeController extends Controller {
    public function index() {
        $movieModel = $this->model('Movie');
        $trending = $movieModel->getTrending();
        $movies = $movieModel->getAllPublished();
        $this->view('home/index', ['trending'=>$trending,'movies' => $movies]);
    }
}
