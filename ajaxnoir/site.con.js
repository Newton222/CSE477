/*! DO NOT EDIT ajaxnoir 2018-04-24 */
function Login(sel) {

    var form = $(sel);
    form.submit(function(event) {
        event.preventDefault();
        console.log("Submitted");
        $.ajax({
            url: "post/login.php",
            data: form.serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                console.log(json);
                if(json.ok) {
                    // Login was successful
                    window.location.assign("./");
                } else {
                    // Login failed, a message is in json.message
                    $(sel + " .message").html("<p>" + json.message + "</p>");
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
                // An error!
                $(sel + " .message").html("<p>Error: " + error + "</p>");
            }
        });

    });
}
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
function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}
function Stars(sel) {
    this.form = $(sel);
    this.msg = $(sel + " .message");
    this.movieTable = $(sel + " .table");

    var table = $(sel + " table");  // The table tag
    console.log("Stars constructor111");
    // Loop over the table rows
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Determine the row ID
        var id = row.find('input[name="id"]').val();

        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<stars.length; s++) {
            var star = $(stars.get(s));

            // We are at a star
            this.installListener(row, star, id, s+1);
        }

    }
}

Stars.prototype.installListener = function(row, star, id, rating) {
    var that = this;

    star.click(function() {

        console.log("Click on " + id + " rating: " + rating);
        $.ajax({
            url: "post/stars.php",
            data: {id: id, rating: rating},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Successfully updated
                    that.message("<p>Successfully updated</p>");
                    that.update(row, rating);
                    var movies = json.movies;
                    that.updateTable(movies);

                } else {
                    // Update failed
                    that.message("<p>Update failed</p>");

                }
            },
            error: function(xhr, status, error) {
                // Error
                that.message("<p>Error: " + error + "</p>");
            }
        });
    });
}

Stars.prototype.update = function(row, rating) {
    // Loop over the stars, setting the correct image
    var stars = row.find("img");
    for(var s=0; s<stars.length; s++) {
        var star = $(stars.get(s));
        if(s < rating) {
            star.attr("src", "images/star-green.png")
        } else {
            star.attr("src", "images/star-gray.png");
        }

        var num = row.find("span.num");
        num.text("" + rating + "/10");

    }

}

Stars.prototype.message = function(message) {
    // do something...
    //console.log(message);
    var that = this;
    var msg = that.msg;
    msg.hide().fadeIn(500);
    msg.html(message);
    msg.delay(2000).fadeOut(500);
}

Stars.prototype.updateTable = function (movies) {
    //console.log(movies);
    var that = this;
    var table = that.movieTable;

    var html = "<table>\n" +
        "<tr><th>&nbsp;</th><th>Title</th><th>Year</th><th>Rating</th></tr>";

    for (var i=0; i<movies.length; i++){
        var movie = movies[i];
        //console.log(movie);
        var title = movie['title'];
        var year = movie['year'];
        var rating = movie['rating'];
        var id = movie['id'];

        var stars;
        if(rating === null){
            stars = "not rated";
        }else{
            var j = parseInt(rating, 10);
            stars = '<span class="stars">'+
                '<img src="images/star-green.png">'.repeat(j) +
                '<img src="images/star-gray.png">'.repeat(10-j) +
                '</span> <span class="num">' +
                j + '/10</span>';
        }
        //console.log(stars);

        html += '<tr><td><input type="radio" value="' + id + '" name="id"></td>' +
            '<td>' + title + '</td><td>' + year + '</td><td>' + stars + '</td>' +
            '</tr>';

    }

    html += "</table>";
    table.html(html);

    // Loop over the table rows
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Determine the row ID
        var id = row.find('input[name="id"]').val();

        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<stars.length; s++) {
            var star = $(stars.get(s));

            // We are at a star
            this.installListener(row, star, id, s+1);
        }

    }
}