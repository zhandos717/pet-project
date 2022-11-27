<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;1,400&display=swap" rel="stylesheet">

    <title>Test</title>
</head>

<body>
<section class="header">
    <nav class="header__nav">
        <ul class="header__list">
            <li class="header__item">
                <a href="#!" class="header__link">Начать заново</a>
            </li>

            <li class="header__item">
                <a href="#!" class="header__link">В конец теста</a>
            </li>
        </ul>
    </nav>
</section>

<section class="test">
    <div class="test__mainBox">
        <h1 class="test__title">Online Test</h1>
        <h2 class="test__subtitle">Пройдите этот тест для того чтобы проверить свои знания</h2>
        <div class="line"></div>
    </div>
    <form action="/result" method="POST">
        <label>
            <input type="text" hidden name="uuid" value="<?= uuid()?>">
        </label>
        <?php
        if(isset($questions)):
        foreach ($questions as $key => $question):
            ?>
                <div class="test__questionBox">
                    <div class="test__question" id="test__questionBox">
                        <h3> <?=$question['id']?>) <?=$question['title']?></h3>
                    </div>
                    <?php     if(isset($question['answers'])):
                        foreach($question['answers'] as $k => $answer):
                            ?>
                    <div class="form_radio">
                        <input id="radio-1" type="radio" required name="<?='questions['.$question['id'].']'?>" value="<?=$answer['id']?>">
                        <label for="radio-1"><?= $answer['text'] .' No. '. $k+1 ?></label>
                    </div>
                    <?php endforeach; endif;?>
                </div>
        <?php endforeach; endif;?>
        <button class="btn" id="finishBtn" type="submit"> Закончить тест </button>
    </form>
</section>
</body>
</html>
