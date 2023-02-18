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
    <div class="overlay" id="overlay">
        <div class="overlay-container">
            <div class="overlay-body">
                <div class="image" id="image">
                    <div class="preview">
                        <img id="image-preview">
                    </div>
                    <div class="uploader unselect">
                        <label for="file-uploader">Upload</label>
                        <input type="file" id="file-uploader" accept="image/*" hidden>
                    </div>
                    <div class="close unselect">
                        <div class="close" id="close-btn">Close</div>
                    </div>
                </div>
            </div>
        </div>
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

        $("#modal").on("click", function() {
            let overlay = document.getElementById("overlay");
            overlay.style.display = "block";
        });

        $("#file-uploader").on("change", function() {
            var files = $("#file-uploader")[0].files;
            if(files.length > 0) {
                let image = $("#image");

                let src = URL.createObjectURL(files[0]);
                let preview = $("#image-preview");

                $("#image-preview").css("display", "block");
                $("#image-preview").attr("src", src);
            }
        });

        $("#close-btn").on("click", function() {
            $("#image-preview").css("display", "none");
            $("#image-preview").attr("src", null);
            let overlay = document.getElementById("overlay");
            overlay.style.display = "none";
        });
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

    .overlay {
        width: 100%;
        height: 100%;
        position: fixed;
        display: none;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 2;
    }

    .overlay .overlay-container {
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .overlay .overlay-container .overlay-body {
        width: 50%;
        height: 60%;
        background-color: white;
    }

    .overlay .overlay-container .overlay-body .image {
        width: 100%;
        height: 100%;
    }

    .overlay .overlay-container .overlay-body .image .preview {
        width: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
        padding: 5px;
    }

    .overlay .overlay-container .overlay-body .image .preview img {
        display: none;
        width: 90%;
    }

    .overlay .overlay-container .overlay-body .image .uploader, .overlay .overlay-container .overlay-body .image .close {
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .overlay .overlay-container .overlay-body .image .uploader label, .overlay .overlay-container .overlay-body .image .close .close {
        display: block;
        background-color: indigo;
        color: white;
        padding: 0.5rem;
        font-family: sans-serif;
        border-radius: 0.3rem;
        margin: 10px auto;
        cursor: pointer;
    }

    .unselect {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>