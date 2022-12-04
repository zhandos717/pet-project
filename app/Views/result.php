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
    <label>
        <input id="uuid" hidden value="<?= $uuid ?? null ?>">
    </label>
    <div class="list">
        <div class="row " id="total">
        </div>
        <div class="row" id="answers_below">
        </div>
    </div>
    <br>
    <a class="btn" href="/"> Начать заново </a>
</section>
<footer>
    <script>

        function render(data){

            console.log(data)

            document.getElementById('total').innerHTML = `<div class="pie animate" style="--p:${data.total};--c:lightgreen"> ${data.total} %</div>
                      <div class="title">
                                    Правильный ответы <br>
                                    Вы набрали ${data.total} % на этом тесте
                                </div>
            `;
            document.getElementById('answers_below').innerHTML = `<div class="pie animate" style="--p:${data.answersBelow};--c:red"> ${data.answersBelow} %</div>
      <div class="title">
                <p>
                    Сколько процентов набрали
                    меньше вас <br>
                    <b>  ${data.answersBelow}% студентов набрали больше вас</b>
                </p>
            </div>`;

        }

        fetch('/api/results', {
            method: 'POST',
            body: JSON.stringify({
                uuid: document.getElementById('uuid').value,
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            },
        })
            .then((response) => response.json())
            .then((data) => {
                render(data)
            })
    </script>
</footer>
</body>
</html>

