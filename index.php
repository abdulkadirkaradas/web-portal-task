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

<script>

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


</style>