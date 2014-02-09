<?php 

global $record_id;

$messages = DB::query(
	"SELECT * FROM messages WHERE hash=%s", the_hash() 
);

if( !is_array($messages) ){
	$message = array();
}

?>

<table id="messages-table">
	<tbody>
		<?php foreach($messages as $message){ ?>
			<tr class="row" id="<?php echo $message['id']; ?>">
				<td class="column message-nick <?php the_nick_classes($message['nick']); ?>">
					<?php echo $message['nick']; ?>
				</td>
				<td class="column message-message">
					<?php echo the_message($message['message']); ?>
				</td>
				<td class="column message-time">
					<a href="#<?php echo $message['id']; ?>">
						<?php echo date("F j, Y, g:i a", $message['time']); ?>
					</a>
				</td>
			</tr>
		<?php } //endforeach; ?>
	</tbody>
</table>