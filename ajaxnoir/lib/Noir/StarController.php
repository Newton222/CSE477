<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 4/24/2018
 * Time: 5:00 AM
 */

namespace Noir;


class StarController extends Controller {
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);

        $id = strip_tags($post['id']);
        $rating = strip_tags($post['rating']);

        $movies = new Movies($site);
        $success = $movies->updateRating($user, $id, $rating);

        if($success){
            $allMovies = $movies->getAll($user);
            $allMovieArray = array();
            foreach ($allMovies as $movie){
                $title = $movie->getTitle();
                $year = $movie->getYear();
                $rating = $movie->getRating();
                $id = $movie->getId();
                $movieArray = array('id'=>$id,
                    'year'=>$year,
                    'rating'=>$rating,
                    'title'=>$title);
                $allMovieArray[] = $movieArray;
            }
            $this->result = json_encode(array('ok' => true, 'movies' => $allMovieArray));
        }
        else{
            $this->result = json_encode(array('ok' => false, 'message' => "Failed to update database!"));
        }
    }

}