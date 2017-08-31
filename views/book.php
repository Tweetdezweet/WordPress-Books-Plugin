<?php
	$title = 'Lord of the rings';
	$authors = 'Tolkien';
	$isbn10 = '0007117116';
	$isbn13 = '9780007117116';
	$description = 'In a sleepy village in the Shire, a young hobbit is entrusted with an immense task. He must make a perilous journey across Middle-earth to the Crack of Doom, there to destroy the Ruling Ring of Power - the only thing that prevents the Dark Lord\'s evil dominion.';
?>

<h3>Oxfam Secondhand books</h3>
<div>
	<div>
		<input name="title" type="text" value="<?php echo $title?>" disabled class="oxfam-input">
	</div>
	<div>
		<input name="authors" type="text" value="<?php echo $authors?>" disabled class="oxfam-input">
	</div>
	<div>
		<input name="isbn10" type="text" value="<?php echo $isbn10?>" disabled class="oxfam-input">
	</div>
	<div>
		<input name="isbn13" type="text" value="<?php echo $isbn13?>" disabled class="oxfam-input">
	</div>
	<div>
        <textarea name="description" disabled class="oxfam-input"><?php echo $description?></textarea>
	</div>
</div>