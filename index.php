<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="display-container">
        <div class="search">
            <div class="unselect modal-button" id="modal">Open Modal</div>
            <input type="text" id="searchbar" onkeyup="search()">
        </div>
        <div class="header">
            <div class="class section title">Task</div>
            <div class="class section title">Title</div>
            <div class="class section title">Description</div>
            <div class="class section title">Color</div>
        </div>
        <div class="body"></div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
    $(document).ready(function() {
        (function getRecords() {
            let body = $(".body");
            $.ajax({
                type: "POST",
                url: "handleRequest.php",
                data: {
                    url: "https://api.baubuddy.de/dev/index.php/v1/tasks/select"
                },
                success: function(response) {
                    let res = $.parseJSON(response);
                    body.empty();
                    $.each(res, function(key, value) {
                        body.append(
                            `<div class="row">
                                <div class="cell section title">` + value.task + `</div>
                                <div class="cell section title">` + value.title + `</div>
                                <div class="cell section title">` + value.description + `</div>
                                <div class="cell section title" style="background-color: ` + value.colorCode + `"></div>
                            </div>`
                        );
                        setTimeout(getRecords, 60 * (60 * 1000));
                    });
                }
            });
        })()
    });

    function search() {
        var input, filter, row, td, cell, value;
        input = $("#searchbar");
        filter = input.val().toUpperCase();
        row = $(".row");

        for (let i = 0; i < row.length; i++) {
            row[i].style.display = "none";

            td = row[i].getElementsByClassName("cell");
            for (let j = 0; j < td.length; j++) {
                cell = row[i].getElementsByClassName("cell")[j];
                if(cell) {
                    if(cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        row[i].style.display = "flex";
                        break;
                    }
                }
            }
        }
    }
</script>

<style>
    html, body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .display-container {
        height: 100%;
        padding: 10px;
    }

    .display-container .modal-button {
        display: inline-block;
	    font-weight: 400;
	    color: #6c757d;
	    text-align: center;
	    border: 1px solid #6c757d;
	    padding: 0px 10px;
	    font-size: 1rem;
	    line-height: 1.5;
	    border-radius: .25rem;
	    color: #6c757d;
    	background-color: #ffffff;

        margin-bottom: 5px;
        cursor: pointer;
    }

    .display-container .search {
        width: 100%;
    }

    .display-container .search input {
        float: right;
        margin-bottom: 5px;
        outline: none;
    }

    .display-container .header {
        height: 100%;
        display: flex;
        padding: 5px;
        border: 1px solid black;
        margin-bottom: 5px;
    }

    .display-container .header .section {
        width: calc(100% / 4);
        text-align: center;
        border-left: 1px solid black;
        font-size: 15px;
    }

    .display-container .header .section:nth-child(1) {
        border-left: none;
    }

    .display-container .body {
        height: 100%;
        padding: 5px;
        border: 1px solid black;
    }

    .display-container .body .row {
        display: flex;
        margin-bottom: 5px;
    }

    .display-container .body .section {
        width: calc(100% / 4);
        padding: 5px;
        display: flex;
        text-align: center;
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        font-size: 15px;
    }
</style>