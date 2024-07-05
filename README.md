# Movie Api
## TODO
* OMDB Client
* Movie Table
* UserXMovie Table
* MovieSearchService
* MovieDataSyncService
* MovieRatingCalculatorService
* MovieRatingUpdateListener
* api key in env

## DB
* movies
* users_x_movie

## REST
* GET /api/movies
* * LIST all movies
* GET /api/movies/<id>
* * get one specific movie
* POST /api/movies/<id>/rating
* * Save rating

## Events & Specials
* On UserXMovie update throw event - "NewMovieRating"
* MovieRatingCalculator updates the Rating for the movie
* Cache Movie Data
* Save each unknown movie after OMDB API Search

## Performance Design choices
* rating will not be calculated on-the-fly but persisted in DB
* rating will be updated not in save but via listener => future listener adds job into job queue
* search will first simple search against local -> performance in search
* search will search against OMDB API if no movies are found and cache the data
* LIST & GET is just simple mysql query data

## Upcoming
* async worker job queue system 
* Laravel Octane & FrankenPHP for performance
* Varnish for cache
* swagger for docs
