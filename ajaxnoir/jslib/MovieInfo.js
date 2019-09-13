function MovieInfo(sel, title, year) {
    console.log("MovieInfo: " + title + "/" + year);

    //this.paper = $(sel);

    var paper = $(sel);
    var key = 'e77c23b640548a2dfff9b85c9e7c92b7';
    var that = this;
    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key:key, query:title, year:year},
        method: "GET",
        dataType: "text",
        success: function(data){
            var json = parse_json(data);
            console.log(json);

            if(json.total_results === 0){
                paper.html('<p>No information available</p>');
            }else{
                var movie = json.results[0];
                that.displayMovie(paper, movie);
            }
        },
        error: function () {
            console.log('error');
            paper.html('<p>Unable to communicate<br>with themoviedb.org</p>');
        }
    });

}

MovieInfo.prototype.displayMovie = function(paper, movie){
    var that=this;

    console.log(movie);
    var html = '<ul>';

    var title = movie['title'];
    console.log(title);
    var release_date = movie['release_date'];
    var vote_average = movie['vote_average'];
    var vote_count = movie['vote_count'];

    html += '<li><a href=""><img src="images/info.png"></a>' +
        '<div class="show">' +
        '<p>Title:'+ title +'</p>' +
        '<p>Release Date:'+ release_date +'</p>' +
        '<p>Vote average:'+ vote_average +'</p>' +
        '<p>Vote count:'+ vote_count +'</p>' +
        '</div>' +
        '</li>';

    var overview = movie['overview'];

    html += '<li><a href=""><img src="images/plot.png"></a>' +
        '<div class="show">' +
        '<p>'+ overview +'</p>' +
        '</div>' +
        '</li>';

    var poster_path = movie['poster_path'];

    html += '<li><a href=""><img src="images/poster.png"></a>' +
        '<div class="show">'+
        '<p class="poster"><img src="http://image.tmdb.org/t/p/w500'+ poster_path + '">'+
        '</p></div>' +
        '</li>';

    html += '</ul>';
    paper.html(html);
}