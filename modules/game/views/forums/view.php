<h1><?php echo $thread->title; ?></h1>
<p>Créé le : <?php echo $thread->time_created; ?></p>
<ul>
  <? foreach ($thread->posts as $post): ?>
  <li>
    <p><b><?php echo $post->from; ?></b> le <?php echo $post->time_created; ?> a écrit :</p>
    <p><?php echo $post->message; ?></p>
  </li>
  <? endforeach; ?>
</ul>
<form action="<?php echo url::site('forum/reply'); ?>" method="post">
  <fieldset>
    <legend>Réponse :</legend>
    <input type="hidden" name="thread_id" value="<?php echo $thread->id; ?>" />
    <p>
      <label for="message">Message :</label>
      <br/>
      <textarea name="message" cols="50" rows="5"></textarea>
    </p>
    <p>
      <input type="submit" value="Répondre" />
    </p>
  </fieldset>
</form>
