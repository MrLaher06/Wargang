<h1>All Threads</h1>

<ul>
<? foreach($threads as $thread): ?>
    <li>
        <?=html::anchor('forum/view/'.$thread->id, $thread->title)?><br/>
        <?=$thread->time_created?>
    </li>
<? endforeach; ?>
</ul>