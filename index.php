<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="display-container">
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
                    console.log(res);
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
</script>

<style>
    html, body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .display-container {
        height: 100%;
        padding: 10px;
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