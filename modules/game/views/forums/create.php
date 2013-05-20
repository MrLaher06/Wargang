<form action="<?php echo url::site('forum/create'); ?>" method="post">
  <p>
    <label for="subject">Sujet:</label>
    <br/>
    <input type="text" name="subject" />
  </p>
  <p>
    <label for="message">Message:</label>
    <br/>
    <textarea name="message" rows="5" cols="50"></textarea>
  </p>
  <p>
    <input type="submit" value="Créer"/>
  </p>
</form>
