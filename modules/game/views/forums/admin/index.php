<h1>Admin</h1>

<form action="<?=url::site('admin/thread/delete_threads')?>" method="post">

<? foreach($threads as $thread): ?>
<p>
    <input type="checkbox" name="thread_<?=$thread->id?>"> <?=html::anchor('thread/view/'.$thread->id, $thread->title)?>
    <span style="color:#ccc"><?=$thread->time_created?></span>
</p>
<? endforeach; ?>

<input type="submit" value="Delete Threads"/>

</form>