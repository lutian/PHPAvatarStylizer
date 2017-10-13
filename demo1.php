<?php

require __DIR__ . '/PHPAvatarStylizer.php';

$avatarStylizer = new \PHPAvatarStylizer\PHPAvatarStylizer(TRUE);

$avatarPath = 'images/avatarDemo1.jpg';

$userName = 'Lutian_the_Martian';

$userDesc = 'Give Me that Elephant!';

$avatarStylizer->getColorFromImage($avatarPath);

?>
<style>
.bgAvatar {
	background-color: <?php echo $avatarStylizer->bgColor;?>;
	width: 400px;
	height: 140px;
	padding: 20px;
}
.imgAvatar {
	float: left;
	background-image: url('<?php echo $avatarPath;?>');
	width: 120px;
	height: 120px;
	background-size: cover;
	border-radius: 50%;
}
.detailAvatar {
	float: left;
	width: 240px;
}
.title {
	margin-left: 20px;
	color: <?php echo $avatarStylizer->txtColor;?>;
	font-family: Arial;
	font-size: 22px;
} 
.desc {
	margin-left: 20px;
	color: <?php echo $avatarStylizer->txtColor;?>;
	font-family: Arial;
	font-size: 16px;
} 
</style>
<div class="bgAvatar">
	<div class="imgAvatar"></div>
	<div class="detailAvatar">
		<h2 class="title"><?php echo $userName;?></h2>
		<h3 class="desc"><?php echo $userDesc;?></h3>
	</div>
</div>
