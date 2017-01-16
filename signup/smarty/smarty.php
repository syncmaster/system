$friends = "SELECT * FROM friends";
$result = $connect->query($friends);

$smarty->assign("title", "HEllo Smarty this is me Plamen");


					
					<p>Friend List:</p>
					{section name=i loop=$friends} 
						{$friends[i]}</br>; 
					{/section}	

$friends = array("Plamen", "Valentina", "Bogomil", "CVetomir", "Mariya", "Teodora");
$smarty->assign("friends", $friends);

<select name=user>
						{html_options values=$id output=$names selected="5"}
					</select>
					
					
					
$smarty->assign ("id", array("Bulgaria", "Serbia", "UnitedStates", "Macedonia", "Roumania"));
$smarty->assign ("names", array("Bulgaria", "Serbia", "UnitedStates", "Macedonia", "Roumania"));



<div class="col-md-6">
					<div class="alert alert-success"><strong>Success!</strong>You import smarty correctly</div>
						<form action"index.php" method="post" class="form-horizontal">
							<input type="text" class="form-control" name="{$firstname}" />
							<input type="text" class="form-control" name="{$lastname}" />
							<button type="submit" class="btn btn-primary" name="{$signup}" >SUBMIT</button>
						</form>
						<p>{$validateErr}</p>
						<p>{$lastnamerr}</p>
						
						
https://devzone.zend.com/139/php-templating-with-smarty/
