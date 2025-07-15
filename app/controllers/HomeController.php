<?php
class HomeController extends Controller {
    public function index() {
        $movieModel = $this->model('Movie');
        $movies = $movieModel->getAllPublished();
        $this->view('home/index', ['movies' => $movies]);
    }
}
