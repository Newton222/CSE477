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