<?php foreach($newsList as $news): ?>
<div>
    <a href="<?=route('news.show', ['id' => $news['id']])?>"><?=$news['title']?></a>
    <br />
    <img src="<?=$news['image']?>" style="width:200px;"><br>

    <br>
    <p><strong>Автор:</strong> <?=$news['author']?></p>
    <p><?=$news['description']?></p>
</div>
<br><hr>
<?php endforeach; ?>