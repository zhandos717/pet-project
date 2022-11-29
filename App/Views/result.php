<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/chart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
    <title>Test</title>
</head>
<body>
<section class="test">


    <div class="list">
        <div class="row">
            <div class="pie animate" style="--p:<?= $total ?? 0 ?>;--c:lightgreen"> <?= $total ?? 0 ?> %</div>
            <div class="title">
                Правильный ответы <br>
                Вы набрали <?= $total ?? 0 ?> % на этом тесте
            </div>
        </div>

        <div class="row">
            <div class="pie animate content " style="--p:<?= $answers_below ?? 0 ?>;--c:red"> <?= $answers_below ?? 0 ?>
                %
            </div>
            <div class="title">
                <p>
                    Сколько процентов набрали
                    меньше вас <br>
                    <b>  <?= $answers_below ?? 0 ?>% студентов набрали больше вас</b>
                </p>
            </div>

        </div>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

    </div>
    <br>
    <a class="btn" href="/"> Начать заново </a>
</section>
<footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const xValues = ["Italy"];
        const yValues = [30];
        const barColors = ["#b91d47"];

        const newPost = {
            uuid:,
        }
        fetch('/api/results', {
            method: 'POST',
            body: JSON.stringify(newPost),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            },
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
            })
        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "World Wide Wine Production 2018"
                }
            }
        });
    </script>
    <script src="/assets/js/main.js"></script>
</footer>
</body>
</html>

